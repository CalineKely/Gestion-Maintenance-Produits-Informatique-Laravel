<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    protected $fillable = [
        'client_id',
        'date_facturation',
        'montant',
        'materiel_id',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function materiel(){
        return $this->belongsTo(Materiel::class);
    }
}
