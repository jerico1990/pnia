<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aportante".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $colaborador
 * @property integer $regimen
 * @property integer $tipo_inst
 * @property integer $tipo
 * @property string $monetario
 * @property string $no_monetario
 * @property string $total
 *
 * @property Proyecto $idProyecto
 * @property Recurso[] $recursos
 */
class Aportante extends \yii\db\ActiveRecord
{
    public $aportante_ids;
    public $proyecto_id;
    public $aporte_colaborador;
    public $aporte_tipo;
    public $aporte_monetario;
    public $aporte_nomonetario;
    public $desembolsos_ids;
    public $desembolsos_nro;
    public $desembolsos_mes;
    public $desembolsos_anio;
    public $desembolsos_montos;
    public $desembolsos_porcentaje;
    public $cerrar_modificacion;
    public $observacion;
    
    public static function tableName()
    {
        return 'aportante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'regimen', 'tipo_inst', 'tipo'], 'integer'],
            [['monetario', 'no_monetario', 'total'], 'number'],
            [['aportante_ids','proyecto_id','aporte_colaborador','aporte_nomonetario','aporte_monetario','aporte_tipo','observacion',
              'desembolsos_ids','desembolsos_nro','desembolsos_mes','desembolsos_anio','desembolsos_montos','desembolsos_porcentaje','cerrar_modificacion'],'safe'],
            [['colaborador'], 'string', 'max' => 200]
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
            'colaborador' => 'Colaborador',
            'regimen' => 'Regimen',
            'tipo_inst' => 'Tipo Inst',
            'tipo' => 'Tipo',
            'monetario' => 'Monetario',
            'no_monetario' => 'No Monetario',
            'total' => 'Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecursos()
    {
        return $this->hasMany(Recurso::className(), ['fuente' => 'id']);
    }
}
