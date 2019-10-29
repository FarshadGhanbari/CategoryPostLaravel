<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = ['category_id', 'title', 'text', 'tags'];

    protected $casts = ['tags' => 'array'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    protected static function boot()
    {
        parent::boot();
    }
}
