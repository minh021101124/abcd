<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    // use HasFactory;
    // protected $fillable = ['product_name', 'quantity', 'price', 'total_amount'];

    // public function infor()
    // {
    //     return $this->belongsTo(Infor::class, 'infors_id');
    // }
    use HasFactory;

    protected $fillable = ['product_name', 'quantity', 'price', 'total_amount', 'infors_id'];

    // Định nghĩa mối quan hệ nhiều-một với Infor
    public function infor()
    {
        return $this->belongsTo(Infor::class, 'infors_id');
    }
}
