<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Reply;
use App\Models\Category;

class Question extends Model
{

    protected static function boot()
    {
      parent::boot();

      static::creating(function ($question) {
        $question->slug = str_slug($question->title);
      });
      // untuk set slug
    }

    public function getRouteKeyName()
    {
      return 'slug';
    }

    protected $fillable = ['title','slug','body','category_id','user_id'];

    // protected $guarded = [];

    protected $with = ['replies']; // ngambil dari tabel relasi

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function replies()
    {
      return $this->hasMany(Reply::class)->latest();
    }

    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function getPathAttribute()
    {
      return "/question/$this->slug";
    }
}
