<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\dkdn;
class dondathang extends Model
{
   
    use HasFactory;
    protected $table = 'dondathangs';
    protected $primaryKey = 'id';
    protected $guarded = [
      'hovaten',
      'diachi',
      'tinh',
      'quanhuyen',
      'phuongxa',
      'sdt',
      'thongtinbosung',
      'pttt',
      'sanpham',
      'dkdn_id',
      'thanhtien',
      'tinhtrangdon',
    
      
      
    ];
    public function dkdn()
    {
        return $this->belongsTo(dkdn::class, 'dkdn_id');
    }
    
}
