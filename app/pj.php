<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pj extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'pjs';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'fullname'
    ];

    public function contracts(){
        return $this->hasMany('App\contract', 'pj_id', 'id');
    }

    public function patients(){
        return $this->hasMany('App\patient', 'pj_id', 'id');
    }
}
