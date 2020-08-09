<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelEstoque extends Model
{
    protected $table = 'estoque';
    protected $fillable = [
    	'id_produto', 'quantidade', 'created_at', 'updated_at'
    ];


    public function produtos() {
        return $this->hasMany(ModelProdutos::class, 'id', 'id_produto');
    }


}
