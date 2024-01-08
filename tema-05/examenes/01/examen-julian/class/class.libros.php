<?php

/*
    Clase libros 

    Aquí se definirán los métodos necesarios para completar el examen
    
*/

class Libros extends Conexion
{


    public function getLibros()
    {

        //Creamos la query de SQL
        $sql = "SELECT 
        libros.id,
        libros.titulo,
        autores.nombre as autor,
        editoriales.nombre as editorial,
        libros.stock as unidades,
        libros.precio_coste as coste,
        libros.precio_venta as pvp,
        num_pag as paginas
        FROM
        libros
            INNER JOIN
        autores ON libros.autor_id = autores.id
            INNER JOIN
        editoriales ON libros.editorial_id = editoriales.id
        ORDER BY id;";

        //Preparamos el statement con un Objeto de la clase PDOstatement
        $pdostmt = $this->pdo->prepare($sql);

        //Establecemos tipo de fetch
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        //Se ejecuta
        $pdostmt->execute();

        //Devolvemos el objeto que ahora será de tipo pdostatement
        return $pdostmt;
    }


    public function getAutores()
    {
        //Creamos la query de SQL
        $sql = "SELECT 
        id,
        nombre
        FROM geslibros.autores";

        //Preparamos el statement con un Objeto de la clase PDOstatement
        $pdostmt = $this->pdo->prepare($sql);

        //Establecemos tipo de fetch
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        //Se ejecuta
        $pdostmt->execute();

        //Devolvemos el objeto que ahora será de tipo pdostatement
        return $pdostmt;
    }

    public function getEditoriales()
    {
        //Creamos la query de SQL
        $sql = "SELECT 
        id,
        nombre
        FROM geslibros.editoriales";

        //Preparamos el statement con un Objeto de la clase PDOstatement
        $pdostmt = $this->pdo->prepare($sql);

        //Establecemos tipo de fetch
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        //Se ejecuta
        $pdostmt->execute();

        //Devolvemos el objeto que ahora será de tipo pdostatement
        return $pdostmt;
    }

    public function update_libro(Libro $libro, $id)
    {
        try {
            // Prepare o plantilla sql
            $sql = "
                UPDATE INTO libros (
                    id,
                    isbn,
                    ean,
                    titulo,
                    autor_id,
                    editorial_id,
                    precio_coste,
                    precio_venta,
                    stock,
                    stock_min,
                    stock_max,
                    fecha_edicion,
                    create_at,
                    update_at,
                    num_pag
                ) VALUES (
                    NULL,
                    :isbn,
                    NULL,
                    :titulo,
                    :autor_id,
                    :editorial_id,
                    :precio_coste,
                    :precio_venta,
                    :stock,
                    NULL,
                    NULL,
                    :fecha_edicion,
                    NULL,
                    NULL,
                    :num_pag
                )
            ";

            // Preparamos el pdostmt
            $pdostmt = $this->pdo->prepare($sql);

            // Vincular los parámetros con valores
            $pdostmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 13);
            $pdostmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 80);
            $pdostmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT, 10);
            $pdostmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT, 10);
            $pdostmt->bindParam(':precio_coste', $libro->precio_coste);
            $pdostmt->bindParam(':precio_venta', $libro->precio_venta);
            $pdostmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT, 10);
            $pdostmt->bindParam(':fecha_edicion', $libro->fecha_edicion);
            $pdostmt->bindValue(':num_pag', $libro->num_pag, PDO::PARAM_INT);
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

}

?>