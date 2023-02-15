<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Menu;
class Category extends Model
{
    use HasFactory;

    //
    protected $fillable =['admin_id','title', 'slug'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

}
