<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;
    protected $table = 'schedule';

    public function teacher()
	{
	    return $this->belongsTo('App\Model\Teacher')->withDefault()->first();
	}

	public function section()
	{
	    return $this->belongsTo('App\Model\Section')->withDefault()->first();
	}

	public function subject()
	{
	    return $this->belongsTo('App\Model\Subject')->withDefault()->first();
	}
}