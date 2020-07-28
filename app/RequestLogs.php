<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestLogs extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'request_logs';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'request_id', 'note'
    ];
}
