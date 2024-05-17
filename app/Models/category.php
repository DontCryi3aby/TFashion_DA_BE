<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public $timestamps = FALSE;
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $guarded = [
      'namecategory',
      
    ];

    public function product()
    {
    	return $this->hasMany(product::class);
    }
}
