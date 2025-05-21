<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{

    protected $fillable = ['nome', 'url', 'status', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
