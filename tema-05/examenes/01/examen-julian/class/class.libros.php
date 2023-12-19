    <?php

    /*
        Clase libros 

        Aquí se definirán los métodos necesarios para completar el examen
        
    */

    class libros extends Conexion{
        public function getLibros() {
            try {
                $query = "SELECT libros.id, libros.titulo, autores.nombre AS autor, editoriales.nombre AS editorial, libros.stock AS unidades, libros.precio_coste AS coste, libros.precio_venta AS pvp 
                            FROM libros
                            LEFT JOIN autores ON libros.autor_id = autores.id
                            LEFT JOIN editoriales ON libros.editorial_id = editoriales.id";
    
                $stmt = $this->conexion->prepare($query);
                $stmt->execute();
    
                return $stmt;
            } catch (PDOException $e) {
                // Manejo de errores
                return null;
            }
        }
    
    }

?>
