<?php

require_once('fpdf/fpdf.php');

class pdfClientes extends FPDF
{

    function __construct()
    {
        parent::__construct();

        $this->AddPage();

        $this->Titulo();
    }


    public function Header()
    {
        //Fuente y tamaño
        $this->SetFont('Arial', 'B', 10);

        //Ancho de la pagina
        $anchoPagina = $this->GetPageWidth();

        //Alineado a la izquierda
        $this->Cell(1, 10, iconv('UTF-8', 'ISO-8859-1', 'GesComercial 1.0'), 0, 0, 'L');

        //Nombre en el centro
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Julian Garcia Velazquez'), 'B', 0, 'C');

        //Curso a la derecha
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', '2DAW 23/24'), 0, 1, 'R');

        //Salto de línea 
        $this->Ln(5);
    }

    public function Footer()
    {
        //Para el numero del footer
        $this->AliasNbPages();

        //Posición vertical
        $this->SetY(-15);

        //Fuente y tamaño
        $this->SetFont('Arial', 'B', 10);

        // Numero de pagina
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 'T', 0, 'C');
    }

    public function Titulo()
    {
        //Fuente y tamaño
        $this->SetFont('Courier', 'B', 12);

        //Titulo
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Informe: Listado de Clientes'), 0, 1, 'C');

        //Fecha y hora
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Fecha: ' . date('d/m/Y H:i')), 0, 1, 'C');

        //Salto de línea
        $this->Ln(5);
    }

    public function Cabecera()
    {

        //Fuente y tamaño
        $this->SetFont('Courier', 'B', 12);

        //Escribimos el texto
        $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'ID'), 'B', 0, 'R');
        $this->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', 'nombre'), 'B', 0, 'C');
        //$this->Cell(25, 7, iconv('UTF-8', 'ISO-8859-1', 'direccion'), 'B', 0, 'C');
        $this->Cell(35, 7, iconv('UTF-8', 'ISO-8859-1', 'poblacion'), 'B', 0, 'C');
        $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'c_postal'), 'B', 0, 'C');
        //$this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'telefono'), 'B', 1, 'C');
        //$this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'email'), 'B', 1, 'C');
        $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'nif'), 'B', 1, 'C');

        //Salto de línea
        $this->Ln(5);
    }

    function Contenido($clientes)
    {
        $this->Cabecera();

        //Fuente y tamaño
        $this->SetFont('Arial', '',   10);

        foreach ($clientes as $cliente) {
            
            if ($this->GetY() + 10 > $this->PageBreakTrigger) {

                $this->AddPage();
                $this->Cabecera();
                $this->SetFont('Arial', '',   10);
            }

            $this->Cell(10, 7, mb_convert_encoding($cliente->id, 'ISO-8859-1', 'UTF-8'), 0, 0, 'R');
            $this->Cell(50, 7, mb_convert_encoding($cliente->nombre, 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
            //$this->Cell(25, 7, mb_convert_encoding($cliente->direccion, 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
            $this->Cell(35, 7, mb_convert_encoding($cliente->poblacion, 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
            $this->Cell(20, 7, mb_convert_encoding($cliente->c_postal, 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
            //$this->Cell(40, 7, mb_convert_encoding($cliente->telefono, 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
            //$this->Cell(40, 7, mb_convert_encoding($cliente->email, 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
            $this->Cell(40, 7, mb_convert_encoding($cliente->nif, 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

        }
    }
}