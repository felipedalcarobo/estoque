<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelRelatorios extends Model
{
    protected $table = 'relatorios';
    protected $fillable = [
    	'id_produto', 'quantidade_movimentacao', 'tipo_movimentacao', 'canal', 'created_at', 'updated_at'
    ];


    public function produtos() {
        return $this->hasMany(ModelProdutos::class, 'id', 'id_produto');
    }
}
