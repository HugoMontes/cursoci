<?php

namespace App\Controllers;

// Importar la clase UserModel
use App\Models\UserModel;

class UserController extends BaseController
{

	// Funciones del modelo para listar
	// find : Obtiene un unico registro
	// findAll : Muestra todos los registros excluidos los eliminados
	// WithDeleted : Muestra todos los registros incluidos los eliminados
	// onlyDeleted : Muestra unicamente los registros eliminados
	public function index()
	{
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

	public function guardarAction()
	{
		// Instanciar un objeto del modelo
		$userModel = new UserModel();
		// Definir un array/objeto
		$data = array(
			'username' => 'fernando',
			'password' => MD5('123456'),
			'email' => 'fernando@gmail.com'
		);
		// Guardar
		$userModel->insert($data);
		// Mostrar un mensaje
		echo 'El usuario ' . $data['username'] . ' fue adicionado exitosamente.';
	}

	public function actualizarAction()
	{
		// Instanciar un objeto del modelo
		$userModel = new UserModel();
		// Definir un array/objeto
		$data = array(
			'username' => 'felix',
			'email' => 'felix@gmail.com'
		);
		// Modificar registro (id, datos)
		$userModel->update(5, $data);
		// Mostrar un mensaje
		echo 'El usuario ' . $data['username'] . ' fue editado exitosamente.';
	}

	public function eliminarAction($id)
	{
		// Instanciar un objeto del modelo
		$userModel = new UserModel();
		// Buscar el registro a eliminar
		if ($userModel->find($id)) {
			// Eliminar el registro
			$userModel->delete($id);
			// Mostrar un mensaje
			echo 'El usuario fue eliminado exitosamente.';
		} else {
			// Mostrar un mensaje
			echo 'No existe el usuario a eliminar';
		}
	}

	public function consultasAction($num)
	{
		// Instanciar un objeto del modelo
		$userModel = new UserModel();
		$title = '';
		if ($num == 1) {
			$title = 'Todos los registros excepto los eliminados';
			$users = $userModel->findAll();
		} else if ($num == 2) {
			$title = 'Todos los resgistros incluidos los eliminados logicamente';
			$users = $userModel->WithDeleted()->findAll();
		} else if ($num == 3) {
			$title = 'Unicamente registros eliminados logicamente';
			$users = $userModel->onlyDeleted()->findAll();
		} else if ($num == 4) {
			$title = 'Usuarios con nombre juan ordenados';
			$users = $userModel->where('username', 'juan')
				->orderBy('id', 'desc')
				->findAll();
		}
		// var_dump($users);
		$data['users'] = $users;
		$data['title'] = $title;
		return view('user/listar_view', $data);
	}

	public function nativaAction() {
		// Instanciar un objeto del modelo
		$userModel = new UserModel();
		// Invocar a la consulta
		$users = $userModel->obtenerUsuarios();
		foreach ($users as $user) {
			echo $user->id.",";
			echo $user->username.",";
			echo $user->email."<br>";
		}
		echo 'Total: ' . count($users);
	}

	// Mostrar formulario para ingresar nuevo registro
	public function nuevoAction()
	{
		// Llamar al helper para formularios
		// Tambien se podria definir en el constructor
		// o en BaseController
		helper('form');
		// Renderizar la vista para el formulario
		$data['title'] = 'Nuevo Usuario';
		return view('user/nuevo_view');
	}

	/*
    // Funciones del modelo para guardar y actualizar
    // insert : guarda un nuevo registro
    // update : actualiza un registro
    // save : guarda y actualiza dependiendo si tiene o no id
    public function guardarAction(){
        // Instanciar un objeto del modelo
        $userModel = new UserModel();
        // Instanciar un objeto request para recibir los datos
        $request = \Config\Services::request();
        // Obtener los datos enviados del formulario
        $data = $request->getPostGet();
        // Mostrar los datos
        // var_dump($request->getPostGet());
        // Cifrar el password
        $data['password'] = MD5($request->getPostGet('password'));
        // Guardar los datos
        if($userModel->insert($data)){
          // guardados
        }else{
          // Mostrar mensajes de error
          var_dump($userModel->errors());
        }

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
*/


	// Funciones del modelo para eliminar
	// Dependiendo si el atributo $useSoftDeletes esta
	// activo o no permite eliminar
	// delete : elimina un registro (fisico/logico)
	// purgeDeleted : elimina de forma fisica 
	// los registros con valor en fecha de registro



}
