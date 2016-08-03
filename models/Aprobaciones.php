<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aprobaciones".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property integer $id_nivelaprobacion
 * @property integer $estado
 *
 * @property NivelAprobacion $idNivelaprobacion
 * @property Proyecto $idProyecto
 */
class Aprobaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aprobaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'id_nivelaprobacion', 'estado'], 'integer']
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
            'id_nivelaprobacion' => 'Id Nivelaprobacion',
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
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }
}
