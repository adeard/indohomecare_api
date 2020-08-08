<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class medic_tool_contract extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'medic_tool_contracts';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'medic_tool_id', 'medic_tool_session_id', 'contract_id', 'quantity', 'total_price'
    ];

    public function contracts(){
        return $this->hasOne('App\contract', 'id', 'contract_id');
    }

    public function medic_tools(){
        return $this->hasOne('App\medic_tool', 'id', 'medic_tool_id');
    }

    public function medic_tool_sessions(){
        return $this->hasOne('App\medic_tool_session', 'id', 'medic_tool_session_id');
    }
}
