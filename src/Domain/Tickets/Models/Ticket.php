<?php

namespace Domain\Tickets\Models;

use Database\Factories\TicketFactory;
use Domain\Flights\Models\Flight;
use Domain\Ticketshelves\Models\Ticketshelf;
use Domain\Genres\Models\Genre;
use Domain\Loans\Models\Loan;
use Domain\Reservations\Models\Reservation;
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

class Ticket extends Model implements HasMedia
{
    use HasFactory, HasUuids, SoftDeletes;
    use InteractsWithMedia;
    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return TicketFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'flight_id',
        'seats',
    ];

    protected $casts = [
        'created_at' => 'datetime:m/d/Y',
    ];

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class)->withTrashed();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }







}
