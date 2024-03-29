<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    /**
     * Obter produtos que possuam esse tamanho de roupa
     *
     * @return void
     */
    public function products() {
        return $this->hasMany(Product::class, 'size_id');
    }
}
