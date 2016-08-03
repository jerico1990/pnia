<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_solicitud".
 *
 * @property integer $id
 * @property integer $id_solicitud
 * @property integer $anio
 * @property integer $mes
 * @property string $monto
 * @property integer $estado
 *
 * @property SolicitudDesembolso $idSolicitud
 */
class DetalleSolicitud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detalle_solicitud';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_solicitud', 'anio', 'mes', 'estado'], 'integer'],
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
            'id_solicitud' => 'Id Solicitud',
            'anio' => 'Anio',
            'mes' => 'Mes',
            'monto' => 'Monto',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSolicitud()
    {
        return $this->hasOne(SolicitudDesembolso::className(), ['id' => 'id_solicitud']);
    }
}
