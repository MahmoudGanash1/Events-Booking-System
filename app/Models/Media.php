<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use SoftDeletes;

       protected $fillable = [
        'file_name',
        'file_path',

    ];



    public function mediable(){
        return $this->morphTo();
    }
}
