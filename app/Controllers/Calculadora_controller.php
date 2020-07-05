<?php namespace App\Controllers;

// Importar la libreria
use App\Libraries\Rectangulo;

class Calculadora_controller extends BaseController {

	public function index(){
    }
    
    public function calculosAritemicosAction($valora, $valorb){
        // Invocar al helper
        helper('calculadora');
        $data['valora'] = $valora;
        $data['valorb'] = $valorb;
        return view('calculadora/helper_view',$data);
    }

    public function calculosGeometricosAction($base, $altura){
        // Instanciar a la libreria
        $rectangulo = new Rectangulo($base, $altura);
        // Crear las variables para la vista
        $data['perimetro'] = $rectangulo->getPerimetro();
        $data['area'] = $rectangulo->getArea();
        // Invocar a la vista
        return view('calculadora/libreria_view',$data);
    }
}