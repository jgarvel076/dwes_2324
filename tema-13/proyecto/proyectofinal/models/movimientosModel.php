<?php

/*
    movimientosModel.php

    Modelo del controlador movimientos

    Definir los métodos de acceso a la base de datos
    
    - insert
    - update
    - select
    - etc..
*/

class movimientosModel extends Model
{

    # Método getMovimientos
    public function getMovimientos()
    {
        try {

            $sql = "
                SELECT 
                movimientos.id,
                cuentas.num_cuenta,
                movimientos.fecha_hora,
                movimientos.concepto,
                movimientos.tipo,
                movimientos.cantidad,
                movimientos.saldo
                FROM 
                    movimientos 
                    INNER JOIN cuentas ON movimientos.id_cuenta = cuentas.id 
                ORDER BY 
                    movimientos.id
            ";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();
            return $pdoSt;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    # Método create
    public function create($movimiento)
    {
        try {
            $sql = 
            
            "INSERT INTO Movimientos (
                id_cuenta,
                fecha_hora,
                concepto,
                tipo,
                cantidad,
                saldo
            )
            VALUES (
                :id_cuenta,
                :fecha_hora,
                :concepto,
                :tipo,
                :cantidad,
                :saldo
            )
        ";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            //Bindeamos parametros
            $pdoSt->bindParam(":id_cuenta", $movimiento->id_cuenta, PDO::PARAM_INT);
            $pdoSt->bindParam(":fecha_hora", $movimiento->fecha_hora);
            $pdoSt->bindParam(":concepto", $movimiento->concepto, PDO::PARAM_STR, 50);
            $pdoSt->bindParam(":tipo", $movimiento->tipo, PDO::PARAM_STR);
            $pdoSt->bindParam(":cantidad", $movimiento->cantidad, PDO::PARAM_STR);
            $pdoSt->bindParam(":saldo", $movimiento->saldo, PDO::PARAM_STR);

            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function getCuentas()
    {
        try {
            $sql = "SELECT * from cuentas";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();
            return $pdoSt;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function getSaldoCuenta($id)
    {
        try {
            $sql = "SELECT saldo FROM cuentas WHERE id = :id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();

            return $pdoSt->fetchColumn();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function actualizarSaldo($id, $nuevoSaldo)
    {
        try {
            $sql = "UPDATE cuentas SET saldo = :nuevoSaldo WHERE id = :id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->bindParam(":nuevoSaldo", $nuevoSaldo, PDO::PARAM_INT);
            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    # Método getMovimiento
    public function getMovimiento($id)
    {
        try {
            $sql = "
            SELECT 
            movimientos.id,
            cuentas.num_cuenta as cuenta,
            movimientos.fecha_hora,
            movimientos.concepto,
            movimientos.tipo,
            movimientos.cantidad,
            movimientos.saldo
            FROM 
                movimientos 
                INNER JOIN 
                    cuentas ON movimientos.id_cuenta = cuentas.id 
                WHeRE 
                    movimientos.id = :id
        ";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();

            return $pdoSt->fetch();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    # Método getCuenta
    public function getCuenta($id)
    {
        try {

            $sql = " 
                    SELECT 
                        cuentas.id,
                        cuentas.num_cuenta,
                        cuentas.id_cliente,
                        cuentas.fecha_alta,
                        cuentas.fecha_ul_mov,
                        cuentas.num_movtos,
                        cuentas.saldo
                    FROM 
                        cuentas
                    WHERE
                        id=:id;";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();

            return $pdoSt->fetch();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    public function order(int $criterio)
    {
        try {

            # comando sql
            $sql = "SELECT 
                        movimientos.id,
                        cuentas.num_cuenta,
                        movimientos.fecha_hora,
                        movimientos.concepto,
                        movimientos.tipo,
                        movimientos.cantidad,
                        movimientos.saldo
                    FROM
                        movimientos
                        JOIN cuentas ON movimientos.id_cuenta = cuentas.id
                    ORDER BY 
                        :criterio";

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $pdost = $conexion->prepare($sql);

            $pdost->bindParam(':criterio', $criterio, PDO::PARAM_INT);

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

    public function filter($expresion)
    {
        try {
            $sql = "SELECT 
                movimientos.id,
                movimientos.id_cuenta,
                movimientos.fecha_hora,
                movimientos.concepto,
                movimientos.tipo,
                movimientos.cantidad,
                movimientos.saldo,
            FROM
                movimientos
            WHERE
                CONCAT_WS(', ', 
                            movimientos.id,
                            movimientos.id_cuenta,
                            movimientos.fecha_hora,
                            movimientos.concepto,
                            movimientos.tipo,
                            movimientos.cantidad,
                            movimientos.saldo) 
                LIKE :expresion
            ORDER BY 
                movimientos.id
        ";

            $conexion = $this->db->connect();

            $expresion = "%" . $expresion . "%";
            $pdoSt = $conexion->prepare($sql);

            $pdoSt->bindValue(':expresion', $expresion, PDO::PARAM_STR);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();

            return $pdoSt;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }
}