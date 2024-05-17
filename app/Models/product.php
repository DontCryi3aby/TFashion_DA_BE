<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public $timestamps = FALSE;
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $guarded = [
      'hinhanh',
      'title',
      'gia',
      'category_id',
    ];

    public function category()
    {
    	return $this->belongsto(category::class,'category_id');
    }

    public function detail()
    {
    	return $this->belongsto(detail::class,'product_id','id');
    }

    public function cart()
    {
    	return $this->hasMany(cart::class, 'product_id');
    }
    
}
