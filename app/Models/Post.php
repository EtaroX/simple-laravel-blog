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


    public function getLikeProcentage(): float
    {
        if ($this->likes + $this->dislikes === 0) {
            return 50;
        }
        return ($this->likes / ($this->likes + $this->dislikes)) * 100;
    }


    public function incrementLikes(): void
    {
        $this->likes += 1;
        $this->save();
    }

    public function incrementDislikes(): void
    {
        $this->dislikes += 1;
        $this->save();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function html(): Attribute
    {
        return Attribute::get(fn () => str($this->body)->markdown());
    }


}
