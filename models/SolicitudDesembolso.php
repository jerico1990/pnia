<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "solicitud_desembolso".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $total
 * @property string $fecha_solicitud
 * @property string $fecha_aprobacion
 * @property string $observacion
 * @property integer $estado
 *
 * @property AprobacionDesembolso[] $aprobacionDesembolsos
 * @property DetalleSolicitud[] $detalleSolicituds
 * @property Usuarios $idUser
 */
class SolicitudDesembolso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $respuesta_aprob;
    public $id_sol;
    
    public static function tableName()
    {
        return 'solicitud_desembolso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'estado','id_user_obs'], 'integer'],
            [['total','total_pendiente'], 'number'],
            [['respuesta_aprob','id_sol'], 'safe'],
            [['fecha_solicitud', 'fecha_aprobacion'], 'string', 'max' => 20],
            [['observacion'], 'string', 'max' => 7000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'total' => 'Total (S/.)',
            'total_pendiente' => 'Saldo (S/.)',
            'fecha_solicitud' => 'Fecha Solicitud',
            'fecha_aprobacion' => 'Fecha Aprobacion',
            'observacion' => 'Observacion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprobacionDesembolsos()
    {
        return $this->hasMany(AprobacionDesembolso::className(), ['id_solicitud' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleSolicituds()
    {
        return $this->hasMany(DetalleSolicitud::className(), ['id_solicitud' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_user']);
    }
}
