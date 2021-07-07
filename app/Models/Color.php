<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    /**
     * Obter produtos que possuam essa cor de roupa
     *
     * @return void
     */
    public function products() {
        return $this->hasMany(Product::class, 'color_id');
    }
}
