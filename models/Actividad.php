<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividad".
 *
 * @property integer $id
 * @property integer $id_ind
 * @property string $descripcion
 * @property integer $id_bid
 * @property integer $peso
 * @property string $unidad_medida
 * @property string $meta
 * @property integer $programado
 * @property string $fecha_inicio
 * @property string $fecha_fin
 *
 * @property Indicador $idInd
 * @property Cronograma[] $cronogramas
 * @property Recurso[] $recursos
 */
class Actividad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ind'], 'required'],
            [['ejecutado','estado','id_ind', 'id_bid', 'peso'], 'integer'],
            [['descripcion'], 'string', 'max' => 3000],
            [['unidad_medida'], 'string', 'max' => 100],
            [['meta'], 'string', 'max' => 200],
            [['fecha_inicio', 'fecha_fin'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ind' => 'Id Ind',
            'descripcion' => 'Descripcion',
            'id_bid' => 'Id Bid',
            'peso' => 'Peso',
            'unidad_medida' => 'Unidad Medida',
            'meta' => 'Meta',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'ejecutado' => 'Ejecutado',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInd()
    {
        return $this->hasOne(Indicador::className(), ['id' => 'id_ind']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCronogramas()
    {
        return $this->hasMany(Cronograma::className(), ['id_actividad' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecursos()
    {
        return $this->hasMany(Recurso::className(), ['actividad_id' => 'id']);
    }
}
