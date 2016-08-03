<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "colaborador".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $nombres
 * @property string $apellidos
 * @property string $funcion
 *
 * @property Proyecto $idProyecto
 */
class Colaborador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'colaborador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'nombres'], 'required'],
            [['id_proyecto'], 'integer'],
            [['nombres', 'apellidos', 'funcion'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto' => 'Id Proyecto',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'funcion' => 'Funcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }
}
