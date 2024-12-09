<?php
tfpdf();
$pdf = new tFPDF('P', 'mm', array(210,296));
$pdf->setLeftMargin(10);
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->cell(190, 5, 'Inventory as on: '.Date('d-m-Y').' at '.$this->session->loc_name, 0,1);
$i=1;
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,7,'Code',1,0,'C');
$pdf->Cell(80,7,'Item',1,0,'C');
$pdf->Cell(20,7,'Rate',1,0,'C');
$pdf->Cell(20,7,'Cl Bal',1,0,'C');
$pdf->Cell(20,7,'Act Stck',1,0,'C');
$pdf->Cell(20,7,'Diff',1,0,'C');
$pdf->Cell(20,7,'Diff Value',1,1,'C');
//$pdf->Cell(30,7,'',1,1,'C');
$total=$costofbooks=$costofarticles=0;
foreach ($invent as $st):
/*
if ((($st['clbal']*$st['cost'])-($st['stock']*$st['cost']))>-1000 and (($st['clbal']*$st['cost'])-($st['stock']*$st['cost']))<1000):

continue;
endif;
* */
$pdf->Cell(15,7,$st['item_id'],1,0,'C');
$pdf->Cell(80,7,substr($st['title'],0,28),1,0,'L');
$pdf->Cell(20,7,number_format($st['rate'],2,'.',''),1,0,'C');
$pdf->Cell(20,7,$st['clbal'],1,0,'C');
$pdf->Cell(20,7,$st['stock'],1,0,'C');
$pdf->Cell(20,7,number_format(($st['clbal']-$st['stock']),0),1,0,'C');
$pdf->Cell(20,7,number_format((($st['clbal']*$st['cost'])-($st['stock']*$st['cost'])),2),1,1,'C');
//$pdf->Cell(30,7,'',1,1,'C');
$total+=($st['clbal']*$st['cost'])-($st['stock']*$st['cost']);
if($st['name']=='Books'):
$costofbooks+=$st['stock']*$st['cost'];
else:
$costofarticles+=$st['stock']*$st['cost'];
endif;
if ($pdf->GetY()>=270):
$pdf->ln(5);
$pdf->Cell(190,5,'Total '.$total,0,1,'R');
$pdf->Cell(190,5,'Page '.$i,0,1,'C');
$i++;
$pdf->AddPage();
$pdf->Cell(15,7,'Code',1,0,'C');
$pdf->Cell(80,7,'Item',1,0,'C');
$pdf->Cell(20,7,'Rate',1,0,'C');
$pdf->Cell(20,7,'Cl Bal',1,0,'C');
$pdf->Cell(20,7,'Act Stck',1,0,'C');
$pdf->Cell(20,7,'Diff',1,0,'C');
$pdf->Cell(20,7,'Diff Value',1,1,'C');
endif;
endforeach;
$pdf->SetY(266);
$pdf->Cell(190,5,'Total '.$total,0,1,'R');
$pdf->Cell(190,5,'Page '.$i,0,1,'C');
$pdf->AddPage();
$pdf->cell(95,5,'Stock of Religious Literature', 1,0,'C');
$pdf->cell(95,5,$costofbooks, 1,1,'C');
$pdf->cell(95,5,'Stock of Religious Articles', 1,0,'C');
$pdf->cell(95,5,$costofarticles, 1,1,'C');
$pdf->cell(95,5,'Total Stock', 1,0,'C');
$pdf->cell(95,5,number_format(($costofarticles+$costofbooks),2,'.',','),1,1,'C');
$pdf->cell(95,5,'Stock*myprice per Stock File', 1,0,'C');
$pdf->cell(95,5,$stockmyprice, 1,1,'C');
$pdf->cell(95,5,'Stock*myprice per Inventory File', 1,0,'C');
$pdf->cell(95,5,$invmyprice, 1,1,'C');
$pdf->SetY(266);
$pdf->Image(base_url(IMGPATH.'home.png'),105,276,5,'','',site_url('welcome/home'));
$pdf->output();




?>
