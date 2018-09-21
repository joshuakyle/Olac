<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Third extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'third_year_grades';
    protected $primaryKey = 'grade_id'; 
    public $timestamps = false;

     public function subject()
	{
	    return $this->belongsTo('App\Model\Subject')->withDefault()->first();
	}
}