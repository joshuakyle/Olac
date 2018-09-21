<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Teacher;
use App\Model\Section;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class SectionController extends Controller
{

    public function __construct(){
        $this->teacher = new Teacher;
        $this->section = new Section;
    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $data['sections'] = $this->section->orderBy('year')->get();
        $data['teachers'] = $this->teacher->select('teachers.*')->where('type',1)->leftJoin('section as s','s.teacher_id','=','teachers.id')->whereNull('s.id')->get();
        $data['module_name'] = 'section-list';
        $data['module_header'] = 'Section Management';
        return view('pages.sectionList',$data);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(),['name'=>'required','year'=>'required','capacity'=>'required|max:50']);
        if($validator->fails()){
            return back()->withErrors($validator)
                        ->withInput();
        }else{
            $this->section->insert([
                'section_name' => $request->get('name'),
                'year' => $request->get('year'),
                'teacher_id' => $request->get('teacher'),
                'capacity' => $request->get('capacity'),
                'created_at' => now()
            ]);
            $tableX = $request->get('year').'_'.$request->get('name');
            if (!Schema::hasTable($tableX)) {
                Schema::create($tableX, function (Blueprint $table) {
                    $table->increments('attendance_id');
                    $table->integer('grade')->nullable();
                    $table->integer('student_id');
                    $table->integer('subject_id');
                    $table->integer('attendance');
                    $table->integer('total_attendance');
                    $table->string('updated_at',255);
                    $table->string('absent_dates', 555);
                });
            }
            return back()->with('status','Section has been successfully added.');

        }

    }

    public function getSection($id)
    {
        return $this->section->where('section.id',$id)->first();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),['name'=>'required','year'=>'required','capacity'=>'required|max:50']);
        if($validator->fails()){
            return back()->withErrors($validator)
                        ->withInput();
        }else{
            $details = $this->section->where('id',$request->get('id'))->first();
            $t_name = $details->year.'_'.$details->section_name;
            $new_t_name = $request->get('year').'_'.$request->get('name');
            $this->section->where('id',$request->get('id'))->update([
                'section_name' => $request->get('name'),
                'year' => $request->get('year'),
                'teacher_id' => $request->get('teacher') ? $request->get('teacher') : $details->teacher_id ,
                'updated_at'=>now()
            ]);

            if($t_name != $new_t_name)
                Schema::rename($t_name,$new_t_name);

             return back()->with('status','Section has been successfully updated');
        }
    }


    public function delete($id)
    {
        $details = $this->section->where('id',$id)->first();
        $t_name = $details->year.'_'.$details->section_name;
        if($this->section->where('id',$id)->delete()){
            Schema::dropIfExists($t_name);
            return back()->with('status','Section has been successfully deleted.');
        }

        return back()->with('status','Failed to delete.');
    }
}