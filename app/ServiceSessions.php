<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceSessions extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'service_sessions';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'service_id', 'session_id', 'price', 'need_patient', 'is_active'
    ];

    public function sessions() {
        return $this->hasOne('App\Sessions', 'id', 'session_id');
    }

    public function services() {
        return $this->hasOne('App\Services', 'id', 'service_id');
    }
}
