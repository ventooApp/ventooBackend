<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorieactualite extends Model
{
    use HasFactory;

        /**
     * Get the Paysetude for the blog post.
     */
    public function actualites()
    {
        return $this->hasMany(Actualite::class);
    }
}
