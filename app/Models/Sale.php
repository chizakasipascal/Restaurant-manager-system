<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Table;
use App\Models\Servant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    //

    protected $fillable = [
                            "user_id", "quantity", "price","total",
                            "change", "payment_type", "payment_status"
                            ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    public function tables()
    {
        return $this->belongsToMany(Table::class);
    }

    public function servant()
    {
        return $this->belongsTo(Servant::class);
    }
}
