<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    //
    protected $fillable = ["user_id","title", "slug", "description", "image", "price", "category_id"];

     public function category()
    {
        return $this->belongsTo(Category::class,'user_id');
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }
}
