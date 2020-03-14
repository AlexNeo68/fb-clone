<?php

namespace App;

use App\Scopes\ReverseScope;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ReverseScope());
    }

    protected $fillable = [
        'body',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
