<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cultivo_crianza".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property integer $tipo
 *
 * @property Proyecto $idProyecto
 */
class CultivoCrianza extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cultivo_crianza';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto'], 'required'],
            [['id_proyecto', 'tipo'], 'integer']
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
            'tipo' => 'Tipo',
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
