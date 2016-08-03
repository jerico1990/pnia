<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zona_accion".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $id_distrito
 * @property string $zona
 *
 * @property Proyecto $idProyecto
 */
class ZonaAccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zona_accion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto'], 'integer'],
            [['id_distrito'], 'string', 'max' => 6],
            [['zona'], 'string', 'max' => 200]
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
            'id_distrito' => 'Id Distrito',
            'zona' => 'Zona',
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
