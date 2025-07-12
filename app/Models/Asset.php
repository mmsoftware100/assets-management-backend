<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bank_id',
        'ministry_name',
        'department_name',
        'machine_name',
        'department_no',
        'brand_name',
        'make_name',
        'model_name',
        'mother_board_name',
        'memory_name',
        'storage_device_name',
        'monitor_name',
        'multi_media_name',
        'number_name',
        'price_name',
        'condition_name',
        'budget_year_name',
        'location_township_name',
        'location_region_name',
        'received_by_name',
        'remark_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // You can add casting for specific attributes if needed, e.g.,
        // 'price_name' => 'float', // if you plan to store price as a numeric type
    ];

    /**
     * Get the bank that owns the asset.
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class); // Assumes you have a Bank model
    }
    
}
