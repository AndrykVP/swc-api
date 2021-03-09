<?php

namespace AndrykVP\Rancor\News\Models;

use Illuminate\Database\Eloquent\Model;
use AndrykVP\Rancor\Database\Factories\TagFactory;

class Tag extends Model
{
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TagFactory::new();
    }
    
    /**
     * Defines the table name
     * 
     * @var string
     */
    protected $table = 'news_tags';

    /**
     * Attributes available for mass assignment
     * 
     * @var array
     */
    protected $fillable = [ 'name', 'color' ];

    /**
     * Defines the table name
     * 
     * @var string
     */
    protected $hidden = ['pivot'];

    /**
     * Relationship to Tags model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('AndrykVP\Rancor\News\Article','news_article_tag')->withTimestamps();
    }
}
