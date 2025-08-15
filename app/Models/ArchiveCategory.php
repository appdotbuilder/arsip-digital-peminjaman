<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ArchiveCategory
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property array $required_fields
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Archive> $archives
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory whereRequiredFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArchiveCategory active()
 * @method static \Database\Factories\ArchiveCategoryFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ArchiveCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'required_fields',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'required_fields' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all archives in this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }

    /**
     * Scope a query to only include active categories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}