<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = ['parent_id', 'name', 'slug'];

    public function parent()
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }

    public function parents()
    {
        return $this->parent()->with('parents');
    }

    public function child()
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }

    public function children()
    {
        return $this->child()->with('children');
    }

    public function posts()
    {
        return $this->hasMany(Posts::class, 'category_id');
    }

    public function all_posts()
    {
        return $this->child()->with('children', 'posts');
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($row) {
            $row->slug = slugify($row->name);
            $row->save();
        });
        static::deleting(function ($row) {
            $row->children()->delete();
            $row->posts()->delete();
        });
    }
}
