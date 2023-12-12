<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author','isbn','year_published','quantity', 'cover_url'];
    
    /**
     * Atributos que devem ser convertidos para tipos nativos
     */
    protected $casts = [
                        'year_published' => 'integer',
                        'quantity' => 'integer'
                    ];
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
}
