<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia;
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $fillable = [
        'uuid', 
        'meta_title', 
        'meta_description', 
        'title', 
        'image_url',
        'slug', 
        'excerpt', 
        'body', 
        'published', 
        'publish_date', 
        'author_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';




    public static function boot()
    {
        parent::boot();
        
        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }


    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * The tags the post belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
    }

    /**
     * The post author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
