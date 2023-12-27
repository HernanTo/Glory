<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use HasFactory, sluggable;

    protected $fillable = [
        'title',
        'body',
        'path',
        'slug',
        'is_active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }
    public function getDescSmallAttribute(){
        $val = "El mantenimiento regular de un vehículo es esencial para su rendimiento y longevidad, y una tarea crítica es el cambio periódico de aceites. Estos desempeñan funciones vitales de lubricación, enfriamiento y limpieza en el motor, pero se degradan con el tiempo. El cambio regular de aceites es crucial para eliminar residuos acumulados y mantener el motor en óptimas condiciones. Los beneficios incluyen mayor eficiencia, control de temperaturas y prolongación de la vida útil. Se recomienda realizar el cambio cada 5,000 a 7,500 kilómetros, según el tipo de aceite y las condiciones de conducción, con la sugerencia de consultar el manual del propietario para pautas específicas.";

        if(strlen($val) > 30){
            return substr($val, 0, 180) . '...';
        }else{
            return $val;
        }
    }
}
