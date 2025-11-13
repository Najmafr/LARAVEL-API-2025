<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['product_category_id','name','description'];

    public function category_product(){
        return $this->hasMany(CategoryProduct::class);
    }
}
