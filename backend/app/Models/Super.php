<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Super extends Model
{
    protected $guarded = [];
 use  HasFactory, Notifiable,HasApiTokens ;
}
