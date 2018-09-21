<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'parent';
    protected $guarded = [];
}