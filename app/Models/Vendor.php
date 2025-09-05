<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vendor extends Model
{
    /** @use HasFactory<\\Database\\Factories\\VendorFactory> */
    use HasFactory;

    protected $fillable = ['name','contact','fee','details','image'];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withPivot(['service_details','fee'])
            ->withTimestamps();
    }
}
