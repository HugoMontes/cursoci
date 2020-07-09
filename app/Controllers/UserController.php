<?php namespace App\Controllers;

// Importar la clase UserModel
use App\Models\UserModel;

class UserController extends BaseController{

    // Funciones del modelo para listar
    // find : Obtiene un unico registro
    // findAll : Muestra todos los registros excluidos los eliminados
    // WithDeleted : Muestra todos los registros incluidos los eliminados
    // onlyDeleted : Muestra unicamente los registros eliminados
	public function index(){
        // Instanciar un objeto del modelo
        $userModel = new UserModel();
        // Obtener todos los registros
        $users = $userModel->findAll();
        // var_dump($users);
        // Enviar los datos a una vista
        $data['users'] = $users;
        $data['title'] = 'Lista de Usuarios';
		return view('user/listar_view', $data);
    }
    
    // Mostrar formulario para ingresar nuevo registro
    public function nuevoAction(){
        // Llamar al helper para formularios
        // Tambien se podria definir en el constructor
        // o en BaseController
        helper('form');
        // Renderizar la vista para el formulario
        $data['title'] = 'Nuevo Usuario';
        return view('user/nuevo_view');
    }

    // Funciones del modelo para guardar y actualizar
    // insert : guarda un nuevo registro
    // update : actualiza un registro
    // save : guarda y actualiza dependiendo si tiene o no id
    public function guardarAction(){
        // Recibir los datos
        $request = \Config\Services::request();
        // var_dump($request->post());
        // Se invoca al metodo de validacion
        // $this->validarFormularioCurso();
        // Validar el formulario
        //if ($this->form_validation->run()){
          // post(): Retorna datos del formulario con formato:
          // array('nom_campo1'=>valor1,'nom_campo2'=>valor2)
          //$data = $this->input->post();
          // Se muestran los datos enviados desde el formulario
          //print_r($data);
        //}else{
          // Si existen errores de validacion, vuelve a mostrar el formulario
          //$this->nuevo();
        //}
    }

    // Funciones del modelo para eliminar
    // Dependiendo si el atributo $useSoftDeletes esta
    // activo o no permite eliminar
    // delete : elimina un registro (fisico/logico)
    // purgeDeleted : elimina de forma fisica 
    // los registros con valor en fecha de registro

    

}