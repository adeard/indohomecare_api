<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class therapist_type extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'therapist_types';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'name'
    ];

    public function therapist(){
        return $this->hasMany('App\therapist', 'therapist_type_id', 'id');
    }
}
