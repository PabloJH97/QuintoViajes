<?php

namespace Domain\Users\Models;

use Domain\Users\Models\UserSetting;

use Database\Factories\UserFactory;
use Domain\Books\Models\Book;
use Domain\Loans\Models\Loan;
use Domain\Reservations\Models\Reservation;
use Domain\Users\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable, SoftDeletes, HasUuids;

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }
    //use HasApiTokens

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the settings associated with the user.
     */
    public function settings(): HasOne
    {
        return $this->hasOne(UserSetting::class, 'user_id');
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_user', 'user_id', 'book_id')->withTrashed();
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class)->with('book')->withTrashed();
    }

    public function activeLoans(): HasMany
    {
        return $this->hasMany(Loan::class)->where('borrowed', true)->with('book');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class)->with('book')->withTrashed();
    }
}
