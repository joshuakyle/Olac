<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;
    protected $table = 'students';

    public function section()
	{
	    return $this->belongsTo('App\Model\Section')->withDefault()->first();
	}
    public function first($id)
    {
        return $this->hasMany('App\Model\First')->where('subject_id',$id)->orderBy('quarter')->get();
    }
    public function second($id)
    {
        return $this->hasMany('App\Model\Second')->where('subject_id',$id)->orderBy('quarter')->get();
    }
    public function third($id)
    {
        return $this->hasMany('App\Model\Third')->where('subject_id',$id)->orderBy('quarter')->get();
    }
    public function fourth($id)
    {
        return $this->hasMany('App\Model\Fourth')->where('subject_id',$id)->orderBy('quarter')->get();
    }
    public function firstGrade($id)
    {
        return $this->hasMany('App\Model\First')->where('student_id',$id)->orderBy('quarter')->get();
    }
    public function secondGrade($id)
    {
        return $this->hasMany('App\Model\Second')->where('student_id',$id)->orderBy('quarter')->get();
    }
    public function thirdGrade($id)
    {
        return $this->hasMany('App\Model\Third')->where('student_id',$id)->orderBy('quarter')->get();
    }
    public function fourthGrade($id)
    {
        return $this->hasMany('App\Model\Fourth')->where('student_id',$id)->orderBy('quarter')->get();
    }

    public function mother()
    {
        return $this->hasMany('App\Model\StudentParent')->where('parent_relation','Mother')->first();
    }
    
    public function father()
    {
        return $this->hasMany('App\Model\StudentParent')->where('parent_relation','Father')->first();
    }
}