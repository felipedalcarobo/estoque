<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelProdutos extends Model
{
    protected $table = 'produtos';
    protected $fillable = [
    	'user', 'produto', 'sku', 'preco', 'created_at', 'updated_at'
    ];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user');
    }
}
