<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuarios;

/**
<<<<<<< HEAD
 * UsuariosSearch represents the model behind the search form about `app\models\Usuarios`.
=======
 * UbigeoSearch represents the model behind the search form about `app\models\Usuarios`.
>>>>>>> 6a4012ce8b432cf3dee830211093ae03c6094858
 */
class UsuariosSearch extends Usuarios
{
    /**
     * @inheritdoc
     */
    public $descripcion;
    public function rules()
    {
        return [


            [['id', 'estado'], 'integer'],
            [['Name', 'username', 'password', 'img','id_perfil','descripcion'], 'safe'],
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

        $query = Usuarios::find()->innerJoin('perfil','perfil.id=usuarios.id_perfil');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([

            'usuarios.id' => $this->id,
            //'usuarios.estado' => $this->estado,
            
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'perfil.descripcion', $this->id_perfil])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            //->andFilterWhere(['like', [1=>'Activo',0=>'Inactivo'], $this->estado])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
