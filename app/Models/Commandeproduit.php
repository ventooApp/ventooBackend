<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandeproduit extends Model
{
    use HasFactory;

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

}
