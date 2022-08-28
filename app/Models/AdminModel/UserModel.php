<?php

namespace App\Models\AdminModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $guards = 'admin';
    protected $table = 'tbl_user';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'name',
        'role_id',
        'email',
        'password',
        'path_image',
        'phone',
        'address',
        'city_id',
        'district_id',
        'ward_id',
        'created_at',
        'updated_at'
    ];

    public function role(){
        return $this->hasOne(RoleModel::class, 'id', 'role_id');
    }

    public function superAdmin(){
        return $this->role_id === 1 ;
    }
}
