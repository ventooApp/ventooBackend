<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

            /**
     * Get the Paysetude for the blog post.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function commandeproduits()
    {
        return $this->hasMany(Commandeproduit::class);
    }
}
