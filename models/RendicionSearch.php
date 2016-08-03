<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rendicion;

/**
 * RendicionSearch represents the model behind the search form about `app\models\Rendicion`.
 */
class RendicionSearch extends Rendicion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_solicitud', 'estado'], 'integer'],
            [['fecha'], 'safe'],
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
    public function search($params,$id,$user)
    {
        if(Yii::$app->user->identity->id_perfil == 2)
        {
        $query = Rendicion::find()->where('id_user = :id_user',[':id_user'=>Yii::$app->user->identity->id]);
        }
        else
        {
            if($id == 1)
            {
                $query = Rendicion::find()
                        ->select('rendicion.id_user as id, proyecto.titulo as titulo ,count(rendicion.estado) as cantidad')
                                ->innerJoin('proyecto','proyecto.user_propietario=rendicion.id_user')
                                ->where('proyecto.estado = 1 and rendicion.estado = 0 and proyecto.id_unidad_ejecutora =:id_unidad_ejecutora',[":id_unidad_ejecutora"=>Yii::$app->user->identity->ejecutora])
                                ->groupBy(['proyecto.id']);
                                
                
            }
            else
            {
                $query = Rendicion::find()->where('estado = 0 and id_user = :id_user',[':id_user'=>$user]);
            }
            
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
            'id_solicitud' => $this->id_solicitud,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'fecha', $this->fecha]);

        return $dataProvider;
    }
}
