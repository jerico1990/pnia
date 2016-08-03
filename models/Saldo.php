<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "saldo".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $saldo
 * @property integer $id_desembolso
 * @property integer $estado
 */
class Saldo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saldo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_desembolso', 'estado'], 'integer'],
            [['saldo'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'saldo' => 'Saldo',
            'id_desembolso' => 'Id Desembolso',
            'estado' => 'Estado',
        ];
    }
}
