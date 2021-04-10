<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifable;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table='student';
    protected $primaryKey='nim';

    protected $fillable = [
        'Nim',
        'Name',
        'Class',
        'Major',
        'address',
        'birth_date',
    ];
};
