<?php

/*
    Modelo cuentasModel
*/


class cuentasModel extends Model
{

    # Método get
    public function get()
    {
        try {

            $sql = " 
            SELECT 
                c.id,
                c.num_cuenta,
                c.id_cliente,
                c.fecha_alta,
                c.fecha_ul_mov,
                c.num_movtos,
                c.saldo,
                concat_ws(', ', cl.apellidos, cl.nombre) as cliente
            FROM 
                cuentas as c INNER JOIN clientes as cl 
                ON c.id_cliente = cl.id 
            ORDER BY c.id;
            
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
    public function create($cuenta)
    {
        try {
            $sql = " 
                    INSERT INTO 
                        cuentas (
                                    num_cuenta,
                                    id_cliente,
                                    fecha_alta,
                                    fecha_ul_mov,
                                    num_movtos,
                                    saldo
                                ) VALUES ( 
                                    :num_cuenta,
                                    :id_cliente,
                                    :fecha_alta,
                                    :fecha_ul_mov,
                                    :num_movtos,
                                    :saldo
                                )";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);

            //Bindeamos parametros
            $pdoSt->bindParam(":num_cuenta", $cuenta->num_cuenta, PDO::PARAM_INT);
            $pdoSt->bindParam(":id_cliente", $cuenta->id_cliente, PDO::PARAM_INT);
            $pdoSt->bindParam(":fecha_alta", $cuenta->fecha_alta);
            $pdoSt->bindParam(":fecha_ul_mov", $cuenta->fecha_ul_mov);
            $pdoSt->bindParam(":num_movtos", $cuenta->num_movtos, PDO::PARAM_INT);
            $pdoSt->bindParam(":saldo", $cuenta->saldo, PDO::PARAM_STR);

            // ejecuto
            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    # Método getClientes
    public function getClientes()
    {
        try {

            $sql = " 
                SELECT 
                    id,
                    concat_ws(', ', apellidos, nombre) cliente
                FROM 
                    clientes
                ORDER BY apellidos, nombre;
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

    # Método delete
    public function delete($id)
    {
        try {
            $sql = " 
                   DELETE FROM cuentas WHERE id=:id;
                   ";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdoSt->execute();
            return $pdoSt;
        } catch (PDOException $error) {
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
                        c.id,
                        c.num_cuenta,
                        c.id_cliente,
                        c.fecha_alta,
                        c.fecha_ul_mov,
                        c.num_movtos,
                        c.saldo
                    FROM 
                        cuentas as c 
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

    # Método update
    public function update(Cuenta $cuenta, $id)
    {
        try {

            $sql = " 
                    UPDATE cuentas SET
                        num_cuenta = :num_cuenta,
                        id_cliente = :id_cliente,
                        fecha_alta = :fecha_alta,
                        fecha_ul_mov = :fecha_ul_mov,
                        num_movtos = :num_movtos,
                        saldo=:saldo,
                        update_at = now()
                    WHERE
                        id=:id";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            //Vinculamos los parámetros
            $pdoSt->bindParam(":num_cuenta", $cuenta->num_cuenta, PDO::PARAM_STR, 20);
            $pdoSt->bindParam(":id_cliente", $cuenta->id_cliente, PDO::PARAM_INT);
            $pdoSt->bindParam(":fecha_alta", $cuenta->fecha_alta, PDO::PARAM_STR);
            $pdoSt->bindParam(":fecha_ul_mov", $cuenta->fecha_ul_mov, PDO::PARAM_STR);
            $pdoSt->bindParam(":num_movtos", $cuenta->num_movtos, PDO::PARAM_INT);
            $pdoSt->bindParam(":saldo", $cuenta->saldo, PDO::PARAM_STR);
            $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);

            $pdoSt->execute();
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }



    # Método order
    public function order(int $criterio)
    {
        try {

            $sql = " 
                SELECT 
                    c.id,
                    c.num_cuenta,
                    c.id_cliente,
                    c.fecha_alta,
                    c.fecha_ul_mov,
                    c.num_movtos,
                    c.saldo,
                    concat_ws(', ', cl.apellidos, cl.nombre) as cliente
                FROM 
                    cuentas AS c INNER JOIN clientes as cl 
                    ON c.id_cliente=cl.id 
                ORDER BY
                    :criterio ";

            $conexion = $this->db->connect();
            $pdoSt = $conexion->prepare($sql);
            $pdoSt->bindParam(':criterio', $criterio, PDO::PARAM_INT);
            $pdoSt->setFetchMode(PDO::FETCH_OBJ);
            $pdoSt->execute();
            return $pdoSt;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    # Método filter
    public function filter($expresion)
    {
        try {

            $sql = "
                    SELECT 
                        c.id,
                        c.num_cuenta,
                        c.id_cliente,
                        c.fecha_alta,
                        c.fecha_ul_mov,
                        c.num_movtos,
                        c.saldo,
                        concat_ws(', ', cl.apellidos, cl.nombre) as cliente
                    FROM 
                        cuentas as c INNER JOIN clientes as cl 
                        ON c.id_cliente=cl.id
                    WHERE 
                        concat_ws(  ' ',
                                    c.num_cuenta,
                                    c.id_cliente,
                                    c.fecha_alta,
                                    c.fecha_ul_mov,
                                    c.num_movtos,
                                    c.saldo,
                                    cl.nombre,
                                    cl.apellidos
                                )
                    LIKE
                        :expresion ";


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

    # Método getCliente
    public function getCliente($id)
    {
        try {
            $sql = " 
                    SELECT     
                        id,
                        apellidos,
                        nombre,
                        telefono,
                        ciudad,
                        dni,
                        email
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

    public function validateUniqueNumCuenta($num_cuenta){
        try {
            //Creamos la consulta personalizada a ejecutar
            $sql ="SELECT * FROM gesbank.cuentas WHERE num_cuenta = :cuenta";

            // Realizamos la conexión a la base de datos
            $conexion = $this->db->connect();
            $pdostmt = $conexion->prepare($sql);
            $pdostmt->bindParam('cuenta',$num_cuenta,PDO::PARAM_STR);

            // Ejecutamos la sentencia
            $pdostmt->execute();

            // Realizamos la comprobación
            if($pdostmt->rowCount() != 0){
                return false;
            }
            return true;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }

    public function validateCliente($id_cliente){
        try {
            // Creamos la sentencia personalizada a ejecutar
            $sql = "SELECT * FROM gesbank.clientes WHERE id = :idCliente LIMIT 1";

            // Realizamos la conexión a la base de datos
            $conexion = $this->db->connect();

            // Preparamos la consulta
            $pdostmt = $conexion->prepare($sql);

            // Vinculamos la variable
            $pdostmt->bindParam(':idCliente',$id_cliente,PDO::PARAM_INT);

            // Ejecutamos la sentencia
            $pdostmt->execute();

            // Realizamos la comprobación
            if($pdostmt->rowCount() == 1){
                return true;
            }
            return false;
        } catch (PDOException $e) {
            require_once("template/partials/errorDB.php");
            exit();
        }
    }


    public function validateFecha($fecha_alta){
        $formatoFecha = DateTime::createFromFormat('Y-m-d\TH:i',$fecha_alta);
        if($formatoFecha !== false){
            return true;
        } else {
            return false;
        }

    }

    public function getCSV()
    {

        try {

            # comando sql
            $sql = "SELECT 
                        cuentas.id,
                        cuentas.num_cuenta,
                        cuentas.id_cliente,
                        cuentas.fecha_alta,
                        cuentas.fecha_ul_mov,
                        cuentas.num_movtos,
                        cuentas.saldo
                    FROM
                        cuentas
                    ORDER BY 
                        cuentas.id";


            # conectamos con la base de datos

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
