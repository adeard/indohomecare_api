<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'roles';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'name'
    ];
}
