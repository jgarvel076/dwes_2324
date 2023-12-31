<?php

/*
    Clase Alumnos

    Métodos específicos para BBDD
    - Alumnos
    - Cursos
*/

class Alumnos extends Conexion
{

    /**
     * 
     * GetAlumnos
     * 
     * Devuelve la información de un objeto seleccionado
     * 
     */
    public function getAlumnos()
    {

        $sql = "SELECT 
                    alumnos.id,
                    concat_ws(', ', alumnos.apellidos, alumnos.nombre) alumno,
                    alumnos.email,
                    alumnos.telefono,
                    alumnos.poblacion,
                    alumnos.dni,
                    timestampdiff(YEAR,  alumnos.fechaNac, NOW() ) edad,
                    cursos.nombreCorto curso
                FROM
                    alumnos
                INNER JOIN
                    cursos
                ON alumnos.id_curso = cursos.id
                ORDER BY id";

        # Prepare -> objeto
        $pdostmt = $this->pdo->prepare($sql);

        // Establezco fetch
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        // ejecuto
        $pdostmt->execute();

        return $pdostmt;

    }

    public function getCursos()
    {

        $sql = "SELECT id, nombreCorto curso FROM cursos ORDER BY id";

        # Prepare -> objeto
        $pdostmt = $this->pdo->prepare($sql);

        // Establezco fetch
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);
        // El blackbox delante del PDO escribe una \ por si después da fallos

        // ejecuto
        $pdostmt->execute();

        return $pdostmt;

    }

    public function insertAlumno(Alumno $alumno)
    {
        try {
            # Prepare
            $sql = "Insert into Alumnos values (
                    null,
                    :nombre, 
                    :apellidos, 
                    :email, 
                    :telefono, 
                    :direccion, 
                    :poblacion, 
                    :provincia, 
                    :nacionalidad, 
                    :dni, 
                    :fechaNac, 
                    :id_curso
                )";

            # Objeto clase mysqli_stmt
            $pdostmt = $this->pdo->prepare($sql);

            # Vinculo parámetros con variables
            $pdostmt->bindParam(":nombre", $alumno->nombre, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 256);
            $pdostmt->bindParam(':direccion', $alumno->direccion, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':poblacion', $alumno->poblacion, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':provincia', $alumno->provincia, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':fechaNac', $alumno->fechaNac);
            $pdostmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);

            // ejecuto
            $pdostmt->execute();

            // libero memoria
            $pdostmt = null;

            // Cerrar conexión
            $this->pdo = null;

        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }

    }

    public function insert_curso(Curso $curso)
    {

        try {

            # Prepare o plantilla sql
            $sql = "
                    INSERT INTO Cursos (
                        nombre,
                        ciclo,
                        nombreCorto,
                        nivel
                    ) VALUES (
                        :nombre,
                        :ciclo,
                        :nombreCorto,
                        :nivel
                    )
                
                ";

            # objeto de clase PDOStatement
            $pdostmt = $this->pdo->prepare($sql);

            # Vincular los parámetros con valores
            $pdostmt->bindParam(':nombre', $curso->nombre, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':ciclo', $curso->ciclo, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':nombreCorto', $curso->nombreCorto, PDO::PARAM_STR, 4);
            $pdostmt->bindParam(':nivel', $curso->nivel, PDO::PARAM_INT, 1);

            #ejecutamos sql
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

    public function getAlumno($indice)
    {
        try {

            $sql = "SELECT * FROM alumnos WHERE id = :id LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':id', $indice, PDO::PARAM_INT);

            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$data) {
                throw new Exception('Alumno No Encontrado');
            }

            return $data;

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }

    }

    public function update_alumno(Alumno $alumno, $id)
    {

        try {
            # Prepare the SQL statement
            $sql = "
                UPDATE Alumnos SET
                    nombre = :nombre,
                    apellidos = :apellidos,
                    email = :email,
                    telefono = :telefono,
                    direccion = :direccion,
                    poblacion = :poblacion,
                    provincia = :provincia,
                    nacionalidad = :nacionalidad,
                    dni = :dni,
                    fechaNac = :fechaNac,
                    id_curso = :id_curso
                WHERE id = :id";

            # Create a PDOStatement object
            $pdostmt = $this->pdo->prepare($sql);

            # Bind the parameters with values
            $pdostmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':direccion', $alumno->direccion, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':poblacion', $alumno->poblacion, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':provincia', $alumno->provincia, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':fechaNac', $alumno->fechaNac);
            $pdostmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);
            $pdostmt->bindParam(':id', $id, PDO::PARAM_INT); // SE NECESITA EL id DEL ALUMNO A EDITAR PARA EL WHERE

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

    public function getCurso($indice)
    {
        try {

            $sql = "SELECT nombre FROM cursos WHERE id = :id LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':id', $indice, PDO::PARAM_INT);

            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$data) {
                throw new Exception('Curso No Encontrado');
            }

            return $data;

        } catch (Exception $e) {
            include('views/partials/errorDB.php');
            exit();
        }

    }

}

?>