<?php

class clientesModel extends Model
{

    public function get()
    {

        try {

            $sql = "
                SELECT 
                    clientes.id,
                    clientes.nombre,
                    clientes.direccion,
                    clientes.poblacion,
                    clientes.c_postal,
                    clientes.telefono,
                    clientes.email,
                    clientes.nif
                FROM
                    clientes
                ORDER BY 
                    id
                ";

            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt;

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    public function getCliente($id)
    {
        try {
            $sql = " 
                    SELECT     
                        id,
                        nombre,
                        direccion,
                        poblacion,
                        c_postal,
                        telefono,
                        email,
                        nif
                    FROM  
                        clientes  
                    WHERE
                        id = :id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();
            return $pdoSt->fetch();

        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function create(Cliente $cliente)
    {

        try {
            $sql = "
                    INSERT INTO Clientes (
                        nombre,
                        direccion,
                        poblacion,
                        c_postal,
                        telefono,
                        email,
                        nif
                    )
                    VALUES (
                        :nombre,
                        :direccion,
                        :poblacion,
                        :c_postal,
                        :telefono,
                        :email,
                        :nif
                    )
            ";
            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);

            $pdostmt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':direccion', $cliente->direccion, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':poblacion', $cliente->poblacion, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':c_postal', $cliente->c_postal, PDO::PARAM_STR, 6);
            $pdostmt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_STR, 13);
            $pdostmt->bindParam(':email', $cliente->email, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':nif', $cliente->nif, PDO::PARAM_STR, 9);
            
            $pdostmt->execute();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

    }

    public function read($id)
    {

        try {
            $sql = "
                        SELECT 
                                id,
                                nombre,
                                direccion,
                                poblacion,
                                c_postal,
                                telefono,
                                email,
                                nif
                        FROM 
                                clientes
                        WHERE
                                id = :id
                ";

            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);

            $pdostmt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt->fetch();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

    }

    public function update(Cliente $cliente, $id)
    {

        try {

            $sql = "
                
                UPDATE clientes
                SET
                        nombre = :nombre,
                        direccion = :direccion,
                        poblacion = :poblacion,
                        c_postal = :c_postal,
                        telefono = :telefono,
                        email = :email,
                        nif = :nif
                WHERE
                        id = :id
                LIMIT 1
                ";

            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);

            $pdostmt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':direccion', $cliente->direccion, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':poblacion', $cliente->poblacion, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':c_postal', $cliente->c_postal, PDO::PARAM_STR, 6);
            $pdostmt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_STR, 13);
            $pdostmt->bindParam(':email', $cliente->email, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':nif', $cliente->nif, PDO::PARAM_STR, 9);

            $pdostmt->execute();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

    }

    public function delete($id){
        try{          
                $sql = "
                    DELETE
                    FROM clientes
                    WHERE id = :id
                    LIMIT 1
                ";

                $conexion = $this->db->connect();

                $pdostmt = $conexion->prepare($sql);
                $pdostmt->bindParam(':id', $id , PDO::PARAM_INT);

                $pdostmt->execute();

        }catch(PDOException $e){
                include "template/partials/errordb.php";
                exit();
        }
    }


    public function order(int $criterio)
    {

        try {

            $sql = "
                SELECT 
                    clientes.id,
                    clientes.nombre,
                    clientes.direccion,
                    clientes.poblacion,
                    clientes.c_postal,
                    clientes.telefono,
                    clientes.email,
                    clientes.nif
                FROM
                    clientes
                ORDER BY 
                    :criterio ASC
                ";

            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);

            $pdostmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt;

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    public function filter($expresion)
    {
        try {
            $sql = "

                SELECT 
                    clientes.id,
                    clientes.nombre,
                    clientes.direccion,
                    clientes.poblacion,
                    clientes.c_postal,
                    clientes.telefono,
                    clientes.email,
                    clientes.nif
                FROM
                clientes
                
                WHERE

                    CONCAT_WS(  ', ', 
                    clientes.id,
                    clientes.nombre,
                    clientes.direccion,
                    clientes.poblacion,
                    clientes.c_postal,
                    clientes.telefono,
                    clientes.email,
                    clientes.nif) 
                    like :expresion

                ORDER BY 
                    clientes.id
                
                ";

            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);

            $pdostmt->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);
            
            $pdostmt->execute();
            
            return $pdostmt;

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }

    }

    public function validateUniqueEmail($email)
    {
        try {
            $sql = "SELECT * FROM clientes 
                    WHERE email = :email";


            //Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':email', $email, PDO::PARAM_STR);

            $pdost->execute();

            if ($pdost->rowCount() != 0) {
                return false;
            }

            return true;
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    public function validateUniqueNif($nif)
    {
        try {
            $sql = "SELECT * FROM clientes 
                     WHERE nif = :nif";


            //Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':nif', $nif, PDO::PARAM_STR);

            $pdost->execute();

            if ($pdost->rowCount() != 0) {
                return false;
            }

            return true;
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    function getCSV()
    {

        try {

            # comando sql
            $sql = "
                    SELECT 
                        clientes.id,
                        clientes.nombre,
                        clientes.direccion,
                        clientes.poblacion,
                        clientes.c_postal,
                        clientes.telefono,
                        clientes.email,
                        clientes.nif
                    FROM
                        clientes
                    ORDER BY 
                        id
                    ";

            # conectamos con la base de datos

            // $this->db es un objeto de la clase database
            // ejecuto el método connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $pdost = $conexion->prepare($sql);

            # establecemos  tipo fetch
            $pdost->setFetchMode(PDO::FETCH_OBJ);

            #  ejecutamos 
            $pdost->execute();

            # devuelvo objeto pdostatement
            return $pdost;
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();
        }
    }

}

?>