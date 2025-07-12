<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bank extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'region_id',
        'township_id',
        'bank_type_id',
        'latitude',
        'longitude',
        'address',
    ];

    /**
     * Get the region that owns the bank.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the township that owns the bank.
     */
    public function township(): BelongsTo
    {
        return $this->belongsTo(Township::class);
    }

    /**
     * Get the bank type that owns the bank.
     */
    public function bankType(): BelongsTo
    {
        return $this->belongsTo(BankType::class); // Assuming you have a BankType model
    }
}
