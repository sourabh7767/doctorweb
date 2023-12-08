<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSearchTag extends Model
{
    use HasFactory;

    public function customSearch()
    {
        return $this->belongsTo(CustomSearch::class);
    }
}
