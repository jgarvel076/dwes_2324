<?php

/*
    Clase Alumnos

    Métodos específicos para BBDD
    - Alumnos
    - Cursos
*/

class Corredores extends Conexion
{

    /**
     * 
     * GetAlumnos
     * 
     * Devuelve la información de un objeto seleccionado
     * 
     */
    public function getCorredores()
    {

        $sql = "SELECT 
                    corredores.id,
                    concat_ws(', ', corredores.apellidos, corredores.nombre) corredor,
                    corredores.ciudad,
                    corredores.fechaNacimiento,
                    corredores.sexo,
                    corredores.email,
                    corredores.dni,
                    corredores.edad,
                    categorias.nombre as categorias,
                    clubs.nombre as club 
                FROM
                    corredores
                INNER JOIN
                    categorias
                ON corredores.id_categoria = categorias.id
                INNER JOIN 
                    clubs
                ON corredores.id_club = clubs.id
                ORDER BY id";

        # Prepare -> objeto
        $pdostmt = $this->pdo->prepare($sql);

        // Establezco fetch
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        // ejecuto
        $pdostmt->execute();

        return $pdostmt;

    }

    public function getClubs()
    {

        $sql = "SELECT id, nombreCorto club FROM clubs ORDER BY id";

        # Prepare -> objeto
        $pdostmt = $this->pdo->prepare($sql);

        // Establezco fetch
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        // ejecuto
        $pdostmt->execute();

        return $pdostmt;

    }

    public function getCategorias()
    {

        $sql = "SELECT id, nombreCorto categoria FROM categorias ORDER BY id";

        # Prepare -> objeto
        $pdostmt = $this->pdo->prepare($sql);

        // Establezco fetch
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        // ejecuto
        $pdostmt->execute();

        return $pdostmt;

    }

    public function insertCorredor(Corredor $corredor)
    {
        try {
            $sql = "INSERT INTO maratoon.corredores (
                nombre,
                apellidos,
                ciudad,
                fechaNacimiento,
                sexo,
                email,
                dni,
                id_categoria,
                id_club
            ) VALUES(
                :nombre,
                :apellidos,
                :ciudad,
                :fechaNacimiento,
                :sexo,
                :email,
                :dni,
                :id_categoria,
                :id_club)";

            // Preparamos la consulta
            $pdostmt = $this->pdo->prepare($sql);

            // Vinculamos los parametros
            $pdostmt->bindParam(':nombre', $corredor->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':apellidos', $corredor->apellidos, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':ciudad', $corredor->ciudad, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':fechaNacimiento', $corredor->fechaNacimiento);
            $pdostmt->bindParam(':sexo', $corredor->sexo);
            $pdostmt->bindParam(':email', $corredor->email, PDO::PARAM_STR, 128);
            $pdostmt->bindParam(':dni', $corredor->dni, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':id_categoria', $corredor->id_categoria, PDO::PARAM_INT);
            $pdostmt->bindParam(':id_club', $corredor->id_club, PDO::PARAM_INT);

            // Ejecutar la sentencia preparada
            $pdostmt->execute();

            // Libero Memoria
            $pdostmt = null;

            // Cerramos la conexion
            $this->pdo = null;

        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }

    }

    public function getCorredor($indice)
    {
        try {

            $sql = "SELECT * FROM corredores WHERE id = :id LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':id', $indice, PDO::PARAM_INT);

            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$data) {
                throw new Exception('Corredor No Encontrado');
            }

            return $data;

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }

    }

    public function update_corredor(Corredor $corredor, $id)
    {

        try {
            # Prepare the SQL statement
            $sql = "
                UPDATE corredores SET
                    nombre = :nombre,
                    apellidos = :apellidos,
                    ciudad = :ciudad,
                    fechaNacimiento = :fechaNacimiento,
                    sexo = :sexo,
                    email = :email,
                    dni = :dni,
                    id_categoria = :id_categoria,
                    id_club = :id_club
                WHERE id = :id";

            # Create a PDOStatement object
            $pdostmt = $this->pdo->prepare($sql);

            # Bind the parameters with values
            $pdostmt->bindParam(':nombre', $corredor->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':apellidos', $corredor->apellidos, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':ciudad', $corredor->ciudad, PDO::PARAM_STR, 100);
            $pdostmt->bindParam(':fechaNacimiento', $corredor->fechaNacimiento, PDO::PARAM_STR, 20);
            $pdostmt->bindParam(':sexo', $corredor->sexo, PDO::PARAM_STR, 2);
            $pdostmt->bindParam(':email', $corredor->email, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':dni', $corredor->dni, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':id_categoria', $corredor->id_categoria, PDO::PARAM_INT, 2);
            $pdostmt->bindParam(':id_club', $corredor->id_club, PDO::PARAM_INT, 2);

            $pdostmt->bindParam(':id', $id, PDO::PARAM_INT); 
            
            # Execute the SQL statement
            $pdostmt->execute();

            # Free the PDOStatement object
            $pdostmt = null;

            # Close the connection
            $this->pdo = null;
        } catch (PDOException $e) {
            include('views/partials/errorDB.php');
            exit();
        }
    }

    public function delete_corredor($id_corredor)
    {
        # Debemos de tener claro que según la base de datos, 
        # al no tener un borrado en cascada no deja borrar un corredor que haya corrido un carrera
        # por lo tanto debemos borrar también el registro de este.
        
        try {
            $eliminarRegistros = "DELETE FROM 
                maratoon.registros 
                WHERE 
                registros.id_corredor=:id_corredor";

            
            $pdostmtRegistros = $this->pdo->prepare($eliminarRegistros);
            
            $pdostmtRegistros->bindParam(":id", $id_corredor, PDO::PARAM_INT);

            $pdostmtRegistros->execute();

            $sql = "DELETE FROM corredores WHERE id = :id_corredor";

            echo "SQL: $sql";

            # objeto de clase PDOStatement
            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->bindParam(':id_corredor', $id_corredor, PDO::PARAM_INT);

            # ejecutamos sql
            $pdostmt->execute();

            # liberamos objeto 
            $pdostmt = null;

            # cerramos conexión
            $this->pdo = null;

        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }
    }

    public function order($criterio)
    {
        // Vamos a cambiar en vez de criterio a que sea por número del nombre
        // ejemplo nombre es la fila 2 se le pone 2.
        
        try {
            $sql = "SELECT 
                corredores.id,
                CONCAT_WS(', ',corredores.apellidos, corredores.nombre) as corredor,
                corredores.ciudad,
                corredores.email,
                TIMESTAMPDIFF(YEAR,
                    corredores.fechaNacimiento,
                    NOW()) AS edad,
                categorias.nombrecorto AS categorias,
                clubs.nombreCorto AS club
            FROM
                maratoon.corredores
                    INNER JOIN
                maratoon.categorias ON categorias.id = corredores.id_categoria
                    INNER JOIN
                maratoon.clubs ON clubs.id = corredores.id_club
            ORDER BY $criterio";

            // Preparo la consulta
            $pdostmt = $this->pdo->prepare($sql);

            // Elegimos el tipo de fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejecuto la consulta
            $pdostmt->execute();

            // Devolvemos el objeto de tipo PDOStatement
            return $pdostmt;

        } catch (PDOException $e) {
            include 'views/partials/errorDB.php';
            exit();
        }
    }

    public function buscar($expresion)
    {
        try {
            $sql = "SELECT 
                corredores.id,
                CONCAT_WS(', ',corredores.apellidos, corredores.nombre) as corredor,
                corredores.ciudad,
                corredores.email,
                TIMESTAMPDIFF(YEAR,
                    corredores.fechaNacimiento,
                    NOW()) AS edad,
                categorias.nombrecorto AS categorias,
                clubs.nombreCorto AS club
            FROM
                maratoon.corredores
                    INNER JOIN
                maratoon.categorias ON categorias.id = corredores.id_categoria
                    INNER JOIN
                maratoon.clubs ON clubs.id = corredores.id_club
            WHERE
            CONCAT_WS('',corredores.apellidos, 
                        corredores.nombre,
                        corredores.ciudad,
                        corredores.email,
                        TIMESTAMPDIFF(YEAR,corredores.fechaNacimiento,NOW()),
                        categorias.nombrecorto,
                        clubs.nombreCorto) 
            LIKE :expresion";

            // Modificamos la expresión recibida como parametro
            $expresion = "%" . $expresion . "%";

            // Preparamos la consulta
            $pdostmt = $this->pdo->prepare($sql);

            // Asignamos el valor del parametro
            $pdostmt->bindParam(":expresion", $expresion);

            // Establecemos el tipo de fetch a usar
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejecutamos la consulta
            $pdostmt->execute();

            // Devolvemos el resultado de la consulta
            return $pdostmt;

        } catch (PDOException $e) {

            include 'views/partials/errorDB.php';
            exit();

        }
    }

    // Estos dos métodos no eran necesarios ya que se coge en la vista la categoría y club que es
    // public function getClub($indice)
    // {
    //     try {

    //         $sql = "SELECT nombre FROM clubs WHERE id = :id LIMIT 1";

    //         $stmt = $this->pdo->prepare($sql);

    //         $stmt->bindParam(':id', $indice, PDO::PARAM_INT);

    //         $stmt->execute();

    //         $data = $stmt->fetch(PDO::FETCH_OBJ);

    //         if (!$data) {
    //             throw new Exception('Club No Encontrado');
    //         }

    //         return $data;

    //     } catch (Exception $e) {
    //         include('views/partials/errorDB.php');
    //         exit();
    //     }

    // }

    // public function getCategoria($indice)
    // {
    //     try {

    //         $sql = "SELECT nombre FROM categorias WHERE id = :id LIMIT 1";

    //         $stmt = $this->pdo->prepare($sql);

    //         $stmt->bindParam(':id', $indice, PDO::PARAM_INT);

    //         $stmt->execute();

    //         $data = $stmt->fetch(PDO::FETCH_OBJ);

    //         if (!$data) {
    //             throw new Exception('Categoría No Encontrado');
    //         }

    //         return $data;

    //     } catch (Exception $e) {
    //         include('views/partials/errorDB.php');
    //         exit();
    //     }

    // }

}

?>