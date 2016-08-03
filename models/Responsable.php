<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "responsable".
 *
 * @property integer $id_proyecto
 * @property string $nombres
 * @property string $apellidos
 * @property string $telefono
 * @property string $celular
 * @property string $correo
 *
 * @property Proyecto $idProyecto
 */
class Responsable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'responsable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'nombres'], 'required'],
            [['id_proyecto'], 'integer'],
            [['nombres', 'apellidos', 'correo'], 'string', 'max' => 200],
            [['telefono', 'celular'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_proyecto' => 'Id Proyecto',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'correo' => 'Correo',
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
