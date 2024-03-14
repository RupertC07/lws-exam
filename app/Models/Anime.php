<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anime extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'anime_tbl'; //since our table naming is always extends 'tbl' we need to declare it


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


    //we declare relationship so the api can be fetch with episodes with an ease
    public function episode():HasMany {
        return $this->hasMany(Episode::class, 'anime_id', 'id' );
    }

    
}
