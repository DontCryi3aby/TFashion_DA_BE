<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    public $timestamps = FALSE;
    use HasFactory;
    protected $table = 'detail';
    protected $primaryKey = 'id';
    protected $guarded = [
  
   
      'tinhtrang',
    
      'chatlieu',
      'themanhsp',
      'product_id',
    ];


    public function product()
    {
    	return $this->hasOne(product::class,'id','product_id');
    }

    public function cart()
    {
    	return $this->hasMany(cart::class,'detail_id','id');
    }
}
