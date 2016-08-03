<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registro_meta".
 *
 * @property integer $id
 * @property integer $id_tipo
 * @property string $fecha
 * @property integer $id_user
 * @property integer $id_user_obs
 * @property string $observacion
 * @property integer $estado
 *
 * @property RegistroMetaDetalle[] $registroMetaDetalles
 */
class RegistroMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $id_indact;
    public $des_indact;
    public $cantidad;
    public $tipo;
    public $titulo;
    public $respuesta_aprob;
    public $id_meta;
    
    public static function tableName()
    {
        return 'registro_meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo', 'id_user', 'id_user_obs', 'estado'], 'integer'],
            [['id_indact','des_indact', 'cantidad','tipo','titulo','respuesta_aprob','id_meta'], 'safe'],
            [['fecha','fecha_aprobacion'], 'string', 'max' => 20],
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
            'id_tipo' => 'Id Tipo',
            'fecha' => 'Fecha',
            'id_user' => 'Id User',
            'id_user_obs' => 'Id User Obs',
            'observacion' => 'Observacion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistroMetaDetalles()
    {
        return $this->hasMany(RegistroMetaDetalle::className(), ['id_registrometa' => 'id']);
    }
}
