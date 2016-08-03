<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto".
 *
 * @property integer $id
 * @property string $titulo
 * @property integer $vigencia
 * @property string $ubigeo
 * @property integer $id_direccion_linea
 * @property integer $id_unidad_ejecutora
 * @property integer $id_dependencia_inia
 * @property integer $id_tipo_proyecto
 * @property string $desc_tipo_proy
 * @property integer $id_programa
 * @property integer $id_cultivo
 * @property integer $id_especie
 * @property integer $id_areatematica
 * @property string $resumen_ejecutivo
 * @property string $relevancia
 * @property string $objetivo_general
 * @property string $plan_trabajo
 * @property string $resultados_esperados
 * @property string $presupuesto
 * @property string $referencias_bibliograficas
 * @property string $problematica
 * @property string $ind_prob
 * @property string $med_prob
 * @property string $sup_prob
 * @property string $proposito
 * @property string $ind_prop
 * @property string $med_prop
 * @property string $sup_prop
 * @property integer $user_propietario
 * @property integer $estado
 *
 * @property AccionTransversal $accionTransversal
 * @property AlianzaEstrategica[] $alianzaEstrategicas
 * @property Aportante[] $aportantes
 * @property CultivoCrianza[] $cultivoCrianzas
 * @property Desembolso[] $desembolsos
 * @property LugarInvestigacion[] $lugarInvestigacions
 * @property ObjetivoEspecifico[] $objetivoEspecificos
 * @property Usuarios $userPropietario
 * @property Responsable $responsable
 * @property ZonaAccion[] $zonaAccions
 */
class Proyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vigencia', 'id_direccion_linea', 'id_unidad_ejecutora', 'id_dependencia_inia', 'id_tipo_proyecto', 'id_programa', 'id_cultivo', 'id_especie', 'id_areatematica', 'user_propietario', 'estado'], 'integer'],
            [['presupuesto'], 'number'],
            [['titulo', 'ind_prob', 'med_prob', 'sup_prob', 'ind_prop', 'med_prop', 'sup_prop'], 'string', 'max' => 500],
            [['ubigeo'], 'string', 'max' => 6],
            [['desc_tipo_proy'], 'string', 'max' => 200],
            [['resumen_ejecutivo', 'relevancia'], 'string', 'max' => 9000],
            [['objetivo_general'], 'string', 'max' => 4000],
            [['plan_trabajo', 'resultados_esperados'], 'string', 'max' => 8000],
            [['referencias_bibliograficas'], 'string', 'max' => 10000],
            [['problematica', 'proposito'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'vigencia' => 'Vigencia',
            'ubigeo' => 'Ubigeo',
            'id_direccion_linea' => 'Id Direccion Linea',
            'id_unidad_ejecutora' => 'Id Unidad Ejecutora',
            'id_dependencia_inia' => 'Id Dependencia Inia',
            'id_tipo_proyecto' => 'Id Tipo Proyecto',
            'desc_tipo_proy' => 'Desc Tipo Proy',
            'id_programa' => 'Id Programa',
            'id_cultivo' => 'Id Cultivo',
            'id_especie' => 'Id Especie',
            'id_areatematica' => 'Id Areatematica',
            'resumen_ejecutivo' => 'Resumen Ejecutivo',
            'relevancia' => 'Relevancia',
            'objetivo_general' => 'Objetivo General',
            'plan_trabajo' => 'Plan Trabajo',
            'resultados_esperados' => 'Resultados Esperados',
            'presupuesto' => 'Presupuesto',
            'referencias_bibliograficas' => 'Referencias Bibliograficas',
            'problematica' => 'Problematica',
            'ind_prob' => 'Ind Prob',
            'med_prob' => 'Med Prob',
            'sup_prob' => 'Sup Prob',
            'proposito' => 'Proposito',
            'ind_prop' => 'Ind Prop',
            'med_prop' => 'Med Prop',
            'sup_prop' => 'Sup Prop',
            'user_propietario' => 'User Propietario',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionTransversal()
    {
        return $this->hasOne(AccionTransversal::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlianzaEstrategicas()
    {
        return $this->hasMany(AlianzaEstrategica::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAportantes()
    {
        return $this->hasMany(Aportante::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCultivoCrianzas()
    {
        return $this->hasMany(CultivoCrianza::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesembolsos()
    {
        return $this->hasMany(Desembolso::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugarInvestigacions()
    {
        return $this->hasMany(LugarInvestigacion::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivoEspecificos()
    {
        return $this->hasMany(ObjetivoEspecifico::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPropietario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'user_propietario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable()
    {
        return $this->hasOne(Responsable::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZonaAccions()
    {
        return $this->hasMany(ZonaAccion::className(), ['id_proyecto' => 'id']);
    }
}
