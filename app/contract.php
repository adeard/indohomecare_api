<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contract extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'contracts';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'pj_id', 'created_by', 'contract_no', 'status'
    ];

    public function users(){
        return $this->hasOne('App\Users', 'id', 'created_by');
    }

    public function pjs(){
        return $this->hasOne('App\Users', 'id', 'created_by');
    }
}
