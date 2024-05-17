<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
  public $timestamps = FALSE;
    use HasFactory;
    protected $table = 'checkouts';
    protected $primaryKey = 'id';
    protected $guarded = [];
}