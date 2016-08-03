<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registro_meta_detalle".
 *
 * @property integer $id
 * @property integer $id_registrometa
 * @property integer $id_indact
 * @property string $des_indact
 * @property integer $cantidad
 *
 * @property RegistroMeta $idRegistrometa
 */
class RegistroMetaDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registro_meta_detalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_registrometa', 'id_indact', 'cantidad'], 'integer'],
            [['des_indact'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_registrometa' => 'Id Registrometa',
            'id_indact' => 'Id Indact',
            'des_indact' => 'Des Indact',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRegistrometa()
    {
        return $this->hasOne(RegistroMeta::className(), ['id' => 'id_registrometa']);
    }
}
