<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servant extends Model
{
    use HasFactory;

     //
    protected $fillable =['admin_id','name', 'address'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }


}
