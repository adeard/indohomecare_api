<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateProfessions extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'candidate_professions';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'candidate_id', 'contract_period_id', 'last_education', 'photo_upload',
        'ktp_upload', 'diploma_upload', 'str_upload', 'certificate_upload', 'contract_type', 'contract_start_date', 'contract_end_date'
    ];
}
