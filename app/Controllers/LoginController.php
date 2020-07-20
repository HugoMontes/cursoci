<?php namespace App\Controllers;

// Importar la clase UserModel
use App\Models\UserModel;

class LoginController extends BaseController {

    public function index(){
        helper('form');
		return view('login_view');
    }
    
    // Funcion para validar formulario
    private function userLoginFormValidation() {
		$val = $this->validate([
			'username'=> 'required',
			'password' => 'required',
		]);
		return $val;
    }

    // Funcion de login
	public function login(){
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        $userModel = new UserModel();
        if($this->userLoginFormValidation()){
            // Obtener datos del formulario
            $username = $request->getPostGet('username');
            $password = $request->getPostGet('password');
            // Buscar usuario
            $user = $userModel->buscarUsuario($username, $password);
            if(!is_null($user)){
                // Crear variables de sesion
                $session->set([
                    'id' => $user->id,
                    'username' => $user->username,
                    'logged_in' => TRUE
                ]);
                // Redireccionar a una vista
                return redirect()->to('/user');
            }else{
                $session->setFlashdata('error', 'Nombre de usuario o password incorrectos');
            }
        }
        // Direccionar al login
        return $this->index();        
    }
    
    public function logout(){
        $session = \Config\Services::session();
        // Eliminar la variable se desion
        $session->remove(['id','username','logged_in']);
        // Destruir la sesion
        $session->destroy();
        // Redireccionar al login
        return $this->index(); 
	}

}