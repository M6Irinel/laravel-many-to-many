<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'slug', 'category_id', 'image'];

    public function category()
    {
        // // short
        // return $this->belongsTo('App\Category');

        // // long
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id');
    }

    public static function validate_for_create($request)
    {
        return $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'slug' => 'nullable|max:255|unique:posts',
            'category_id' => 'nullable|exists:App\Category,id',
            'tags' => 'nullable|exists:App\Tag,id',
            'image' => 'nullable|image|max:3000'
        ]);
    }

    public static function validate_for_update($request, $post)
    {
        return $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'slug' => ['nullable', 'max:255', Rule::unique('posts')->ignore($post->id)],
            'category_id' => 'nullable|exists:App\Category,id',
            'tags' => 'nullable|exists:App\Tag,id',
            'image' => 'nullable|image|max:3000'
        ]);
    }

    public static function slug($params)
    {
        $slug_base = Str::slug($params['title']);
        $slug = $slug_base;
        $slug_esistente = Post::where('slug', $slug)->first();
        $i = 1;

        while ($slug_esistente) {
            $slug = $slug_base . '-' . $i++;
            $slug_esistente = Post::where('slug', $slug)->first();
        }

        return $slug;
    }
}
