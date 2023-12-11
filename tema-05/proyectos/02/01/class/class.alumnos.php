<?php

    /*
        Clase Alumnos

        Métodos específicos para BBDD  fp con las tablas
        - Alumnos
        - Cursos
    */

    Class Alumnos extends Conexion {

        /**
         * get alumnos
         */

        public function getAlumnos(){

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

        # Prepare -> objeto clase pdostatement
        $pdostmt = $this -> pdo -> prepare ($sql);

        # Establezco tipo de fecht
        $pdostmt -> setFetchMode(PDO::FETCH_OBJ);

        #Ejecuto
        $pdostmt->execute();

        # Devuelvo objeto clase pdostatement
        return $pdostmt;


        }

        public function insert_curso(Curso $curso){

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
            }
            catch (PDOException $e) {

                include('views/partials/errorDB.php');
                exit();

            }
        }
    }

?>