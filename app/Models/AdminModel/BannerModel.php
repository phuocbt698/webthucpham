<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_banner';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'title',
        'slug',
        'path_image',
        'description',
        'is_active',
        'type',
        'time_start',
        'time_end',
        'created_at',
        'updated_at'
    ];
}
