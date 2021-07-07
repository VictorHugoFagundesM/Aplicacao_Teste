<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'amount',
        'description',
        'category_id',
        'size_id',
        'color_id',
    ];

    /**
     * Obter categoria do produto
     *
     * @return void
     */
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * Obter tamanho do produto
     *
     * @return void
     */
    public function Size() {
        return $this->belongsTo('App\Models\Size', 'size_id');
    }

    /**
     * Obter color do produto
     *
     * @return void
     */
    public function Color() {
        return $this->belongsTo('App\Models\Color', 'color_id');
    }

    public function scopeSearch($query, Request $request) {

        //$sql = "select * from products";

        $query->join("categories as c", "c.id", "products.category_id")
        ->join("colors as c2", "c2.id", "products.color_id")
        ->join("sizes as s", "s.id", "products.size_id");

        $query->select(
            "products.*",
            "c.name as category_name",
            "c2.name as color_name",
            "s.name as size_name",
        );

        if ($request->search) {

            $query->where('products.name', 'ilike', '%'.$request->search.'%')
            ->orWhere('c.name', 'ilike', '%'.$request->search.'%')
            ->orWhere('c2.name', 'ilike', '%'.$request->search.'%');
        }

        // TODO...
        if ($request->category_id) {

        }

        $query->orderBy("products.id", "asc");
        
        //die($query->toSql());
        return $query;
    }
}
