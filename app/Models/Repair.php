<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Repair extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_repair';
    protected $guarded = [];

    public function imageRepair(): HasMany
    {
        return $this->hasMany(ImageRepair::class,'id_repair');
    }
}
