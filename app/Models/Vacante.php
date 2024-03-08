<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacante extends Model
{
    use HasFactory;
    protected $casts = [ 'ultimo_dia'=>'date'];
    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //salario y categoria pertenecen a otro modelo con esto lo relacionas 
    public function categoria(){
        return $this->BelongsTo(Categoria::class);
    }

    public function salario(){
        return $this->BelongsTo(Salario::class);
    }

    public function candidatos(){
        return $this->hasMany(Candidato::class)->orderBy('created_at', 'DESC');
    }

    public function reclutador(){
        return $this->BelongsTo(User::class, 'user_id');
    }
}
