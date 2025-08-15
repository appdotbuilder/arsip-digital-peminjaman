<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\BorrowingItem
 *
 * @property int $id
 * @property int $borrowing_id
 * @property int $archive_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $returned_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Borrowing $borrowing
 * @property-read \App\Models\Archive $archive
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem whereArchiveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem whereBorrowingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem whereReturnedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem borrowed()
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowingItem returned()
 * @method static \Database\Factories\BorrowingItemFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class BorrowingItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'borrowing_id',
        'archive_id',
        'status',
        'returned_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'borrowing_id' => 'integer',
        'archive_id' => 'integer',
        'returned_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the borrowing that owns this item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrowing(): BelongsTo
    {
        return $this->belongsTo(Borrowing::class);
    }

    /**
     * Get the archive that owns this item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function archive(): BelongsTo
    {
        return $this->belongsTo(Archive::class);
    }

    /**
     * Scope a query to only include borrowed items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBorrowed($query)
    {
        return $query->where('status', 'borrowed');
    }

    /**
     * Scope a query to only include returned items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }

    /**
     * Mark item as returned.
     *
     * @return bool
     */
    public function markAsReturned(): bool
    {
        return $this->update([
            'status' => 'returned',
            'returned_at' => now(),
        ]);
    }
}