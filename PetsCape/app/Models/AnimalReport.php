<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnimalReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'species_id',
        'name',
        'breed',
        'age',
        'gender',
        'description',
        'location',
        'contact_name',
        'contact_email',
        'contact_phone',
        'image',
        'date_reported',
        'is_found',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_reported' => 'datetime',
        'is_found' => 'boolean',
    ];

    /**
     * Get the user who reported the animal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the species of the animal.
     */
    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }
    
    /**
     * Get the found reports for this animal report.
     */
    public function foundReports(): HasMany
    {
        return $this->hasMany(FoundAnimalReport::class);
    }
} 