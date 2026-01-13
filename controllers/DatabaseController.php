<?php

class DatabaseController
{
    private $SERVERNAME = "localhost";
    private $USER = "root";
    private $PASSWORD = "";
    private $DATABASE = "vet";
    private $CONNECTION = NULL;

    public function __construct()
    {
        $this->CONNECTION = new mysqli($this->SERVERNAME, $this->USER, $this->PASSWORD,  $this->DATABASE);
    }

    public function read($QUERY, $TYPES = NULL, $PARAMETERS = NULL)
    {
        try {
            $STATEMENT = $this->CONNECTION->prepare($QUERY);
            if ($TYPES != NULL && $PARAMETERS != NULL) {
                $STATEMENT->bind_param($TYPES, ...$PARAMETERS);
            }
            $STATEMENT->execute();
            return $STATEMENT->get_result();
        } catch (Exception $e) {
            
        }
    }

    public function write($QUERY, $TYPES = NULL, $PARAMETERS = NULL)
    {
        try {
            $STATEMENT = $this->CONNECTION->prepare($QUERY);
            $STATEMENT->bind_param($TYPES, ...$PARAMETERS);
            $STATEMENT->execute();
            if ($RESULT = $STATEMENT->get_result()) {
                $ROW = $RESULT->fetch_assoc();
                return $ROW['id'];
            }
        } catch (Exception $e) {
            switch ($STATEMENT->errno) {
                case 1451:
                    $alert = "¡Hola! Parece que intentaste eliminar una entidad que ya está siendo utilizada por otra entidad en nuestra base de datos. Para mantener la integridad de los datos, no podemos completar esta acción en este momento. Por favor, revisa las dependencias e inténtalo de nuevo. ¡Gracias!";
                    break;
                case 1062:
                    $alert = "¡Atención! Parece que intentaste crear una entidad que ya está registrada en el sistema. Por favor, verifica los datos e intenta de nuevo. ¡Gracias!";
                    break;
                default:
                    $alert = "¡Ups! Ha ocurrido un error desconocido. Lamentamos las molestias. Por favor, contacta al desarrollador para obtener asistencia. ¡Gracias por tu comprensión!";
                    break;
            }
            require_once $_SERVER['DOCUMENT_ROOT']  . '/templates/error.php';
            die();
        }
    }
}
