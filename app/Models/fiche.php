<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fiche extends Model
{
    protected $fillable = [
        'client_id',
        'materiel_id',
        'probleme',
        'date_depot',
        'date_recup',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function materiel(){
        return $this->belongsTo(Materiel::class);
    }
}
