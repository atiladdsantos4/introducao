<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arquivo extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_arquivo'; //--> customizar nome da PK <--//
    use HasFactory;

    public function cliente(){
        return $this->hasOne(arquivo::class,'id_arquivo');
    }

}
