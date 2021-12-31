<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
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
        'author_id',
        'category_id'
    ];


    public const ROLE_USER = 1;
    public const ROLE_ADMIN = 2;
    public const ROLE_EDITOR = 3;

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
        return $this->belongsToMany(Tag::class, 'posts_has_tags', 'post_id', 'tag_id');
    }


    /**
     * The tags the post belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
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


    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('default','thumb');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(150)
              ->height(100);
    }


    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

}
