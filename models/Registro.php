<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Registro extends Model
{
    
    
    public function rules()
    {
        return [
            [['id_tipo_proyecto', 'user_propietario', 'estado','id_proyecto'], 'integer'],
            [['presupuesto'], 'number'],
            [['titulo', 'ind_prob', 'med_prob', 'sup_prob', 'ind_prop', 'med_prop', 'sup_prop'], 'string', 'max' => 500],
            [['direccion_linea', 'estacion_exp', 'sub_estacion_exp', 'desc_tipo_proy','nombres', 'apellidos', 'correo'], 'string', 'max' => 200],
            [['resumen_ejecutivo', 'relevancia'], 'string', 'max' => 9000],
            [['objetivo_general'], 'string', 'max' => 4000],
            [['plan_trabajo', 'resultados_esperados'], 'string', 'max' => 8000],
            [['referencias_bibliograficas'], 'string', 'max' => 10000],
            [['problematica', 'proposito'], 'string', 'max' => 5000],
            [['telefono', 'celular'], 'string', 'max' => 20]
        ];
    }
    
}