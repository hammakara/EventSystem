<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organizer extends Model
{
    /** @use HasFactory<\\Database\\Factories\\OrganizerFactory> */
    use HasFactory;

    protected $fillable = ['name','address','email','role','image'];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
