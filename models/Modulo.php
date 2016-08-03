<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modulo".
 *
 * @property integer $id
 * @property string $descripcion
 * @property integer $estado
 *
 * @property Menus[] $menuses
 */
class Modulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'estado'], 'required'],
            [['estado'], 'integer'],
            [['descripcion'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuses()
    {
        return $this->hasMany(Menus::className(), ['id_modulo' => 'id']);
    }
}
