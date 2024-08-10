<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'tag', 'photo'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function html(): Attribute
    {
        return Attribute::get(fn () => str($this->body)->markdown());
    }


}
