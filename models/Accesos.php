<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accesos".
 *
 * @property integer $id_pefil
 * @property integer $id_menu
 * @property integer $estado
 *
 * @property Perfil $idPefil
 * @property Menus $idMenu
 */
class Accesos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accesos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pefil', 'id_menu', 'estado'], 'required'],
            [['id_pefil', 'id_menu', 'estado'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pefil' => 'Id Pefil',
            'id_menu' => 'Id Menu',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPefil()
    {
        return $this->hasOne(Perfil::className(), ['id' => 'id_pefil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMenu()
    {
        return $this->hasOne(Menus::className(), ['id' => 'id_menu']);
    }
}
