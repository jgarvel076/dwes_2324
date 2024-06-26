<?php

class productosModel extends Model
{

    public function get()
    {

        try {

            $sql = "
                SELECT 
                    productos.id,
                    productos.nombre,
                    productos.ean_13,
                    productos.descripcion,
                    productos.precio_venta,
                    productos.stock
                FROM
                    productos
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

    public function getProducto($id)
    {
        try {
            $sql = " 
                    SELECT 
                        id,
                        nombre,
                        ean_13,
                        descripcion,
                        precio_venta,
                        stock
                    FROM
                        productos  
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

    public function create(Producto $producto)
    {

        try {
            $sql = "
                    INSERT INTO productos (
                        nombre,
                        ean_13,
                        descripcion,
                        precio_venta,
                        stock
                    )
                    VALUES (
                        :nombre,
                        :ean_13,
                        :descripcion,
                        :precio_venta,
                        :stock
                    )
            ";
            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);

            $pdostmt->bindParam(':nombre', $producto->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':ean_13', $producto->ean_13, PDO::PARAM_STR, 13);
            $pdostmt->bindParam(':descripcion', $producto->descripcion, PDO::PARAM_STR, 50);
            $pdostmt->bindParam('precio_venta', $producto->precio_venta, PDO::PARAM_STR, 10);
            $pdostmt->bindParam(':stock', $producto->stock, PDO::PARAM_STR, 10);
            
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
                                ean_13,
                                descripcion,
                                precio_venta,
                                stock
                        FROM 
                                productos
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

    public function update(Producto $producto, $id)
    {

        try {

            $sql = "
                
                UPDATE productos
                SET
                        nombre = :nombre,
                        ean_13 = :ean_13,
                        descripcion = :descripcion,
                        precio_venta = :precio_venta,
                        stock = :stock
                WHERE
                        id = :id
                LIMIT 1
                ";

            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);

            $pdostmt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdostmt->bindParam(':nombre', $producto->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':ean_13', $producto->ean_13, PDO::PARAM_STR, 13);
            $pdostmt->bindParam(':descripcion', $producto->descripcion, PDO::PARAM_STR, 50);
            $pdostmt->bindParam('precio_venta', $producto->precio_venta, PDO::PARAM_STR, 10);
            $pdostmt->bindParam(':stock', $producto->stock, PDO::PARAM_STR, 10);

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
                    FROM productos
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
                    productos.id,
                    productos.nombre,
                    productos.ean_13,
                    productos.descripcion,
                    productos.precio_venta,
                    productos.stock
                FROM
                    productos
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
                    productos.id,
                    productos.nombre,
                    productos.ean_13,
                    productos.descripcion,
                    productos.precio_venta,
                    productos.stock
                FROM
                productos
                
                WHERE

                    CONCAT_WS(  ', ', 
                    productos.id,
                    productos.nombre,
                    productos.ean_13,
                    productos.descripcion,
                    productos.precio_venta,
                    productos.stock) 
                    like :expresion

                ORDER BY 
                    productos.id
                
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

    public function validateUniqueNumEan($ean_13)
    {
        try {
            $sql = "SELECT * FROM productos 
                    WHERE ean_13 = :ean_13";


            //Conectar con la base de datos
            $conexion = $this->db->connect();

            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':ean_13', $ean_13, PDO::PARAM_STR);

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
                        productos.id,
                        productos.nombre,
                        productos.ean_13,
                        productos.descripcion,
                        productos.precio_venta,
                        productos.stock
                    FROM
                        productos
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