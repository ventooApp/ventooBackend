<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

        /**
     * Get the Experiences for the blog post.
     */
    public function categorieactualite()
    {
        return $this->belongsTo(Categorieactualite::class);
    }
}
