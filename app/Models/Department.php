<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $primaryKey = 'department_id';
    protected $guarded = [];

    public function employees(){
        return $this->hasOne(User::class, 'department', 'department_id');
    }
}


