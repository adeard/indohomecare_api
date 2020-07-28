<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateTrainings extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'candidate_trainings';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'candidate_id', 'score', 'status', 'notes'
    ];
}
