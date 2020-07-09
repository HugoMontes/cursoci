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

    // Indicar si se gestionaran las fechas para 
    // Crear, Actualizar y Eliminar registros
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Reglas y mensajes de validacion
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}