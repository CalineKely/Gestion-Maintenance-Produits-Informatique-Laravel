<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiel extends Model
{
    protected $fillable = [
        'description',
        'prix',
        'date_fin_garantie',
        'date_fin_services_apres_vente',
        'client_id',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}
