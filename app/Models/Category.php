<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Menu;
class Category extends Model
{
    use HasFactory;

    //
    protected $fillable =['tile', 'slug'];
    
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    } 

}
