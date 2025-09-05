<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attendee extends Model
{
    /** @use HasFactory<\\Database\\Factories\\AttendeeFactory> */
    use HasFactory;

    protected $fillable = ['name','contact','status','preferences','image'];

    protected function casts(): array
    {
        return [
            'preferences' => 'array',
        ];
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withPivot(['status'])
            ->withTimestamps();
    }
}
