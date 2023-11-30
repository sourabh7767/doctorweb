<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrescriptionTag extends Model
{
    use HasFactory;
    use SoftDeletes;

     public function prescriptions()
    {
        return $this->belongsTo(Prescription::class,'prescription_id','id');
    }
}
