<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'meta',
        'content',
        'image',
        'status',
        'sub_category_id',
        'author_id',
        'path',
        'status',
        'view',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'author_id' => 'integer',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
