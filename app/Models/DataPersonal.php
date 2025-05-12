<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPersonal extends Model
{
    protected $table = 'data_personals';

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'image_path',
        'username',
        'email',
        'password',
        'phone_number'
    ];

    public function pinjaman() {
        return $this->hasMany(DataPinjaman::class, 'user_id');
    }

}
