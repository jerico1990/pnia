<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ubigeo".
 *
 * @property integer $id
 * @property string $department_id
 * @property string $province_id
 * @property string $district_id
 * @property string $pais
 * @property string $department
 * @property string $province
 * @property string $district
 * @property string $pais_id
 * @property double $latitude
 * @property double $longitud
 * @property string $district_id_standart
 */
class Ubigeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ubigeo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'district_id'], 'required'],
            [['id'], 'integer'],
            [['latitude', 'longitud'], 'number'],
            [['department_id'], 'string', 'max' => 2],
            [['province_id', 'pais_id'], 'string', 'max' => 4],
            [['district_id', 'district_id_standart'], 'string', 'max' => 6],
            [['pais', 'province', 'district'], 'string', 'max' => 100],
            [['department'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_id' => 'Department ID',
            'province_id' => 'Province ID',
            'district_id' => 'District ID',
            'pais' => 'Pais',
            'department' => 'Department',
            'province' => 'Province',
            'district' => 'District',
            'pais_id' => 'Pais ID',
            'latitude' => 'Latitude',
            'longitud' => 'Longitud',
            'district_id_standart' => 'District Id Standart',
        ];
    }
}
