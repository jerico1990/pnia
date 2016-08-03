<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "desembolso".
 *
 * @property integer $id
 * @property integer $nro_desembolso
 * @property integer $id_proyecto
 * @property integer $mes
 * @property integer $anio
 * @property string $monto
 * @property integer $porcentaje
 *
 * @property Proyecto $idProyecto
 */
class Desembolso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'desembolso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nro_desembolso', 'id_proyecto', 'mes', 'anio', 'porcentaje'], 'integer'],
            [['monto'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nro_desembolso' => 'Nro Desembolso',
            'id_proyecto' => 'Id Proyecto',
            'mes' => 'Mes',
            'anio' => 'Anio',
            'monto' => 'Monto',
            'porcentaje' => 'Porcentaje',
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
