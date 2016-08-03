<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adquisicion_det".
 *
 * @property integer $id
 * @property integer $id_adquisicion
 * @property integer $id_tipo_equipo
 * @property string $id_motivo
 * @property integer $cantidad
 *
 * @property Adquisicion $idAdquisicion
 */
class Dashboard extends \yii\db\ActiveRecord
{
}