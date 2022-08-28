<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_article';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'title',
        'slug',
        'path_image',
        'description',
        'is_active',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function author(){
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }
}
