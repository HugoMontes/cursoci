<?php namespace App\Controllers;

class Persona_controller extends BaseController {
    
	public function index() {
    }
    
    public function mostrarDatosAction($nombre, $edad) {
        $data['nombre'] = $nombre;
        $data['edad'] = $edad;
        $data['observacion'] = $edad?'Mayor de edad':'Menor de edad';
        return view('persona/datos_view', $data);
    }

    public function datosLaboralesAction($cargo, $sueldo) {
        $data = array(
            'cargo'=>$cargo,
            'sueldo'=>$sueldo,
            'liquido_pagable'=>$sueldo-$sueldo*0.1
        );
        return view('persona/datos_laborales_view', $data);
    }

    public function listarAction() {
        $personas = array(
            array('id'=>1, 'nombre'=>'Mateo', 'edad'=>45),
            array('id'=>2, 'nombre'=>'Marcos', 'edad'=>15),
            array('id'=>3, 'nombre'=>'Lucas', 'edad'=>37),
            array('id'=>4, 'nombre'=>'Juan', 'edad'=>28)
        );
        $data['personas'] = $personas;
        return view('persona/lista_view', $data);
    }
}