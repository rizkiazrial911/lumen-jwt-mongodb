<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Eloquent
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $collection = 'items';
    protected $guarded = [];
    // protected $fillable = [
    //     "title", "price", "created_by"
    // ];
    // public $primaryKey = 'id_item';
}
