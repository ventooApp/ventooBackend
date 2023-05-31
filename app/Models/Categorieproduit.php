<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorieproduit extends Model
{
    use HasFactory;

            /**
     * Get the Paysetude for the blog post.
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
            /**
     * Get the Paysetude for the blog post.
     */
    public function reductionproduits()
    {
        return $this->hasMany(Reductionproduit::class);
    }
}
