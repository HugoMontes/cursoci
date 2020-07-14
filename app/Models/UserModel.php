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

    // Reglas de validacion
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

}