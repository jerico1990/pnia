<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menus".
 *
 * @property integer $id
 * @property integer $id_padre
 * @property integer $id_modulo
 * @property string $descripcion
 * @property string $ruta
 * @property integer $visible
 * @property integer $estado
 *
 * @property Accesos[] $accesos
 * @property Perfil[] $idPefils
 * @property Modulo $idModulo
 */
class Menus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_padre', 'id_modulo', 'descripcion', 'ruta', 'estado'], 'required'],
            [['id_padre', 'id_modulo', 'visible', 'estado'], 'integer'],
            [['descripcion'], 'string', 'max' => 200],
            [['ruta'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_padre' => 'Id Padre',
            'id_modulo' => 'Id Modulo',
            'descripcion' => 'Descripcion',
            'ruta' => 'Ruta',
            'visible' => 'Visible',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesos()
    {
        return $this->hasMany(Accesos::className(), ['id_menu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPefils()
    {
        return $this->hasMany(Perfil::className(), ['id' => 'id_pefil'])->viaTable('accesos', ['id_menu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdModulo()
    {
        return $this->hasOne(Modulo::className(), ['id' => 'id_modulo']);
    }
}
