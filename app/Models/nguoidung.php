<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nguoidung extends Model
{
    public $timestamps = FALSE;
    use HasFactory;
    protected $table = 'nguoidung';
    protected $primaryKey = 'id';
    protected $guarded = [
      'name',
      'email',
      'password',
    ];

    
}
