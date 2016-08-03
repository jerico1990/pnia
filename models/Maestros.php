<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maestros".
 *
 * @property integer $id
 * @property integer $id_padre
 * @property string $descripcion
 * @property integer $orden
 * @property integer $tipo
 * @property integer $estado
 */
class Maestros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maestros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'descripcion', 'estado'], 'required'],
            [['id', 'id_padre', 'orden', 'tipo', 'estado'], 'integer'],
            [['descripcion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_padre' => 'Id Padre',
            'descripcion' => 'Descripcion',
            'orden' => 'Orden',
            'tipo' => 'Tipo',
            'estado' => 'Estado',
        ];
    }
}
