<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SolicitudDesembolso;

/**
 * SolicitudDesembolsoSearch represents the model behind the search form about `app\models\SolicitudDesembolso`.
 */
class SolicitudDesembolsoSearch extends SolicitudDesembolso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'estado'], 'integer'],
            [['total'], 'number'],
            [['fecha_solicitud', 'fecha_aprobacion'], 'safe'],
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
    public function search($params,$valor)
    {
        if(Yii::$app->user->identity->id_perfil == 2)
        {
            if($valor == 1){
        $query = SolicitudDesembolso::find()->where('id_user = :id_user',[':id_user'=>Yii::$app->user->identity->id]);}
        
        if($valor == 2){
        $query = SolicitudDesembolso::find()->where('estado = 1 and id_user = :id_user',[':id_user'=>Yii::$app->user->identity->id]); }
        }
        else
        {
          $query = SolicitudDesembolso::find()
                        ->where('estado in(0,1)');  
        }
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
            'id_user' => $this->id_user,
            'total' => $this->total,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'fecha_solicitud', $this->fecha_solicitud])
            ->andFilterWhere(['like', 'fecha_aprobacion', $this->fecha_aprobacion]);

        return $dataProvider;
    }
}
