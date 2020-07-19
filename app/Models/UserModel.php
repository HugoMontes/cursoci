<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    // Indicar el nombre de la tabla en la BD
    protected $table      = 'users';
    // Indicar la clave primaria
    protected $primaryKey = 'id';

    // Indicar tipo de retorno array
    // Algunos tipos son array, object
    protected $returnType     = 'object';
    // Indicar que elimine logicamente mediante una bandera
    protected $useSoftDeletes = true;

    // Indicar los campos a manipular al crear o actualizar
    protected $allowedFields = ['username', 'password', 'email'];

    // Indica si se gestionaran las fechas para 
    // Crear, Actualizar y Eliminar registros
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    /** 
     * REGLAS DE VALIDACION A NIVEL DE MODELO
    */
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    /*
    // Reglas de validacion a nivel del modelo
    protected $validationRules    = [
        'username' => 'required|alpha_numeric_space|min_length[3]',
        'email' => 'required|valid_email|is_unique[users.email]',
    ];
    // Mensaje personalizado de validacion
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'El correo fue registrado anteriormente.'
        ]
    ];
    // Indicar que no se salte la validacion
    protected $skipValidation     = false;
    */

    public function obtenerUsuarios(){
        // Instanciar el objeto para la coneccion
        $db = \Config\Database::connect();
		// Realizar la consulta
		$query = $db->query('SELECT id, username, email FROM users');
		// Obtener los resultados como un array de objetos
        $results = $query->getResult();
        // Retornar el resultado
        return $results;
    }

    public function buscarUsuario($username, $password){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('id, username, password');
        $builder->where('username', $username);
        $builder->where('password', MD5($password));
        $builder->limit(1);
        // if($builder->countAllResults()==1){
            $query = $builder->get();
            return $query->getRow();
        // }

        // $user = $this->find(1);
        /*
        $user = $this
            ->select('id, username, password')
            ->where('username', $username)
            ->where('password', MD5($password))
            ->limit(1)
            ->get()
            // ->getResult(); // Obtiene coleccion de objetos
            ->getRow(); // Obtiene un objeto
            var_dump($user);
            // return $user;
        */

        /*
        $build = $this
            ->select('id, username, password')
            // ->from($this->table)
            ->where('username', $username)
            ->where('password', MD5($password))
            ->limit(1);
            // ->get();
            // ->getResult(); // Obtiene coleccion de objetos
            // ->getRow(); // Obtiene un objeto
        echo $build->countAllResults().",<br/>";
        $query = $build->get();
        
        var_dump($query->getRow());
        // return $user;
        */

        /*
        $db = \Config\Database::connect();
        $builder = $db->table('users')
        ->select('id, username, password')
        ->where('username', $username)
        ->where('password', MD5($password))
        ->limit(1);
        $query = $builder->get();
        // var_dump($query->getResult());
        var_dump($query->getRow());
        // echo $builder->countAllResults().",<br/>";
        // $query = $builder->get();
        // var_dump($query->getRow()).",<br/>";
        */        
    }

}