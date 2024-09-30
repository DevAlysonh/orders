<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    public const STATUS_OPEN = 'open';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_FINISHED = 'finished';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'status',
        'total'
    ];

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => number_format(
                $value / 100,
                2,
                '.',
            ),
            set: fn (float $value) => $value * 100,
        );
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price');
    }
}
