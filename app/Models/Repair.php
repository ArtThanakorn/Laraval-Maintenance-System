<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_repair';
    protected $fillable = [
        'status',
        'name',
        'type',
        'details',
        'site',
        'email',
        'number',
        'status_repair',
    ];
}
