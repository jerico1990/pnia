<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recurso_programado".
 *
 * @property integer $id
 * @property integer $id_recurso
 * @property integer $anio
 * @property integer $mes
 * @property integer $cantidad
 * @property integer $cant_rendida
 * @property integer $estado
 *
 * @property Recurso $idRecurso
 */
class RecursoProgramado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $cantidad2;
    public $solicita;
    public $clasificador_id;
    public $descripcion;
    public $detalle;
    public $id_clasificador;
    
    public static function tableName()
    {
        return 'recurso_programado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_recurso', 'anio', 'mes', 'estado'], 'integer'],
            [['precio_unit', 'precio_unit_rendido', 'cantidad', 'cant_rendida'], 'number'],
            [['id_clasificador','detalle','cantidad2','solicita','clasificador_id','descripcion'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_recurso' => 'Id Recurso',
            'anio' => 'Anio',
            'mes' => 'Mes',
            'cantidad' => 'Cantidad',
            'cant_rendida' => 'Cant Rendida',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRecurso()
    {
        return $this->hasOne(Recurso::className(), ['id' => 'id_recurso']);
    }
}
