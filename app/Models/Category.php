<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id','name','parent_id','status'];
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    //quan he 1-n
    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id')->orderBy('created_at','DESC');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    // Category.php (Model) or CategoryService.php (Service Class)

public static function getNestedCategories($parent_id = null)
{
    $categories = Category::where('parent_id', $parent_id)->get();

    $nestedCategories = [];
    
    foreach ($categories as $category) {
        $category->children = self::getNestedCategories($category->id);
        $nestedCategories[] = $category;
    }

    return $nestedCategories;
}
public function childrenCategories()
{
    return $this->hasMany(Category::class, 'parent_id', 'id');
}

public function allChildrenCategories()
{
    return $this->childrenCategories()->with('allChildrenCategories');
}

  
}
