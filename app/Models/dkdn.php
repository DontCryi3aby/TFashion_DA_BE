<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class dkdn extends Model
{
  use HasApiTokens;
    public $timestamps = FALSE;
    use HasFactory;
    protected $table = 'dkdn';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable  = [
      'name',
      'sdt',
      'email',
      'password',
    
      
    ];
    public function cart()
    {
        return $this->hasMany('App\Models\cart');
    }
    public function dondathang()
    {
        return $this->hasMany(dondathang::class, 'dkdn_id');
    }
}
