<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RepairFollow extends Model
{
    use HasFactory;
    protected $table = "repair_follows";

    protected $primaryKey = "id";

    protected $guarded = [];

    // Accessor สำหรับการแปลงรูปแบบวันที่ created_at เป็นภาษาไทย
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->thaidate('j M y');
    }
    // Accessor สำหรับการแปลงรูปแบบวันที่ updated_at เป็นภาษาไทย
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->thaidate('j M y');
    }
}
