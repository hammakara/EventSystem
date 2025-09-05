<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Event extends Model
{
    /** @use HasFactory<\\Database\\Factories\\EventFactory> */
    use HasFactory;

    protected $fillable = ['title','type','scheduled_at','organizer_id','venue_id','image'];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
        ];
    }

    // Query Scopes for better performance
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('scheduled_at', '>=', now());
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where('scheduled_at', '<', now());
    }

    public function scopeToday(Builder $query): Builder
    {
        $today = Carbon::today();
        return $query->whereBetween('scheduled_at', [$today, $today->copy()->endOfDay()]);
    }

    public function scopeWithBasicRelations(Builder $query): Builder
    {
        return $query->with(['organizer:id,name', 'venue:id,name,address']);
    }

    public function scopeWithFullDetails(Builder $query): Builder
    {
        return $query->with(['organizer', 'venue', 'attendees:id,name,contact', 'vendors:id,name,contact']);
    }

    // Optimized relationships
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Organizer::class)->select('id', 'name', 'email', 'role');
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class)->select('id', 'name', 'address', 'contact');
    }

    public function attendees(): BelongsToMany
    {
        return $this->belongsToMany(Attendee::class)
            ->withPivot(['status'])
            ->withTimestamps()
            ->select('attendees.id', 'attendees.name', 'attendees.contact');
    }

    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class)
            ->withPivot(['service_details','fee'])
            ->withTimestamps()
            ->select('vendors.id', 'vendors.name', 'vendors.contact');
    }

    // Accessor for revenue calculation
    public function getTotalRevenueAttribute(): float
    {
        return $this->vendors->sum('pivot.fee') ?? 0;
    }

    // Accessor for attendee count (cached)
    public function getAttendeeCountAttribute(): int
    {
        return $this->attendees()->count();
    }
}
