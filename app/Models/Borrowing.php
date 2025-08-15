<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Borrowing
 *
 * @property int $id
 * @property string $borrowing_number
 * @property int $borrower_id
 * @property string $borrower_name
 * @property string|null $borrower_photo
 * @property int $district_id
 * @property int $village_id
 * @property \Illuminate\Support\Carbon $borrow_date
 * @property \Illuminate\Support\Carbon $return_date
 * @property \Illuminate\Support\Carbon|null $actual_return_date
 * @property string $status
 * @property string|null $notes
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $borrower
 * @property-read \App\Models\User|null $approver
 * @property-read \App\Models\District $district
 * @property-read \App\Models\Village $village
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BorrowingItem> $items
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereActualReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereBorrowDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereBorrowerDd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereBorrowerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereBorrowerPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereBorrowingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereVillageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing overdue()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing pending()
 * @method static \Database\Factories\BorrowingFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Borrowing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'borrowing_number',
        'borrower_id',
        'borrower_name',
        'borrower_photo',
        'district_id',
        'village_id',
        'borrow_date',
        'return_date',
        'actual_return_date',
        'status',
        'notes',
        'approved_by',
        'approved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'borrower_id' => 'integer',
        'district_id' => 'integer',
        'village_id' => 'integer',
        'approved_by' => 'integer',
        'borrow_date' => 'date',
        'return_date' => 'date',
        'actual_return_date' => 'date',
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the borrower that owns this borrowing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    /**
     * Get the approver that owns this borrowing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the district that owns this borrowing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the village that owns this borrowing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * Get all borrowing items for this borrowing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(BorrowingItem::class);
    }

    /**
     * Scope a query to only include overdue borrowings.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverdue($query)
    {
        return $query->where('return_date', '<', now())
                    ->whereIn('status', ['approved', 'borrowed', 'partially_returned']);
    }

    /**
     * Scope a query to only include pending borrowings.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Check if borrowing is overdue.
     *
     * @return bool
     */
    public function isOverdue(): bool
    {
        return $this->return_date->isPast() && in_array($this->status, ['approved', 'borrowed', 'partially_returned']);
    }

    /**
     * Generate borrowing number.
     *
     * @return string
     */
    public static function generateBorrowingNumber(): string
    {
        $prefix = 'BRW';
        $date = now()->format('Ymd');
        $sequence = str_pad((string)(static::whereDate('created_at', today())->count() + 1), 4, '0', STR_PAD_LEFT);
        
        return $prefix . $date . $sequence;
    }
}