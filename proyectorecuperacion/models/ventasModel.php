<?php

class ventasModel extends Model
{
    public function get()
    {
        try {
            $sql = "
                SELECT 
                    ventas.id,
                    ventas.cliente_id,
                    ventas.importe_total,
                    ventas.estado
                FROM
                    ventas
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

    public function getVenta($id)
    {
        try {
            $sql = " 
                SELECT     
                    id,
                    cliente_id,
                    importe_total,
                    estado
                FROM  
                    ventas  
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

    public function create(Venta $venta)
    {
        try {
            $sql = "
                INSERT INTO ventas (
                    cliente_id,
                    importe_total,
                    estado
                )
                VALUES (
                    :cliente_id,
                    :importe_total,
                    :estado
                )
            ";
            $conexion = $this->db->connect();
            $pdostmt = $conexion->prepare($sql);
            $pdostmt->bindParam(':cliente_id', $venta->cliente_id, PDO::PARAM_INT);
            $pdostmt->bindParam(':importe_total', $venta->importe_total, PDO::PARAM_STR);
            $pdostmt->bindParam(':estado', $venta->estado, PDO::PARAM_STR);
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
                    cliente_id,
                    importe_total,
                    estado
                FROM 
                    ventas
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

    public function update(Venta $venta, $id)
    {
        try {
            $sql = "
                UPDATE ventas
                SET
                    cliente_id = :cliente_id,
                    importe_total = :importe_total,
                    estado = :estado
                WHERE
                    id = :id
                LIMIT 1
            ";
            $conexion = $this->db->connect();
            $pdostmt = $conexion->prepare($sql);
            $pdostmt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdostmt->bindParam(':cliente_id', $venta->cliente_id, PDO::PARAM_INT);
            $pdostmt->bindParam(':importe_total', $venta->importe_total, PDO::PARAM_STR);
            $pdostmt->bindParam(':estado', $venta->estado, PDO::PARAM_STR);
            $pdostmt->execute();
        } catch (PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
    }

    public function delete($id)
    {
        try {
            $sql = "
                DELETE
                FROM ventas
                WHERE id = :id
                LIMIT 1
            ";
            $conexion = $this->db->connect();
            $pdostmt = $conexion->prepare($sql);
            $pdostmt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdostmt->execute();
        } catch (PDOException $e) {
            include "template/partials/errorDB.php";
            exit();
        }
    }

    public function order(int $criterio)
    {
        try {
            $sql = "
                SELECT 
                    ventas.id,
                    ventas.cliente_id,
                    ventas.importe_total,
                    ventas.estado
                FROM
                    ventas
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
                    ventas.id,
                    ventas.cliente_id,
                    ventas.importe_total,
                    ventas.estado
                FROM
                    ventas
                WHERE
                    CONCAT_WS(', ', ventas.id, ventas.cliente_id, ventas.importe_total, ventas.estado) 
                    LIKE :expresion
                ORDER BY 
                    ventas.id
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
}
?>
