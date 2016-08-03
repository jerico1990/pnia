<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rendicion_archivo".
 *
 * @property integer $id
 * @property string $archivo
 * @property string $fecha_registro
 * @property integer $estado
 * @property integer $rendicion_id
 */
class RendicionArchivo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rendicion_archivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_registro'], 'safe'],
            [['estado', 'rendicion_id'], 'integer'],
            [['archivo'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'archivo' => 'Archivo',
            'fecha_registro' => 'Fecha Registro',
            'estado' => 'Estado',
            'rendicion_id' => 'Rendicion ID',
        ];
    }
}
