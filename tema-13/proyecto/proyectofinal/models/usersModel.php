<?php

/*
    clientesModel.php

    Modelo del controlador clientes

    Definir los métodos de acceso a la base de datos
    
    - insert
    - update
    - select
    - delete
    - etc..
*/

class usersModel extends Model
{
    public function get()
    {

        try {

            $sql = "SELECT 
                        users.id,
                        users.name,
                        users.email,
                        users.password
                    FROM
                        users
                    ORDER BY 
                        id";

            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);
            $pdost->setFetchMode(PDO::FETCH_OBJ);
            $pdost->execute();
            return $pdost;

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    public function read($id)
    {

        try {
            $sql = "SELECT 
                        users.id,
                        users.name,
                        users.email,
                        users.password                        
                    FROM 
                        users
                    WHERE
                        users.id = :id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();

            return $pdoSt->fetch();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

    }

    public function update(int $id, classUser $user, int $rol)
    {
        try {
            $sql = "UPDATE users
                    SET
                        name = :name,
                        email = :email,
                        password = :password
                    WHERE
                        id = :id
                    LIMIT 1";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoSt->bindParam(':name', $user->name, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':email', $user->email, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(':password', $user->password, PDO::PARAM_STR, 60);

            $pdoSt->execute();

            // Actualizar el rol del usuario
            $sqlRol = "UPDATE
                            roles_users
                        SET 
                            role_id = :role_id
                        WHERE 
                            user_id = :user_id";

            $stmtRol = $conexion->prepare($sqlRol);
            $stmtRol->bindParam(':role_id', $rol);
            $stmtRol->bindParam(':user_id', $id);
            $stmtRol->execute();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    public function order(int $criterio)
    {
        try {

            # comando sql
            $sql = "SELECT 
                        users.id,
                        users.name,
                        users.email,
                        users.password
                    FROM
                        users
                    ORDER BY 
                        :criterio";

            $conexion = $this->db->connect();

            $pdost = $conexion->prepare($sql);

            $pdost->bindParam(':criterio', $criterio, PDO::PARAM_INT);


            $pdost->setFetchMode(PDO::FETCH_OBJ);

            $pdost->execute();

            return $pdost;

        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    public function filter($expresion)
    {
        try {
            $sql = "SELECT 
                        users.id,
                        users.name,
                        users.email,
                        users.password
                    FROM
                        users
                    WHERE
                        CONCAT_WS(', ', 
                                users.id,
                                users.name, 
                                users.email,
                                users.password) 
                        LIKE :expresion
                    ORDER BY 
                        users.id
                    ";

            $conexion = $this->db->connect();

            $pdost = $conexion->prepare($sql);

            $pdost->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            $pdost->setFetchMode(PDO::FETCH_OBJ);
            $pdost->execute();

            return $pdost;
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }


    public function delete($id)
    {
        try {
            $sql = "DELETE
                    FROM
                        users
                    WHERE 
                        id = :id";

            $conexion = $this->db->connect();

            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);

            $pdoSt->execute();

        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    

    public function getUsers()
    {
        {
            try {
                $sql = "SELECT * FROM users WHERE id = :id";
    
                $pdo = $this->db->connect();
                $pdoSt = $pdo->prepare($sql);
                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();
                return $pdoSt->fetch();
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }
    }

    public function getRol()
    {
        try {
            $sql = "SELECT 
                        roles.id, 
                        roles.name 
                    FROM 
                        roles";

            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);
            $pdost->execute();

            return $pdost->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function userRol($id)
    {
        try {
            $sql = "SELECT
                        roles.id, roles.name
                    FROM
                        roles
                    INNER JOIN
                        roles_users
                    ON
                        roles.id = roles_users.role_id
                    INNER JOIN
                        users
                    ON
                        roles_users.user_id = users.id
                    WHERE
                        users.id = :id";

            $pdo = $this->db->connect();
            $pdoSt = $pdo->prepare($sql);
            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);

            $pdoSt->execute();

            return $pdoSt->fetch();

        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function validateEmail($email)
    {

        try {

            $selectSQL = "SELECT * FROM users WHERE email = :email";
            $pdo = $this->db->connect();
            $pdost = $pdo->prepare($selectSQL);
            $pdost->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $pdost->execute();
            if ($pdost->rowCount() > 0)
                return false;
            else
                return true;
        } catch (PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }

    }

    public function validateName($username)
    {
        if ((strlen($username) < 5) || (strlen($username) > 50)) {
            return false;
        }
        return true;
    }

    public function validatePass($pass)
    {
        if ((strlen($pass) < 5) || (strlen($pass) > 50)) {
            return false;
        }
        return true;
    }
    public function create($name, $email, $pass, $rol)
        {
            try {
                
                $password_encriptado = password_hash($pass, CRYPT_BLOWFISH);

                $sql = "INSERT INTO users VALUES (
                    null,
                    :nombre,
                    :email,
                    :pass,
                    default,
                    default)";

                $pdo = $this->db->connect();
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':nombre', $name, PDO::PARAM_STR, 50);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
                $stmt->bindParam(':pass', $password_encriptado, PDO::PARAM_STR, 60);

                $stmt->execute();

                $sql = "INSERT INTO roles_users VALUES (
                    null,
                    :user_id,
                    :role_id,
                    default,
                    default)";

                $ultimo_id = $pdo->lastInsertId();

                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':user_id', $ultimo_id);
                $stmt->bindParam(':role_id', $rol);
                $stmt->execute();

            } catch (PDOException $e) {

                include_once('template/partials/errorDB.php');
                exit();

            }
        }
}

?>