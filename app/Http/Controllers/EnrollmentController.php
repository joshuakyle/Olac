<?php

namespace App\Http\Controllers;

use App\Model\Subject;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Teacher;
use App\Model\Schedule;
use App\Model\Student;
use App\Model\StudentParent;
use App\Model\Section;
use App\Model\Payment;
use App\Model\School;
use DB;
use App\User;
use QRCode;
use Storage;

class EnrollmentController extends Controller
{

    function __construct(){
        $this->subject = new Subject;
        $this->teacher = new Teacher;
        $this->schedule = new Schedule;
        $this->user = new User;
        $this->student = new Student;
        $this->parent = new StudentParent;
        $this->section = new Section;
        $this->payment = new Payment;
        $this->school = new School;
    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $data['payment'] = $this->payment->select('full_amount','down_payment','monthly_payment','tuition_fee','energy_fee','internet_lab','speech_lab')->first();
        return view('pages.enrollment',$data);
    }

    public function create(Request $request)
    {
        $school = $this->school->first();
        $old_year = $request->get("grade/level");
        $old_school_name = $request->get("school_name");
        $old_year_level = $request->get("grade/level");
        $old_school_year = $request->get("school_year");
        $old_school_address = $request->get("school_address");
        $old = false;
        $student_data = $this->getStudentDetails(ucfirst($request->get("last_name")),ucfirst($request->get("first_name")),ucfirst($request->get("middle_name")));

        if(!is_null($student_data)){
            if(date_format(date_create($student_data->created_at),'Y') == $school->enrollment_year){
                return response()->json(['status'=>3,'message'=>'Failed, We already recieved an application from this student for school year: '.$school->school_year]);
            }
        }

        if(!is_null($request->get("old_student"))){
            if(!is_null($student_data)){
                if($student_data->old_student){ 
                    $old_year_level = $student_data->year + 1;
                    $old_school_address = $school->school_address;
                    $old_school_name = $school->school_name;
                    $old_school_year = getPreviousSchoolYear();
                    $old = true;
                }
                
            }else{
                return response()->json(['status'=>3,'message'=>'Sorry, This student does not exist in our database.']);
            }
        }

        $section_id = $this->getAvailabelSection($old ? $old_year_level : $request->get("grade/level")+1);
        if(is_null($section_id)){
           return response()->json(['status'=>2,'message'=>'Sorry full students for '.getYearText($old_year_level+1),'year'=>getYearText($old_year_level+1).' level']);
        }
 
        $student_id = $this->student->insertGetId([
            'middle_name' => ucfirst($request->get("middle_name")),
            'first_name' => ucfirst($request->get("first_name")),
            'last_name' => ucfirst($request->get("last_name")),
            'address' => $request->get("birth_place"),
            'birthdate' => dateFormat($request->get("birthdate")),
            'religion' => $request->get("religion"),
            'guardian_email' => $request->get("email"),
            'guardian_name' => $request->get("guardian_name"),
            'guardian_number' =>  $request->get("guardian_number"),
            'guardian_occupation' => $request->get("occupation"),
            'guardian_relation' => $request->get("relation"),
            'old_school_name' => $old_school_name,
            'old_school_address' => $old_school_address,
            'old_year_level' => $old_year_level,
            'old_school_year' => $old_school_year,
            'payment_id' => $request->get("mode"),
            'qr_code' => null,
            'gender' => $request->get("gender"),
            'created_at' => now()
        ]);

        $qr_code = md5(uniqid($student_id), false);
        //insert parent
        //mother
        $data = array(
            [
                'parent_name' => $request->get("mother_name"),
                'parent_relation' =>'Mother',
                'student_id' => $student_id,
                'contact_number' => $request->get("mother_contact_number"),
                'occupation' => $request->get("mother_occupation")
            ],
            [
                'parent_name' =>$request->get("father_name"),
                'parent_relation' =>'Father',
                'student_id' => $student_id,
                'contact_number' =>$request->get("father_contact_number"),
                'occupation' =>$request->get("father_occupation")
            ]
        );

        $this->parent->insert($data); 

        $this->student->where('id',$student_id)->update(['qr_code'=>$qr_code]);

        $this->qrcode($request->get("last_name"),$section_id,$student_id,$qr_code);

        return response()->json(['status'=>1]);
    }

    public function getAvailabelSection($year)
    {
        $sections_per_year = $this->section->where('year',$year)->orderBy('created_at')->get();
        foreach ($sections_per_year as $key => $val) {
            $students = $this->student->where('section_id',$val->id)->where('status',1)->count();
            if($students < $val->capacity){
                return $val->id;
                break;
            }
        }

        return null;
    }

    public function getStudentDetails($lastname,$middle,$firstname)
    {
        return $this->student->select('students.*','s.year')
            ->where('first_name',$firstname)
            ->where('last_name',$lastname)
            ->where('middle_name',$middle)
            ->leftJoin('section as s','students.section_id','=','s.id')
            ->first();
    }

    public function qrcode($last_name,$section_id,$student_id,$qr_code)
    {
        $section = $this->section->where('id',$section_id)->first();
        $name = $last_name.'-'.$section->section_name.'-'.$student_id;
        if(!file_exists(url('public/'.$section_id))){
            Storage::makeDirectory('public/'.$section_id);
        }
        return QRCode::text($qr_code)
                ->setOutfile(getStoragePath().'/'.$section_id.'/'.$name.'.png')
                ->setSize(8)
                ->png();
    }

    public function option()
    {
        $data['school'] = $this->school->first();
        $data['module_name'] = 'school-option';
        $data['module_header'] = 'School Option';
        return view('pages.schoolOptions',$data);
    }

}