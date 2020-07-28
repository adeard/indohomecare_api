<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidates extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'candidates';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'service_id', 'on_duty', 'candidate_no', 'fullname', 'age', 'weight', 'height', 'phone_no', 'gender','address', 'residence'
    ];
}
