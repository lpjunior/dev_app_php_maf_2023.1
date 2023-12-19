<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

enum UserType: string {
    case CLIENT = 'client';
    case ADMIN = 'admin';
}

class User extends Authenticatable implements MustVerifyEmailContract, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return $this->type === UserType::ADMIN->value;
    }

    public function isClient(): bool
    {
        return $this->type === UserType::CLIENT->value;
    }

    // relacionamento entre Livro e Reserva
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // relacionamento entre Livro e Emprestimo
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    // relacionamento entre Livro e Avaliacao
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function incrementFailedReservations(): void
    {
        $this->increment('failed_reservations_count');
        if($this->failed_reservations_count >= 3)
        {
            $this->reservation_ban_until = Carbon::now()->addDays(30);
            $this->failed_reservations_count = 0;
        }

        $this->save();
    }

    public function canReserveBook(): bool
    {
        return $this->reservation_ban_until === null || $this->reservation_ban_until->isPast();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
