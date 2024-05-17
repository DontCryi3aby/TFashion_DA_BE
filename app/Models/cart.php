<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    public $timestamps = FALSE;
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $guarded = [
      'title',
      'size',
      'gia',
      'soluong',
      'tong',
      'detail_id',
      'dkdn_id'
      
    ];

    public function detail()
    {
        return $this->belongsTo(detail::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function dkdn()
{
    return $this->belongsTo('App\Models\dkdn');
}
  

   
}
