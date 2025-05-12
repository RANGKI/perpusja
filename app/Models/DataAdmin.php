<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAdmin extends Model
{
    protected $table = 'data_admin';

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'image_path',
        'username',
        'email',
        'password'
    ];
}
