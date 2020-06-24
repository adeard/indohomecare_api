<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class therapist_session extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'therapist_sessions';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'name', 'price'
    ];

    public function therapist_contracts(){
        return $this->hasMany('App\therapist_contract', 'therapist_session_id', 'id');
    }
}
