<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    public function teacher()
	{
	    return $this->belongsTo('App\Model\Teacher')->withDefault()->first();
	}
}