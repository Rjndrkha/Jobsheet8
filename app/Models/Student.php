<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Student as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Student extends Model
{
    use HasFactory;

    protected $table = "student";
    //public $timestamps= false; 
    protected  $primaryKey = 'nim';

    protected $fillable = [
        'nim',
        'name',
        'class_id',
        'major',
        //'address',
        //'email',
        
    ];
    public function class(){
        return $this->belongsTo(ClassModel::class);

}
}