<?php 
    require ('fpdf/fpdf.php');
    $pdf=new FPDF ('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10, iconv('UTF-8', 'ISO-8859-1','¡Mi primera página pdf con FPDF!'));
    $pdf->Output();
