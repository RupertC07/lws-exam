<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Episode extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'anime_id',
        'title',
        'description',
        'cover',
        'season',
        'episode',
    ];

    protected $table = 'episodes_tbl'; //since our table naming is always extends 'tbl' we need to declare it



    //declare relationship for easy data fetching
    public function anime():BelongsTo {
        return $this->belongsTo(Anime::class,'anime_id', 'id');
    }


}
