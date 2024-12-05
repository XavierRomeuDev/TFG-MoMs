<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($partners) {
            $partners->translations()->delete();
        });
    }

    protected $table = 'partners';
    protected $fillable = ['name', 'image', 'country', 'website', 'description_en', 'created_at', 'updated_ad'];

    public function translations ()
    {
        return $this->hasMany(Translations::class, 'section_id')->where('section', 'partners');
    }
}
