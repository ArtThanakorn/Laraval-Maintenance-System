<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageRepair extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_image';
    protected $fillable = [
        'id_repair',
        'nameImage',
        'status',
    ];

    public function repair()
    {
        return $this->belongsTo(Repair::class,'id_repair');
    }
}
