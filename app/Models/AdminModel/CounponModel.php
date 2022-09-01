<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounponModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_counpon';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'name',
        'slug',
        'type',
        'is_active',
        'value',
        'quantity',
        'time_start',
        'time_end',
        'created_at',
        'updated_at'
    ];
}
