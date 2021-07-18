<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_id',
    'name',
    
   
];public function subcategory(){
    return  $this->hasMany(SubCategory::class);
  }
}