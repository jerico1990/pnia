<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RecursoProgramado;
use app\models\Recurso;

/**
 * DesembolsoSearch represents the model behind the search form about `app\models\RecursoProgramado`.
 */
class DesembolsoSearch extends RecursoProgramado
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_recurso', 'anio', 'mes', 'cantidad', 'cant_rendida', 'estado'], 'integer'],
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
        $query = RecursoProgramado::find()
                        ->select('recurso_programado.anio, recurso_programado.mes, sum(recurso.precio_unit*recurso_programado.cantidad) as cantidad, recurso_programado.estado')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and aportante.tipo = 1 and recurso_programado.estado = 0',[':user_propietario'=>Yii::$app->user->identity->id])
                                ->groupBy(['recurso_programado.anio', 'recurso_programado.mes'])
                                ->orderBy(['recurso_programado.anio'=>SORT_ASC, 'recurso_programado.mes'=>SORT_ASC])
                                ->limit(10);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 6],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_recurso' => $this->id_recurso,
            'anio' => $this->anio,
            'mes' => $this->mes,
            'cantidad' => $this->cantidad,
            'cant_rendida' => $this->cant_rendida,
            'estado' => $this->estado,
        ]);

        return $dataProvider;
    }
}
