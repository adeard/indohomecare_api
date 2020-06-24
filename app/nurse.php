<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nurse extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'nurses';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'fullname', 'nurse_category_id'
    ];
}
