<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reductionproduit extends Model
{
    use HasFactory;

                /**
     * Get the Experiences for the blog post.
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

                /**
     * Get the Experiences for the blog post.
     */
    public function businesse()
    {
        return $this->belongsTo(Businesse::class);
    }

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
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

                /**
     * Get the Experiences for the blog post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
