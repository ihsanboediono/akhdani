<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'province',
        'island',
        'overseas',
        'latitude',
        'longitude',
    ];
}
