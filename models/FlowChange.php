<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flow_change".
 *
 * @property integer $id
 * @property integer $id_nuevo_proyecto
 * @property integer $id_ant_proyecto
 * @property integer $estado_flujo
 * @property string $next_url
 * @property integer $tipo_modificacion
 * @property integer $estado
 *
 * @property Proyecto $idNuevoProyecto
 */
class FlowChange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flow_change';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nuevo_proyecto', 'id_ant_proyecto', 'estado_flujo', 'tipo_modificacion', 'estado'], 'integer'],
            [['next_url'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nuevo_proyecto' => 'Id Nuevo Proyecto',
            'id_ant_proyecto' => 'Id Ant Proyecto',
            'estado_flujo' => 'Estado Flujo',
            'next_url' => 'Next Url',
            'tipo_modificacion' => 'Tipo Modificacion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNuevoProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_nuevo_proyecto']);
    }
}
