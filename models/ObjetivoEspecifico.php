<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objetivo_especifico".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $descripcion
 * @property integer $peso
 * @property integer $estado
 *
 * @property Indicador[] $indicadors
 * @property Proyecto $idProyecto
 */
class ObjetivoEspecifico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objetivo_especifico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto'], 'required'],
            [['id_proyecto', 'peso', 'estado','gestion'], 'integer'],
            [['descripcion'], 'string', 'max' => 2000]
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
            'descripcion' => 'Descripcion',
            'peso' => 'Peso',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicadors()
    {
        return $this->hasMany(Indicador::className(), ['id_oe' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }
}
