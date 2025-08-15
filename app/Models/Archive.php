<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Archive
 *
 * @property int $id
 * @property int $archive_category_id
 * @property string $title
 * @property string $archive_number
 * @property array $archive_data
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ArchiveCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BorrowingItem> $borrowingItems
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Archive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Archive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Archive query()
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereArchiveCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereArchiveData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereArchiveNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Archive available()
 * @method static \Illuminate\Database\Eloquent\Builder|Archive borrowed()
 * @method static \Database\Factories\ArchiveFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Archive extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'archive_category_id',
        'title',
        'archive_number',
        'archive_data',
        'description',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'archive_category_id' => 'integer',
        'archive_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the category that owns this archive.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArchiveCategory::class, 'archive_category_id');
    }

    /**
     * Get all borrowing items for this archive.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function borrowingItems(): HasMany
    {
        return $this->hasMany(BorrowingItem::class);
    }

    /**
     * Scope a query to only include available archives.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope a query to only include borrowed archives.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBorrowed($query)
    {
        return $query->where('status', 'borrowed');
    }

    /**
     * Check if archive is available for borrowing.
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    /**
     * Mark archive as borrowed.
     *
     * @return bool
     */
    public function markAsBorrowed(): bool
    {
        return $this->update(['status' => 'borrowed']);
    }

    /**
     * Mark archive as available.
     *
     * @return bool
     */
    public function markAsAvailable(): bool
    {
        return $this->update(['status' => 'available']);
    }
}