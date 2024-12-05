<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfAssessment extends Model
{
    use HasFactory;

    protected $table = 'self';
    protected $fillable = ['title_en', 'created_at', 'updated_ad'];

    public function questions()
    {
        return $this->hasMany(SelfQuestions::class, 'self_id');
    }

    public function translations()
    {
        return $this->hasMany(Translations::class, 'related_field')->where('section', 'self');
    }
}