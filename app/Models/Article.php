<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;
    protected $fillable=  [
        'title',
        'content',
        'image',
        'user_id',
        'category_id',

    ];
    public  function category()
    {
        return  $this->belongsTo(Category::class);
    }
}

