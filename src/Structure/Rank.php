<?php

namespace AndrykVP\Rancor\Structure;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    /**
     * Defines the table name
     * 
     * @var string
     */
    protected $table = 'structure_ranks';

    /**
     * Attributes available for mass assignment
     * 
     * @var array
     */
    protected $fillable = [ 'name', 'description', 'department_id', 'level' ];

    /**
     * Relationship to User model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Relationship to Department model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('AndrykVP\Rancor\Structure\Department');
    }
}
