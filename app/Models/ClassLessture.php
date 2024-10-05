<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLessture extends Model
{
    use HasFactory;
    protected  $primaryKey=['lessture_id','class_id'];

    public function lesstures()
    {
        return $this->hasMany(Lessture::class);
    }
}
