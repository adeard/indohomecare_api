<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nurse_session extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'nurse_sessions';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'name', 'nurse_category_id', 'price'
    ];

    public function nurse_categories(){
        return $this->hasOne('App\nurse_category', 'id', 'nurse_category_id');
    }

    public function nurse_contracts(){
        return $this->hasMany('App\nurse_contract', 'nurse_session_id', 'id');
    }
}
