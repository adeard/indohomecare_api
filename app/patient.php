<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class patient extends Model
{
    use SoftDeletes;

    public $incrementing = true;
    public $primaryKey   = 'id';

    protected $table = 'patients';
    protected $guarded = ['id'];
    protected $fillable = [
        'fullname', 'pj_id'
    ];

    public function pjs(){
        return $this->hasOne('App\pj', 'id', 'pj_id');
    }
}
