<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "category",
        "publisher",
        "cover",
        "type",
        "status"

    ];

    protected $primaryKey = 'id';

    public function episode():HasMany {
        return $this->hasMany(Episode::class, 'anime_id', 'id' );
    }

    
}
