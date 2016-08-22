<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;
use yii\db\Query;
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
    
    
    public function getRendiciones($sort,$id,$user)
    {
        //total_equipos province   total_alumnos  district  total_equipos_nofinalizado latitude  total_alumnos_nofinalizado longitud
        $query = new Query;
        
        if(Yii::$app->user->identity->id_perfil == 2)
        {
        //$query = Rendicion::find()->where('id_user = :id_user',[':id_user'=>Yii::$app->user->identity->id]);
        
        $query
                ->select('rendicion.*,(select sum(detalle_rendicion.total) from detalle_rendicion where detalle_rendicion.id_rendicion=rendicion.id) as total')
                ->from('rendicion')
                ->where('id_user = :id_user',[':id_user'=>Yii::$app->user->identity->id])
                ->orderBy($sort);
        }
        else
        {
            if($id == 1)
            {
                $query
                ->select('rendicion.id_user as id, proyecto.titulo as titulo ,count(rendicion.estado) as cantidad,(select sum(detalle_rendicion.total) from detalle_rendicion where detalle_rendicion.id_rendicion=rendicion.id) as total')
                ->from('rendicion')
                ->innerJoin('proyecto','proyecto.user_propietario=rendicion.id_user')
                ->where('proyecto.estado = 1 and rendicion.estado = 0 and proyecto.id_unidad_ejecutora =:id_unidad_ejecutora',[":id_unidad_ejecutora"=>Yii::$app->user->identity->ejecutora])
                ->groupBy(['proyecto.id'])
                ->orderBy($sort);
            }
            else
            {
                $query
                ->select('rendicion.*,(select sum(detalle_rendicion.total) from detalle_rendicion where detalle_rendicion.id_rendicion=rendicion.id) as total')
                ->from('rendicion')
                ->where('estado = 0 and id_user = :id_user',[':id_user'=>$user])
                ->orderBy($sort);
            }
            
        }
        
        $result = Yii::$app->tools->Pagination($query,10);
        
        return ['rendiciones' => $result['result'], 'pages' => $result['pages']];
    }
}
