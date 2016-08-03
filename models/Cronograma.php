<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cronograma".
 *
 * @property integer $id_actividad
 * @property integer $mes
 * @property integer $estado
 *
 * @property Actividad $idActividad
 */
class Cronograma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cronograma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id_actividad', 'mes'], 'required'],
            [['id','id_actividad',  'estado'], 'integer'],
            [['mes'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_actividad' => 'Id Actividad',
            'mes' => 'Mes',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdActividad()
    {
        return $this->hasOne(Actividad::className(), ['id' => 'id_actividad']);
    }
}
