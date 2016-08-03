<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accion_transversal".
 *
 * @property integer $id_proyecto
 * @property integer $id_accion_transversal
 * @property string $otros
 *
 * @property Proyecto $idProyecto
 */
class AccionTransversal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_transversal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto'], 'required'],
            [['id_proyecto', 'id_accion_transversal'], 'integer'],
            [['otros'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_proyecto' => 'Id Proyecto',
            'id_accion_transversal' => 'Id Accion Transversal',
            'otros' => 'Otros',
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
