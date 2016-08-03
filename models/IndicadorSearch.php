<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Indicador;

/**
 * IndicadorSearch represents the model behind the search form about `app\models\Indicador`.
 */
class IndicadorSearch extends Indicador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_oe', 'peso', 'programado'], 'integer'],
            [['descripcion', 'unidad_medida'], 'safe'],
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
        $query = Indicador::find();

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
            'id_oe' => $this->id_oe,
            'peso' => $this->peso,
            'programado' => $this->programado,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'unidad_medida', $this->unidad_medida]);

        return $dataProvider;
    }
}
