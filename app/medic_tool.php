<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class medic_tool extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'medic_tools';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'name', 'medic_tool_category'
    ];

    public function medic_tool_contracts(){
        return $this->hasMany('App\medic_tool_contract', 'medic_tool_id', 'id');
    }

    public function medic_tool_sessions(){
        return $this->hasMany('App\medic_tool_session', 'medic_tool_id', 'id');
    }
}
