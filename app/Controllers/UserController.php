<?php namespace App\Controllers;

// Importar la clase UserModel
use App\Models\UserModel;

class UserController extends BaseController {

	public function index() {
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
    
    // Funciones del modelo
    // find : Obtiene un unico registro
    // findAll : Muestra todos los registros excluidos los eliminados
    // WithDeleted : Muestra todos los registros incluidos los eliminados
    // onlyDeleted : Muestra unicamente los registros eliminados
}