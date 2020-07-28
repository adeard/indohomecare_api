<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patients extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'patients';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'pj_id', 'fullname', 'age', 'gender', 'weight', 'height', 'diagnosa', 'main_complaint','recomendation', 'address', 'note'
    ];
}
