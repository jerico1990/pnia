<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property integer $id
 * @property string $descripcion
 * @property integer $estado
 *
 * @property Accesos[] $accesos
 * @property Menus[] $idMenus
 * @property Usuarios[] $usuarios
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perfil';
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
    public function getAccesos()
    {
        return $this->hasMany(Accesos::className(), ['id_pefil' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMenus()
    {
        return $this->hasMany(Menus::className(), ['id' => 'id_menu'])->viaTable('accesos', ['id_pefil' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['id_perfil' => 'id']);
    }
}
