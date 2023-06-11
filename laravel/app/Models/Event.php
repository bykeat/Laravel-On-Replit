<?php

namespace App\Models;

use App\Events\EventCreated;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ["name", "slug", "start_at", "end_at"];
    protected $dispatchesEvents = [
        'created' => EventCreated::class
    ];
}
