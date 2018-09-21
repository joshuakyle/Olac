<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'section';

    public function teacher()
    {
        return $this->belongsTo('App\Model\Teacher')->withDefault()->first();
    } 

    public function students()
	{
	    return $this->belongsTo('App\Model\Student')->withDefault()->get();
	}

    public function student_count()
    {
        return $this->hasMany('App\Model\Student')->count();
    }
}