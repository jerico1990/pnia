<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aprobacion_desembolso".
 *
 * @property integer $id
 * @property integer $id_nivelaprobacion
 * @property integer $id_solicitud
 * @property integer $estado
 *
 * @property NivelAprobacion $idNivelaprobacion
 * @property SolicitudDesembolso $idSolicitud
 */
class AprobacionDesembolso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aprobacion_desembolso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nivelaprobacion', 'id_solicitud', 'estado'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nivelaprobacion' => 'Id Nivelaprobacion',
            'id_solicitud' => 'Id Solicitud',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNivelaprobacion()
    {
        return $this->hasOne(NivelAprobacion::className(), ['id' => 'id_nivelaprobacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSolicitud()
    {
        return $this->hasOne(SolicitudDesembolso::className(), ['id' => 'id_solicitud']);
    }
}
