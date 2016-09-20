<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "detalle_rendicion".
 *
 * @property integer $id
 * @property integer $id_rendicion
 * @property integer $id_clasificador
 * @property integer $id_recurso
 * @property string $descripcion
 * @property integer $mes
 * @property integer $anio
 * @property integer $cantidad
 * @property string $precio_unit
 * @property string $total
 * @property string $ruc
 * @property string $razon_social
 *
 * @property Rendicion $idRendicion
 */
class DetalleRendicion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $clasificador_id;
    public $id_ren;
    public $respuesta_aprob;
    public $detalle_ids;
    public $observacion;
    public $archivos;
    public $recursos;
    public $tipos_documentos;
    public $nros_documentos;
    public $fechas;
    public $observaciones;
    public $obj_des;
    public $act_des;
    public $detalle;
    public $recurso_id;
    public static function tableName()
    {
        return 'detalle_rendicion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_rendicion', 'id_clasificador', 'id_recurso', 'mes', 'anio','recursos'], 'integer'],
            [['precio_unit', 'total', 'cantidad'], 'number'],
            [['clasificador_id','id_ren','respuesta_aprob','detalle_ids','observacion'],'safe'],
            [['razon_social'], 'string', 'max' => 200],
            [['descripcion'], 'string', 'max' => 3000],
            [['ruc'], 'string', 'max' => 20],
            [['archivos'], 'file', 'maxFiles' => 100],
            [['tipos_documentos','nros_documentos','fechas','observaciones'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_rendicion' => 'Id Rendicion',
            'id_clasificador' => 'Id Clasificador',
            'id_recurso' => 'Id Recurso',
            'descripcion' => 'Descripcion',
            'mes' => 'Mes',
            'anio' => 'Anio',
            'cantidad' => 'Cantidad',
            'precio_unit' => 'Precio Unit',
            'total' => 'Total',
            'ruc' => 'Ruc',
            'razon_social' => 'Razon Social',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRendicion()
    {
        return $this->hasOne(Rendicion::className(), ['id' => 'id_rendicion']);
    }
    
    public function GetMes($mes)
    {
        switch($mes)
        {
            case 1: $des_mes = "Enero"; break;
            case 2: $des_mes = "Febrero"; break;
            case 3: $des_mes = "Marzo"; break;
            case 4: $des_mes = "Abril"; break;
            case 5: $des_mes = "Mayo"; break;
            case 6: $des_mes = "Junio"; break;
            case 7: $des_mes = "Julio"; break;
            case 8: $des_mes = "Agosto"; break;
            case 9: $des_mes = "Setiembre"; break;
            case 10: $des_mes = "Octubre"; break;
            case 11: $des_mes = "Noviembre"; break;
            case 12: $des_mes = "Diciembre"; break;
        }
        return $des_mes;
    }
}
