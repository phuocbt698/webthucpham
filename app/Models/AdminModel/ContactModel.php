<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_contact';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'name',
        'email',
        'phone',
        'content',
        'status',
        'created_at',
        'updated_at'
    ];
}
