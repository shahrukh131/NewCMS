<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'Title', 'description', 'content', 'image', 'published_at', 'catagory_id', 'user_id'

    ];

    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function catagory()
    {
        return $this->belongsTo(Catagory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
