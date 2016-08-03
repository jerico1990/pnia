<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alianza_estrategica".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $institucion
 * @property string $descripcion
 * @property string $nombres
 * @property string $apellidos
 * @property string $correo
 * @property string $telefono
 *
 * @property Proyecto $idProyecto
 */
class AlianzaEstrategica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alianza_estrategica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto'], 'integer'],
            [['institucion', 'descripcion'], 'string', 'max' => 200],
            [['nombres', 'apellidos', 'correo'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto' => 'Id Proyecto',
            'institucion' => 'Institucion',
            'descripcion' => 'Descripcion',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'correo' => 'Correo',
            'telefono' => 'Telefono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }
}
