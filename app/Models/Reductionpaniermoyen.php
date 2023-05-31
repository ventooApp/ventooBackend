<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reductionpaniermoyen extends Model
{
    use HasFactory;

                /**
     * Get the Experiences for the blog post.
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
