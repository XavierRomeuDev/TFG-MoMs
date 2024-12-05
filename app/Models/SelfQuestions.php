<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfQuestions extends Model
{
    use HasFactory;

    protected $table = 'self_questions';
    protected $fillable = ['self_id', 'answer', 'options', 'question_en', 'question_it', 'question_es', 'question_cat', 'question_bg', 'question_gr', 'created_at', 'updated_ad'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($self_question) {
            $self_question->translations()->delete();
        });
    }

    public function translations()
    {
        return $this->hasMany(Translations::class, 'related_field')->where('section', 'self_id');
    }
}
