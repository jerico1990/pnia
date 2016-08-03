<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id
 * @property string $Name
 * @property string $username
 * @property string $password
 */
class Usuarios extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public $authKey;
    public $descripcion;
    public $mid;
    public $ruta;
    public $titulo;
    public $id_perfil2;
    public $nuevo_proyecto;
    public $presupuesto;
    public $department;
    public $recurso_total;
    public $obj_esp;
    public $indicador;
    public $actividad;
    public $recurso;
    public $operativa;
    public $linea;
    public $ejecutora2;
    public $vigencia;
    public $experimentos;
    
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id'], 'required'],
            [['id','id_perfil','estado','ejecutora','dependencia'], 'integer'],
	    [['descripcion','titulo','id_perfil2','nuevo_proyecto','presupuesto','department','recurso_total',
	      'experimentos','vigencia','obj_esp','indicador','actividad','recurso','operativa','linea','ejecutora2'], 'safe'],
            [['Name', 'username', 'password','img'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
            'img' => 'Img',
	    'descripcion' => 'Descripcion'
        ];
    }
    
    public function getPerfil()
    {
        return $this->hasOne(Perfil::className(), ['id' => 'id_perfil']);
    }
    
    
    public static function findIdentity($id){
		return static::findOne($id);
	}
 
	public static function findIdentityByAccessToken($token, $type = null){
		throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
	}
 
	public function getId(){
		return $this->id;
	}
 
	public function getAuthKey(){
		return $this->authKey;//Here I return a value of my authKey column
                //throw new NotSupportedException();
	}
 
	public function validateAuthKey($authKey){
		return $this->authKey === $authKey;
                //throw new NotSupportedException();
	}
	public static function findByUsername($username){
		//return self::findOne(['username'=>$username]);
            return static::find()->where('username=:username and estado=1',[':username' => $username])->one();
	}
 
	public function validatePassword($password,$username){
		//return $this->password === $password;
            return static::find()->where('password=:password and username=:username and estado=1',[':password' => $password,':username' => $username])->one();
	}
	
	
	public static function roleInArray($arr_role)
	{
	return in_array(Yii::$app->user->identity->role, $arr_role);
	}
	
	public static function isActive()
	{
	return Yii::$app->user->identity->status == self::STATUS_ACTIVE;
	}
    
}
