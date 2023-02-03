<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table extends Model
{
    use HasFactory;
    //
    protected $fillable =['name','status','slug'];

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }
    
    public function getRouteKeyName()
    {
        return "slug";
    }
}
