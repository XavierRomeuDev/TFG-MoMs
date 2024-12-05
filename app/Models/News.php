<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($news) {
            $news->translations()->delete();
        });
    }

    protected $table = 'news';
    protected $fillable = ['title', 'image', 'description_en', 'created_at', 'updated_ad'];
    public function translations ()
    {
        return $this->hasMany(Translations::class, 'section_id')->where('section', 'news');
    }
}
