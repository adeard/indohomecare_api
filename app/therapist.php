<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class therapist extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'therapists';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'name', 'therapist_type_id'
    ];

    public function therapist_type(){
        return $this->hasOne('App\therapist_type', 'id', 'therapist_type_id');
    }

    public function therapist_contracts(){
        return $this->hasMany('App\therapist_contract', 'therapist_id', 'id');
    }
}
