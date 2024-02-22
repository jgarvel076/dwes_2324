<?php

require('fpdf/fpdf.php');

class pdfCuentas extends FPDF
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
        $this->Cell(1, 10, iconv('UTF-8', 'ISO-8859-1', 'Gesbank 1.0'), 0, 0, 'L');

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
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Informe: Listado de Cuentas'), 0, 1, 'C', true);

        //Fecha y hora
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Fecha: ' . date('d/m/Y H:i')), 0, 1, 'C', true);

        //Salto de línea
        $this->Ln(5);
    }

    public function Cabecera()
    {

        //Fuente y tamaño
        $this->SetFont('Courier', 'B', 12);

        //Escribimos el texto
        $this->Cell(10, 8, iconv('UTF-8', 'ISO-8859-1', 'Id'), 'B', 0, 'R', true);
        $this->Cell(40, 8, iconv('UTF-8', 'ISO-8859-1', 'Nº Cuenta'), 'B', 0, 'C', true);
        $this->Cell(60, 8, iconv('UTF-8', 'ISO-8859-1', 'Cliente'), 'B', 0, 'C', true);
        $this->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', 'Fecha Alta'), 'B', 0, 'C', true);
        $this->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', 'Nº Movs.'), 'B', 0, 'C', true);
        $this->Cell(25, 8, iconv('UTF-8', 'ISO-8859-1', 'Saldo'), 'B', 1, 'C', true);

        //Salto de línea
        $this->Ln(5);
    }

    function Contenido($clientes)
    {
        $this->Cabecera();

        //Fuente y tamaño
        $this->SetFont('Arial', '',   10);

        foreach ($cuentas as $cuenta) {
            
            if ($this->GetY() + 10 > $this->PageBreakTrigger) {

                $this->AddPage();
                $this->Cabecera();
                $this->SetFont('Arial', '',   10);
            }

            $this->Cell(10, 9, iconv('UTF-8', 'ISO-8859-1', $cuenta->id), 'B', 0, 'R', true);
            $this->Cell(40, 9, iconv('UTF-8', 'ISO-8859-1', $cuenta->num_cuenta), 'B', 0, 'C', true);
            $this->Cell(60, 9, iconv('UTF-8', 'ISO-8859-1', $cuenta->cliente), 'B', 0, 'C', true);
            $this->Cell(30, 9, iconv('UTF-8', 'ISO-8859-1', $cuenta->fecha_alta), 'B', 0, 'C', true);
            $this->Cell(30, 9, iconv('UTF-8', 'ISO-8859-1', $cuenta->num_movtos), 'B', 0, 'C', true);
            $this->Cell(25, 9, iconv('UTF-8', 'ISO-8859-1', $cuenta->saldo), 'B', 1, 'C', true);
        }
    }
}