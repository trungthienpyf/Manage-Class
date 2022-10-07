<?php

namespace App\Models;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model  implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use HasFactory;
   protected $fillable=['name','phone','password','level'];

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
   }
}
