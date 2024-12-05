<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchBook extends Model
{
    use HasFactory;
    protected $table = 'research_book';
    protected $fillable = ['file','created_at', 'updated_ad'];
}
