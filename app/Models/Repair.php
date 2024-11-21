<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Repair extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_repair';
    protected $guarded = [];

    // Accessor สำหรับการแปลงรูปแบบวันที่ created_at เป็นภาษาไทย
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->thaidate('j M y H:i:s');
    }
    // Accessor สำหรับการแปลงรูปแบบวันที่ updated_at เป็นภาษาไทย
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->thaidate('j M y H:i:s');
    }

    public function imageRepair(): HasMany
    {
        return $this->hasMany(ImageRepair::class, 'id_repair');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'department_id', 'type');
    }

    public function follow()
    {
        return $this->hasMany(RepairFollow::class, 'repair_id');
    }

}
