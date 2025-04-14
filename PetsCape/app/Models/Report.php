<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'species_id',
        'breed',
        'gender',
        'age',
        'description',
        'is_found',
        'date_of_incident',
        'location',
        'contact_name',
        'contact_email',
        'contact_phone',
        'image',
        'is_resolved',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_found' => 'boolean',
        'is_resolved' => 'boolean',
        'date_of_incident' => 'date',
    ];

    /**
     * Get the user who created the report.
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
     * Get the status label of the report.
     */
    public function getStatusLabelAttribute(): string
    {
        if ($this->is_resolved) {
            return 'Résolu';
        }
        
        return $this->is_found ? 'Trouvé' : 'Perdu';
    }

    /**
     * Get the status color of the report.
     */
    public function getStatusColorAttribute(): string
    {
        if ($this->is_resolved) {
            return 'green';
        }
        
        return $this->is_found ? 'blue' : 'red';
    }
    
    /**
     * Get the type of the report.
     */
    public function getTypeAttribute(): string
    {
        return $this->is_found ? 'found' : 'lost';
    }
} 