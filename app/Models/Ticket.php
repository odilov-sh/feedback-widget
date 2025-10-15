<?php

namespace App\Models;

use App\Enums\TicketStatusEnum;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model implements HasMedia
{
    use HasFactory;

    use InteractsWithMedia;

    protected $fillable = [
        'subject',
        'customer_id',
        'text',
        'status',
        'responded_at',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    protected function casts(): array
    {
        return [
            'responded_at' => 'timestamp',
            'status'       => TicketStatusEnum::class,
        ];
    }
}
