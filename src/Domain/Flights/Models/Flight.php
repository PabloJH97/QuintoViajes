<?php

namespace Domain\Flights\Models;

use Database\Factories\FlightFactory;
use Domain\Flightshelves\Models\Flightshelf;
use Domain\Genres\Models\Genre;
use Domain\Loans\Models\Loan;
use Domain\Planes\Models\Plane;
use Domain\Reservations\Models\Reservation;
use Domain\Tickets\Models\Ticket;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Type\Integer;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Flight extends Model implements HasMedia
{
    use HasFactory, HasUuids, SoftDeletes;
    use InteractsWithMedia;
    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return FlightFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'code',
        'plane_id',
        'origin',
        'destination',
        'price',
        'seats',
        'date',
        'state'
    ];

    public function plane(): BelongsTo
    {
        return $this->belongsTo(Plane::class)->withTrashed();
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class)->withTrashed();
    }


}
