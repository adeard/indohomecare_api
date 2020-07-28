<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pjs extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'pjs';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'pj_no', 'fullname', 'handphone', 'ktp', 'email', 'address'
    ];
}
