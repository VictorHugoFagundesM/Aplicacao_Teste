<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    
    protected $fillable = [
        'name', 
    ];

    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }


    /**
     * Pesquisa por categorias
     *
     * @param [type] $search
     * @return void
     */
    public function scopeSearch($query, $search) {

        if ($search) {
            $query->where('name', 'ilike', '%'.$search.'%');
        }

        return $query;

    }

}
