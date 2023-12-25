<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\View;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'filepath',
    ];

    public function view(): HasMany
    {
        return $this->hasMany(View::class);
    }
}
