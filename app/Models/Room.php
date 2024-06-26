<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = "rooms";

    protected $primaryKey = "id";

    protected $guarded = [];

    public function detail(){
        return $this->hasMany(RoomDetails::class, 'room_id', 'id');
    }
}
