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
	public function newAction(){
		// Llamar al helper para formularios
		// Tambien se podria definir en el constructor
		// o en BaseController
		helper('form');
		// Renderizar la vista para el formulario
		$data['title'] = 'Nuevo Usuario';
		return view('user/nuevo_view', $data);
	}

	
    // Funciones del modelo para guardar y actualizar
    // insert : guarda un nuevo registro
    // update : actualiza un registro
    // save : guarda y actualiza dependiendo si tiene o no id
    public function createAction(){ 
		// Adicionar una condición para la validacion
		if($this->userFormValidation()){
			// Instanciar un objeto del modelo
			$userModel = new UserModel();
			// Instanciar un objeto session para mostrar mensajes
			$session = \Config\Services::session();
			// Instanciar un objeto request para recibir los datos
			$request = \Config\Services::request();
			// Obtener los datos enviados del formulario
			$data = $request->getPostGet();
			// Mostrar los datos
			// var_dump($request->getPostGet());
			// Cifrar el password
			if(!is_null($request->getPostGet('password'))){
				$data['password'] = MD5($request->getPostGet('password'));
			}
			// var_dump($request->getPostGet());     
			// Guardar los datos
			$userModel->insert($data);
			// if($userModel->insert($data)){
				// Mensaje temporal
				$session->setFlashdata('message', 'El usuario ' . $data['username'] . ' fue adicionado exitosamente.');
				// Direccionar al listado
				return redirect()->to('/user');
			// }else{
				// Mostrar mensajes de error en caso que existan
				// var_dump($userModel->errors());
			// }
		}else{
			// Mostrar mensajes de error en caso que existan
			// var_dump($this->validator->listErrors());
			// $data['validation'] = $this->validator;
			// return redirect()->to('/user/new');
			// $this->newAction();
			return $this->newAction();
			// helper('form');
			// $data['title'] = 'Nuevo Usuario';
			// return view('user/nuevo_view', $data);
		}
	}
	
	// Crear una funcion que contenga la logica de validacion
	private function userFormValidation(){
		// Validar segun los valores name en las etiquetas del formulario
		$val = $this->validate([
			// Reglas de validacion
			'username'=> 'required|alpha_numeric_space|min_length[3]',
			'password' => 'required|min_length[6]',
			'email'=> 'required|valid_email|is_unique[users.email]',
		],
		[
			// Mensajes de regla de validacion
			// Si desea cambiar los textos por defecto
			'username' => ['required' => 'Es necesario ingresar un nombre de usuario'],
			'password' => ['min_length' => 'El password es muy corto']
		]);
		return $val;
	}


	// Funciones del modelo para eliminar
	// Dependiendo si el atributo $useSoftDeletes esta
	// activo o no permite eliminar
	// delete : elimina un registro (fisico/logico)
	// purgeDeleted : elimina de forma fisica 
	// los registros con valor en fecha de registro
}
