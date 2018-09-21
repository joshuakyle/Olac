<?php

namespace App\Http\Controllers;

use App\Model\Subject;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Teacher;
use App\Model\Schedule;
use DB;

class SubjectController extends Controller
{

    function __construct(){
        $this->subject = new Subject;
        $this->teacher = new Teacher;
        $this->schedule = new Schedule;
    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $data['subjects'] = $this->subject->select('subjects.*',
            DB::raw('COALESCE(t.first_name,null) as first_name,COALESCE(t.last_name,null) as last_name,COALESCE(s.schedule_name,null) as time,COALESCE(sc.section_name,null) as section'))
            ->leftJoin('schedule as s','s.schedule_id','=','subjects.schedule_id')
            ->leftJoin('teachers as t','t.id','=','s.teacher_id')
            ->leftJoin('section as sc','s.section_id','=','sc.id')
            ->orderBy('subjects.year')
            ->get();

        // $data['subjects'] = $this->subject->orderBy('year')->get();
        $data['schedules'] = [];
        $data['module_name'] = 'subject-list';
        $data['module_header'] = 'Subject Management';
        return view('pages.subjectList',$data);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(),['name'=>'required','year'=>'required']);
        if($validator->fails()){
            return back()->withErrors($validator)
                        ->withInput();
        }else{
            $id = $this->subject->insertGetId([
                'subject_name' => $request->get('name'),
                'year' => $request->get('year'),
                'created_at' => now()
            ]);

            if($request->get('schedule') != 0){
                $this->subject->where('id',$id)->update([
                    'schedule_id' => $request->get('schedule'),
                ]);
                $this->schedule->where('schedule_id',$request->get('schedule'))->update(['schedule_id'=>$id]);

                $this->schedule->where('schedule_id',$request->get('schedule'))->update(['subject_id'=>$request->get('id')]);
            }
        }

        return back()->with('status','Subject has been successfully added.');
    }

    public function getSubject($id)
    {
        return $this->subject->select('subjects.*',DB::raw('COALESCE(s.schedule_name,null) as schedule_name,COALESCE(sc.section_name,null) as section_name'))
            ->where('subjects.id',$id)
            ->leftJoin('schedule as s','s.schedule_id','=','subjects.schedule_id')
            ->leftJoin('section as sc','s.section_id','=','sc.id')
            ->first();   
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),['name'=>'required','year'=>'required']);
        if($validator->fails()){
            return back()->withErrors($validator)
                        ->withInput();
        }else{
             $this->subject->where('id',$request->get('id'))->update([
                'subject_name' => $request->get('name'),
                'year' => $request->get('year'),
                'updated_at'=>now()
            ]);

            if(!is_null($request->get('schedule')) && $request->get('schedule') != 0){
                $this->subject->where('id',$request->get('id'))->update([
                    'schedule_id' => $request->get('schedule')
                ]);

                $this->schedule->where('schedule_id',$request->get('schedule'))->update(['subject_id'=>$request->get('id')]);
            }

             return back()->with('status','Subject has been successfully updated');
        }
    }

    public function delete($id)
    {
        if($this->subject->where('id',$id)->delete()){
            return back()->with('status','Subject has been successfully deleted.');
        }

        return back()->with('status','Failed to delete.');
    }
}