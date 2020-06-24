<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class medic_tool_session extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'medic_tool_sessions';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'name', 'medic_tool_id', 'price'
    ];

    public function medic_tools(){
        return $this->hasOne('App\medic_tool', 'id', 'medic_tool_id');
    }

    public function medic_tool_contracts(){
        return $this->hasMany('App\medic_tool_contract', 'medic_tool_session_id', 'id');
    }
}
