<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','price','sale_price','image','category_id','description','slug'];
    /**
     * The category that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ImgProduct::class);
    }

    public function getDiscountPercentage()
    {
        // Kiểm tra nếu giá gốc là 0 hoặc giá giảm giá lớn hơn hoặc bằng giá gốc
        if ($this->price == 0 || $this->sale_price >= $this->price) {
            return 0; // Trả về 0 nếu không có giảm giá hoặc giảm giá không hợp lệ
        }

        // Tính phần trăm giảm giá
        $discountPercentage = (($this->price - $this->sale_price) / $this->price) * 100;

        // Làm tròn phần trăm giảm giá đến 2 chữ số thập phân
        return round($discountPercentage, 2);
    }
    public function categorySlug() {
        return $this->category->slug;
    }
    
   
}
