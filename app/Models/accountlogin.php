<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class accountlogin extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $table = 'accountlogin';
    protected $primaryKey = 'id';
    protected $guarded = [
      'email',
      'password',
     
      
    ];
}
