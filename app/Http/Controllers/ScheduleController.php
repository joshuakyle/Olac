<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Teacher;
use App\Model\Section;
use App\Model\Schedule;
use App\Model\Subject;
use DB;
class ScheduleController extends Controller
{

    public function __construct(){
        $this->teacher = new Teacher;
        $this->section = new Section;
        $this->schedule = new Schedule;
        $this->subject = new Subject;
    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $data['schedules'] = $this->schedule
            ->select('schedule.schedule_id','schedule.schedule_name','t.first_name','t.last_name','s.year','s.section_name','st.subject_name')
            ->leftJoin('section as s','s.id','=','schedule.section_id')
            ->leftJoin('teachers as t','t.id','=','schedule.teacher_id')
            ->leftJoin('subjects as st','st.id','=','schedule.subject_id')
            ->orderBy('s.section_name')
            ->orderBy('schedule.schedule_time_id')
            ->orderBy('s.year')
            ->get();
        $data['subjects'] = $this->subject->whereNull('schedule_id')->orderBy('year')->orderBy('subject_name')->get();
        $data['module_name'] = 'schedule-list';
        $data['module_header'] = 'Schedule Management';
        return view('pages.scheduleList',$data);
    }

    public function getTeacherSched($id)
    {
        return $this->teacher->select('teachers.last_name','teachers.first_name','teachers.id')
            ->whereNotIn('teachers.id',function($query) use($id){
                $query->select('teacher_id')->from('schedule')->where('schedule_time_id',$id);
            })
            ->groupBy('teachers.id')
            ->groupBy('teachers.first_name')
            ->groupBy('teachers.last_name')
            ->get();
    }

    public function getSectionSched($id)
    {
        return $this->section->select('section.section_name','section.id','section.year')
        ->whereNotIn('section.id',function($query) use($id){
                $query->select('section_id')->from('schedule')->where('schedule_time_id',$id);
            })
        ->groupBy('section.id')
        ->groupBy('section.section_name')
        ->groupBy('section.year')
        ->get();
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(),['time'=>'required','teacher'=>'required','section'=>'required']);
        if($validator->fails()){
            return back()->withErrors($validator)
                        ->withInput();
        }else{
            // check if the subject has the same year level with section
            if(!is_null($request->get('subject'))){
                $section = $this->section->where('id',$request->get('section'))->first();
                $subject = $this->subject->where('id',$request->get('subject'))->first();
                if($section->year != $subject->year){
                    return back()->with('status','Subject : '.$subject->subject_name.' , is not applicable for '.getYearText($subject->year).' sections.');
                }
            }

            $id = $this->schedule->insertGetId([
                'teacher_id' => $request->get('teacher'),
                'subject_id' => $request->get('subject'),
                'section_id' => $request->get('section'),
                'schedule_name' => getListofScheduleText($request->get('time')),
                'schedule_time_id' => $request->get('time'),
                'schedule_type' => 1,
                'created_at' => now()
            ]);
            if(!is_null($request->get('subject'))){
                $this->subject->where('id',$request->get('subject'))->update(['schedule_id'=>$id]);
            }

            return back()->with('status','Schedule has been successfully added.');
        }
    }

    public function delete($id)
    {
        if($this->schedule->where('schedule_id',$id)->delete()){
            return back()->with('status','Schedule has been successfully deleted.');
        }

        return back()->with('status','Failed to delete.');
    }

    public function getSched($id)
    {
        return $this->schedule->select('s.section_name','s.year','schedule.schedule_name','schedule.schedule_id')
        ->leftJoin('section as s','s.id','=','schedule.section_id')
        ->where('s.year','=',$id)
        ->whereNull('subject_id')
        ->get();
    }

}