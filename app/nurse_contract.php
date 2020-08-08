<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nurse_contract extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'nurse_contracts';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'nurse_id', 'nurse_session_id', 'contract_id'
    ];

    public function contracts(){
        return $this->hasOne('App\contract', 'id', 'contract_id');
    }

    public function nurses(){
        return $this->hasOne('App\nurse', 'id', 'nurse_id');
    }

    public function nurse_sessions(){
        return $this->hasOne('App\nurse_session', 'id', 'nurse_session_id');
    }
}
