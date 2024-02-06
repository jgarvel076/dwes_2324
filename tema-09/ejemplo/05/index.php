<?php 
    require ('fpdf/fpdf.php');
    $pdf=new FPDF ('P', 'mm', 'pt');
    $pdf->AddPage();
    $pdf->SetFont('Courier','',10);
    $pdf->Cell(40,10, incov('UTF-8', 'ISO-8859-1', '¡Mi primera página pdf con FPDF!'));
    $pdf->Output();

    $pdf->AddPage(L);
    $pdf->SetFont('Arial','b',10);
    $pdf->Cell(40,10, incov('UTF-8', 'ISO-8859-1', '¡Mi segunda página pdf con FPDF!'));
    $pdf->Output();