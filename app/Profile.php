<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = 
    [
        "user_id",
        "no_telepon",
        "biodata",
        "jenis_kelamin",
        "tempat_lahir",
        "tanggal_lahir",
        "asal_sekolah",
        "skill",
        "kota",
        "github",
        "instagram",
        "facebook"
    ];

    public function user(){
        return $this->belongsTo("App\User",'user_id');
    }
}
