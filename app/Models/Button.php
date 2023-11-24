<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    use HasFactory;
    const  First_Label = 1;
    const S_LABLE = 2;
    const THIRD_LABLE = 3;
    protected $guarded =[];
}
