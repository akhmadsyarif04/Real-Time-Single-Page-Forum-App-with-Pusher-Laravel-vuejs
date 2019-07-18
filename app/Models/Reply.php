<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Question;
use App\Models\Like;

class Reply extends Model
{

    protected static function boot(){
      parent::boot();

      static::creating(function($reply){
        $reply->user_id = auth()->id();
      });
    }
    protected $guarded = [];

    public function question()
    {
      return $this->belongsTo(Question::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function like()
    {
      return $this->hasMany(Like::class);
    }
}
