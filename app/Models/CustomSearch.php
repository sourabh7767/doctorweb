<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSearch extends Model
{
    use HasFactory;

    public function customTags()
    {
        return $this->hasMany(CustomSearchTag::class,'custom_search_id','id');
    }
}
