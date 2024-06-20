<?php

require_once('fpdf/fpdf.php');

class pdfProductos extends FPDF
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
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Informe: Listado de Productos'), 0, 1, 'C');

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
        $this->Cell(10, 8, iconv('UTF-8', 'ISO-8859-1', 'Id'), 'B', 0, 'R');
        $this->Cell(65, 8, iconv('UTF-8', 'ISO-8859-1', 'nombre'), 'B', 0, 'L');
        $this->Cell(45, 8, iconv('UTF-8', 'ISO-8859-1', 'ean_13'), 'B', 0, 'L');
        //$this->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', 'descripcion'), 'B', 0, 'C');
        $this->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', 'precio'), 'B', 0, 'R');
        $this->Cell(40, 8, iconv('UTF-8', 'ISO-8859-1', 'stock'), 'B', 1, 'R');

        //Salto de línea
        $this->Ln(5);
    }

    function Contenido($productos)
    {
        $this->Cabecera();

        //Fuente y tamaño
        $this->SetFont('Arial', '',   10);

        foreach ($productos as $producto) {
            
            if ($this->GetY() + 10 > $this->PageBreakTrigger) {

                $this->AddPage();
                $this->Cabecera();
                $this->SetFont('Arial', '',   10);
            }

            $this->Cell(10, 9, iconv('UTF-8', 'ISO-8859-1', $producto->id), 0, 0, 'R');
            $this->Cell(65, 9, iconv('UTF-8', 'ISO-8859-1', $producto->nombre), 0, 0, 'L');
            $this->Cell(45, 9, iconv('UTF-8', 'ISO-8859-1', $producto->ean_13), 0, 0, 'L');
            //$this->Cell(30, 9, iconv('UTF-8', 'ISO-8859-1', $producto->descripcion), 0 , 0, 'C');            
            $this->Cell(30, 9, iconv('UTF-8', 'ISO-8859-1', $producto->precio_venta), 0 , 0, 'R');
            $this->Cell(40, 9, iconv('UTF-8', 'ISO-8859-1', $producto->stock), 0 , 1, 'R');
        }
    }
}