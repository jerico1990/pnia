<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "observaciones".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $observacion
 * @property integer $id_user
 * @property string $fecha
 *
 * @property Proyecto $idProyecto
 * @property Usuarios $idUser
 */
class Observaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'observaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'id_user'], 'integer'],
            [['observacion'], 'string', 'max' => 7000],
            [['fecha'], 'string', 'max' => 20]
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
            'observacion' => 'Observacion',
            'id_user' => 'Id User',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_user']);
    }
}
