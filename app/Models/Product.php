<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $primaryKey = "id";
    protected $guarded = [];
    // protected $fillable = [
    //     'name',
    //     'description',
    //     'content',
    //     'menu_id',
    //     'price',
    //     'price_sale',
    //     'thumb'
    // ];

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')
            ->withDefault(['name' => '']);
    }
}