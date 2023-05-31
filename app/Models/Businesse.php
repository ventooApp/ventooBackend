<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Businesse extends Model
{
    use HasFactory;

                /**
     * Get the Paysetude for the blog post.
     */
    public function reductionproduits()
    {
        return $this->hasMany(Reductionproduit::class);
    }
}
