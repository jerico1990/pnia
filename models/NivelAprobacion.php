<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_aprobacion".
 *
 * @property integer $id
 * @property integer $id_actividad
 * @property integer $id_perfil
 * @property integer $orden
 * @property integer $estado
 *
 * @property Aprobaciones[] $aprobaciones
 * @property Perfil $idPerfil
 */
class NivelAprobacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel_aprobacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividad', 'id_perfil', 'orden', 'estado'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_actividad' => 'Id Actividad',
            'id_perfil' => 'Id Perfil',
            'orden' => 'Orden',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprobaciones()
    {
        return $this->hasMany(Aprobaciones::className(), ['id_nivelaprobacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPerfil()
    {
        return $this->hasOne(Perfil::className(), ['id' => 'id_perfil']);
    }
}
