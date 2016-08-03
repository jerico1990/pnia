<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetalleSolicitud;

/**
 * DetalleSolicitudSearch represents the model behind the search form about `app\models\DetalleSolicitud`.
 */
class DetalleSolicitudSearch extends DetalleSolicitud
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_solicitud', 'anio', 'mes', 'estado'], 'integer'],
            [['monto'], 'number'],
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
    public function search($params,$id)
    {
        $query = DetalleSolicitud::find()
                    ->where('id_solicitud =:id_solicitud',[':id_solicitud'=>$id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_solicitud' => $this->id_solicitud,
            'anio' => $this->anio,
            'mes' => $this->mes,
            'monto' => $this->monto,
            'estado' => $this->estado,
        ]);

        return $dataProvider;
    }
}
