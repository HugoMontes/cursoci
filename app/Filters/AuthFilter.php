<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface {

    // Funcion que se ejecuta antes de llamar a un controlador y su metodo
    public function before(RequestInterface $request, $arguments = null){
        $session = \Config\Services::session();
        if(!$session->logged_in){
            return redirect()->to(base_url());
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}