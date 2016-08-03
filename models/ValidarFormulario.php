<?php

namespace app\models;

use yii;
use yii\base\model;


class ValidarFormulario extends model
{
    public $nombre;
    public $email;
    
    public function rules()
    {
       return[
              ['nombre','required','message'=>'Campo Requerido'],
              ['nombre','match','pattern'=>"/^.{3,50}$/",'message'=>"Minimo de 3 y maximo de 50 Caracteres"],
              ['nombre','match','pattern'=>"/^.[0-9a-z]+$/",'message'=>"Solo Letras y Numeros"],
              ['email','required','message'=>'Campo Requerido'],
              ['email','match','pattern'=>"/^.{5,80}$/",'message'=>"Minimo de 5 y maximo de 80 Caracteres"],
              ['email','email','message'=>"Formato no Valido"],
              
              ]; 
    }
    
    public function attributeLabels()
    {
        return [
                'nombre' => 'Nombre:',
                'email' => 'Email:',
                ];
    }
}
