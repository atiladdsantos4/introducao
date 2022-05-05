<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function getAvatar()
    {
        //return $this->belongsTo(arquivo::class,'id_arquivo');
        return $this->hasOne(arquivo::class,'id_arquivo');
    }

    public function arquivo()
    {
        return $this->belongsTo(arquivo::class,'id_arquivo');
        // $arq = $this->hasOne(arquivo::class,'id_arquivo');
        // return $arq;
    }
}
