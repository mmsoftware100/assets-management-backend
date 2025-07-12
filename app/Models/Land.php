<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'building_owner_name',
        'building_type_name',
        'region_id',
        'township_id',
        'address',
        'year_built',
        'building_design_name',
        'building_size',
        'building_area',
        'land_size',
        'land_area',
        'distributed_fund',
        'price',
        'is_currently_in_use',
        'currently_in_use_note',
        'type_details',
        'is_grant_owned',
        'grant_owned_note',
        'life_span',
        'is_ownership_changed',
        'ownership_changed_note',
        'is_land_owned',
        'land_owned_note',
        'images', // Store image file names/paths
        'documents', // Store document file names/paths
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'year_built' => 'date', // Casts the year_built column to a Carbon instance
        'distributed_fund' => 'decimal:2', // Casts to a decimal with 2 places
        'price' => 'decimal:2', // Casts to a decimal with 2 places
        'is_currently_in_use' => 'boolean', // Casts to boolean
        'is_grant_owned' => 'boolean', // Casts to boolean
        'is_ownership_changed' => 'boolean', // Casts to boolean
        'is_land_owned' => 'boolean', // Casts to boolean
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // Add any attributes you want to hide when the model is converted to an array or JSON.
    ];

    /**
     * Get the region that owns the land.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the township that owns the land.
     */
    public function township()
    {
        return $this->belongsTo(Township::class);
    }
    
}
