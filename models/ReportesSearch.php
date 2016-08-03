<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuarios;

/**
 * ReportesSearch represents the model behind the search form about `app\models\Usuarios`.
 */

 
class ReportesSearch extends Usuarios
{
    /**
     * @inheritdoc
     */
    public $presupuesto;
    
    public function rules()
    {
        return [
            [['id', 'id_perfil', 'ejecutora', 'dependencia', 'estado'], 'integer'],
            [['Name', 'username', 'password', 'img','titulo','presupuesto','department','recurso_total','vigencia','experimentos'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Usuarios::find()
                        ->select('proyecto.titulo,
	max(usuarios.username) as username,
	count(DISTINCT objetivo_especifico.id) as obj_esp ,
	count(DISTINCT indicador.id) as indicador ,
	count(DISTINCT actividad.id) as actividad,
	count(DISTINCT recurso.id) as recurso,
        ubigeo.department,
        proyecto.vigencia,
	(select maestros.descripcion from maestros where maestros.id = proyecto.id_dependencia_inia) as operativa,
	(select maestros.descripcion from maestros where maestros.id = proyecto.id_unidad_ejecutora) as ejecutora2,
	(select maestros.descripcion from maestros where maestros.id = proyecto.id_direccion_linea) as linea,
        (select aportante.monetario from aportante where aportante.id_proyecto = proyecto.id and aportante.tipo = 1) as presupuesto,
	sum(recurso.precio_total) as recurso_total')
                                ->innerJoin('proyecto','proyecto.user_propietario = usuarios.id')
                                ->leftJoin('objetivo_especifico','objetivo_especifico.id_proyecto = proyecto.id')
                                ->leftJoin('indicador','indicador.id_oe = objetivo_especifico.id')
                                ->leftJoin('actividad','actividad.id_ind = indicador.id')
                                ->leftJoin('recurso','recurso.actividad_id = actividad.id')
                                ->leftJoin('ubigeo','ubigeo.district_id = proyecto.ubigeo')
                                ->where('proyecto.estado = 1')
                                ->groupBy(['proyecto.titulo'])
                                ->orderBy('username');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_perfil' => $this->id_perfil,
            'ejecutora' => $this->ejecutora,
            'dependencia' => $this->dependencia,
            'estado' => $this->estado,
            'operativa' => $this->operativa,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'operativa', $this->operativa])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
