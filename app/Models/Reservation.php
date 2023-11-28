<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum ReservationType: string {
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case CANCELED = 'canceled';
}

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'reservation_date', 'expiration_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isActive() {
        return $this->status == ReservationType::ACTIVE->value;
    }

    public function isCanceled() {
        return $this->status == ReservationType::CANCELED->value;
    }

    public function isExpired() {
        return $this->status == ReservationType::EXPIRED->value;
    }
}
