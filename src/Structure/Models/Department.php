<?php

namespace AndrykVP\Rancor\Structure\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use AndrykVP\Rancor\Database\Factories\DepartmentFactory;
use AndrykVP\Rancor\Structure\Models\Rank;
use AndrykVP\Rancor\Structure\Models\Faction;

class Department extends Model
{
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return DepartmentFactory::new();
    }
    
    /**
     * Defines the table name
     * 
     * @var string
     */
    protected $table = 'structure_departments';

    /**
     * Attributes available for mass assignment
     * 
     * @var array
     */
    protected $fillable = [ 'name', 'description', 'faction_id' ];

    /**
     * Relationship to Rank model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranks()
    {
        return $this->hasMany(Rank::class)->orderBy('level','desc');
    }

    /**
     * Relationship to User model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users()
    {
        return $this->hasManyThrough(User::class, Rank::class);
    }

    /**
     * Relationship to Faction model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faction()
    {
        return $this->belongsTo(Faction::class);
    }
}
