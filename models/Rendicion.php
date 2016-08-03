<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "rendicion".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $fecha
 * @property integer $id_solicitud
 * @property integer $estado
 *
 * @property DetalleRendicion[] $detalleRendicions
 * @property SolicitudDesembolso $idSolicitud
 * @property Usuarios $idUser
 */
class Rendicion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $cantidad;
    public $titulo;
    public $mes;
    public $total;
    
    public static function tableName()
    {
        return 'rendicion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user_obs','id_user', 'id_solicitud', 'estado'], 'integer'],
            [['cantidad','titulo','total','mes'], 'safe'],
            [['observacion'], 'string', 'max' => 7000],
            [['fecha','fecha_aprobacion'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Nro Rendición',
            'id_user' => 'Id User',
            'fecha' => 'Fecha',
            'id_solicitud' => 'Nro de Desembolso',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleRendicions()
    {
        return $this->hasMany(DetalleRendicion::className(), ['id_rendicion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSolicitud()
    {
        return $this->hasOne(SolicitudDesembolso::className(), ['id' => 'id_solicitud']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_user']);
    }
}
