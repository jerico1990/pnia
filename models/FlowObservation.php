<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flow_observation".
 *
 * @property integer $id
 * @property integer $id_flow
 * @property integer $id_user
 * @property string $descripcion
 *
 * @property FlowChange $idFlow
 * @property Usuarios $idUser
 */
class FlowObservation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $name;
    public $img;
    public $username;
    public static function tableName()
    {
        return 'flow_observation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_flow', 'id_user'], 'integer'],
            [['descripcion'], 'string', 'max' => 6000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_flow' => 'Id Flow',
            'id_user' => 'Id User',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFlow()
    {
        return $this->hasOne(FlowChange::className(), ['id' => 'id_flow']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_user']);
    }
}
