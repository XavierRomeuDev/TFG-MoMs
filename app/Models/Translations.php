<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translations extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'locale', 'section', 'section_id'];
}
