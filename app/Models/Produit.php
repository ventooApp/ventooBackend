<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable  = [
        'status',
    ];

            /**
     * Get the Experiences for the blog post.
     */
    public function categorieproduit()
    {
        return $this->belongsTo(Categorieproduit::class);
    }
    

            /**
     * Get the Experiences for the blog post.
     */
    public function produit()
    {
        return $this->belongsTo('App\Models\Produit');
    }
    

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

                /**
     * Get the Paysetude for the blog post.
     */
    public function reductionproduits()
    {
        return $this->hasMany(Reductionproduit::class);
    }
}
