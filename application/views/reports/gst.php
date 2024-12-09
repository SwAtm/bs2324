<?php

tfpdf();
$c=count($det['b2b']);

//if ($c>20):
$pdf = new tFPDF('L', 'mm', array(210,296));
//$noofpages = ceil(count($details)/28);
//else:
//$pdf = new tFPDF('L', 'mm', array(210,148));
//endif;
$pdf->setLeftMargin(10);
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
//$pdf->Image(base_url(IMGPATH.'logo.jpg'),10,10,15,'');
$pdf->setXY(0,10);
$pdf->Cell(276,5,$this->session->cname.' - '.$this->session->loc_name,0,1,'C');
$pdf->ln(2);
$pdf->cell(276,0,'',1,1);
$pdf->ln(5);
$pdf->SetFont('Arial','',8);
$pdf->cell(276,5,'GST Report from '.$frdate. ' to '.$todate,0,1,'C');
$pdf->ln(5);
$pdf->cell(276,5,'B2B',0,1,'C');
$pdf->ln(5);
$pdf->cell(15,5,'Bill No',1,0,'L');
$pdf->cell(16,5,'Date',1,0,'L');
$pdf->cell(59,5,'Party',1,0,'L');
$pdf->cell(35,5,'Place of Supply',1,0,'L');
$pdf->cell(35,5,'GST No',1,0,'L');
$pdf->cell(16,5,'Rate of Tax',1,0,'L');
$pdf->cell(20,5,'Taxable Amount',1,0,'L');
$pdf->cell(20,5,'CGST',1,0,'L');
$pdf->cell(20,5,'SGST',1,0,'L');
$pdf->cell(20,5,'IGST',1,0,'L');
$pdf->cell(20,5,'TOTAL',1,1,'L');
$tamount=$cgst=$sgst=$igst=$amount=$damount=0;
foreach ($det['b2b'] as $de):
		$pdf->cell(15,5,$de['series'].'-'.$de['no'],1,0,'L');
		$pdf->cell(16,5,$de['date'],1,0,'L');
		$pdf->cell(59,5,$de['name'].'-'.$de['city'],1,0,'L');
		$pdf->cell(35,5,$de['party_state'],1,0,'L');
		$pdf->cell(35,5,$de['party_gstno'],1,0,'L');
		$pdf->cell(16,5,$de['gst_rate'],1,0,'L');
		$pdf->cell(20,5,number_format($de['taxable'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['cgst'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['sgst'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['igst'],2,'.',','),1,0,'R');
		$damount=$de['taxable']+$de['cgst']+$de['sgst']+$de['igst'];
		$pdf->cell(20,5,number_format($damount,2,'.',','),1,1,'R');
		$tamount+=$de['taxable'];
		$cgst+=$de['cgst'];
		$sgst+=$de['sgst'];
		$igst+=$de['igst'];
		$amount+=$damount;
		if ($pdf->getY()>180):
		//$pdf->cell(15,5,$pdf->getY(),1,1,'R');
			$pdf->AddPage();
			$pdf->cell(15,5,'Bill No',1,0,'L');
			$pdf->cell(16,5,'Date',1,0,'L');
			$pdf->cell(59,5,'Party',1,0,'L');
			$pdf->cell(35,5,'Place of Supply',1,0,'L');
			$pdf->cell(35,5,'GST No',1,0,'L');
			$pdf->cell(16,5,'Rate of Tax',1,0,'L');
			$pdf->cell(20,5,'Taxable Amount',1,0,'L');
			$pdf->cell(20,5,'CGST',1,0,'L');
			$pdf->cell(20,5,'SGST',1,0,'L');
			$pdf->cell(20,5,'IGST',1,0,'L');
			$pdf->cell(20,5,'TOTAL',1,1,'L');
		endif;
endforeach;
	$pdf->cell(176,5,'Total',1,0,'C');
	$pdf->cell(20,5,number_format($tamount,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($cgst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($sgst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($igst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($amount,2,'.',','),1,1,'R');

$pdf->ln(5);
$pdf->cell(276,5,'B2CL',0,1,'C');
if (empty($det['b2cl'])):
$pdf->cell(276,5,'No B2C Large Invoices',0,1,'C');
else:

$pdf->cell(15,5,'Bill No',1,0,'L');
$pdf->cell(16,5,'Date',1,0,'L');
$pdf->cell(59,5,'Party',1,0,'L');
$pdf->cell(35,5,'Place of Supply',1,0,'L');
//$pdf->cell(35,5,'GST No',1,0,'L');
$pdf->cell(16,5,'Rate of Tax',1,0,'L');
$pdf->cell(20,5,'Taxable Amount',1,0,'L');
//$pdf->cell(20,5,'CGST',1,0,'L');
//$pdf->cell(20,5,'SGST',1,0,'L');
$pdf->cell(20,5,'IGST',1,0,'L');
$pdf->cell(20,5,'TOTAL',1,1,'L');
$tamount=$igst=$amount=$damount=0;
foreach ($det['b2cl'] as $de):
		$pdf->cell(15,5,$de['series'].'-'.$de['no'],1,0,'L');
		$pdf->cell(16,5,$de['date'],1,0,'L');
		$pdf->cell(59,5,$de['name'].'-'.$de['city'],1,0,'L');
		$pdf->cell(35,5,$de['party_state'],1,0,'L');
		//$pdf->cell(35,5,$de['gstno'],1,0,'L');
		$pdf->cell(16,5,$de['gst_rate'],1,0,'L');
		$pdf->cell(20,5,number_format($de['taxable'],2,'.',','),1,0,'R');
		//$pdf->cell(20,5,number_format($de['cgst'],2,'.',','),1,0,'R');
		//$pdf->cell(20,5,number_format($de['sgst'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['igst'],2,'.',','),1,0,'R');
		$damount=$de['taxable']+$de['igst'];
		$pdf->cell(20,5,number_format($damount,2,'.',','),1,1,'R');
		$tamount+=$de['taxable'];
		//$cgst+=$de['cgst'];
		//$sgst+=$de['sgst'];
		$igst+=$de['igst'];
		$amount+=$damount;
		if ($pdf->getY()>180):
		//$pdf->cell(15,5,$pdf->getY(),1,1,'R');
			$pdf->AddPage();
			$pdf->cell(15,5,'Bill No',1,0,'L');
			$pdf->cell(16,5,'Date',1,0,'L');
			$pdf->cell(59,5,'Party',1,0,'L');
			$pdf->cell(35,5,'Place of Supply',1,0,'L');
			//$pdf->cell(35,5,'GST No',1,0,'L');
			$pdf->cell(16,5,'Rate of Tax',1,0,'L');
			$pdf->cell(20,5,'Taxable Amount',1,0,'L');
			//$pdf->cell(20,5,'CGST',1,0,'L');
			//$pdf->cell(20,5,'SGST',1,0,'L');
			$pdf->cell(20,5,'IGST',1,0,'L');
			$pdf->cell(20,5,'TOTAL',1,1,'L');
		endif;
endforeach;
	$pdf->cell(141,5,'Total',1,0,'C');
	$pdf->cell(20,5,number_format($tamount,2,'.',','),1,0,'R');
	//$pdf->cell(20,5,number_format($cgst,2,'.',','),1,0,'R');
	//$pdf->cell(20,5,number_format($sgst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($igst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($amount,2,'.',','),1,1,'R');

endif;



$pdf->ln(5);
$pdf->cell(276,5,'B2CS',0,1,'C');
if (empty($det['b2cs'])):
$pdf->cell(276,5,'No B2C Small Invoices',0,1,'C');
else:

$pdf->cell(35,5,'Place of Supply',1,0,'L');
$pdf->cell(20,5,'Taxable Amount',1,0,'L');
$pdf->cell(16,5,'Rate of Tax',1,0,'L');
$pdf->cell(20,5,'CGST',1,0,'L');
$pdf->cell(20,5,'SGST',1,0,'L');
$pdf->cell(20,5,'IGST',1,0,'L');
$pdf->cell(20,5,'TOTAL',1,1,'L');
$tamount=$igst=$cgst=$sgst=$amount=$damount=0;
foreach ($det['b2cs'] as $de):
		$pdf->cell(35,5,$de['party_state'],1,0,'L');
		$pdf->cell(20,5,number_format($de['taxable'],2,'.',','),1,0,'R');
		$pdf->cell(16,5,$de['gst_rate'],1,0,'L');
		$pdf->cell(20,5,number_format($de['cgst'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['sgst'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['igst'],2,'.',','),1,0,'R');		
		$damount=$de['taxable']+$de['igst']+$de['cgst']+$de['sgst'];
		$pdf->cell(20,5,number_format($damount,2,'.',','),1,1,'R');
		$tamount+=$de['taxable'];
		$cgst+=$de['cgst'];
		$sgst+=$de['sgst'];
		$igst+=$de['igst'];
		$amount+=$damount;
		if ($pdf->getY()>180):
			//$pdf->cell(15,5,$pdf->getY(),1,1,'R');
			$pdf->AddPage();
			$pdf->cell(35,5,'Place of Supply',1,0,'L');
			$pdf->cell(20,5,'Taxable Amount',1,0,'L');
			$pdf->cell(16,5,'Rate of Tax',1,0,'L');
			$pdf->cell(20,5,'CGST',1,0,'L');
			$pdf->cell(20,5,'SGST',1,0,'L');
			$pdf->cell(20,5,'IGST',1,0,'L');
			$pdf->cell(20,5,'TOTAL',1,1,'L');
		endif;
endforeach;
	$pdf->cell(35,5,'Total',1,0,'C');
	//$pdf->cell(16,5,'',1,0,'R');
	$pdf->cell(20,5,number_format($tamount,2,'.',','),1,0,'R');
	$pdf->cell(16,5,'',1,0,'R');
	$pdf->cell(20,5,number_format($cgst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($sgst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($igst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($amount,2,'.',','),1,1,'R');

endif;
		if ($pdf->getY()>175):
			$pdf->AddPage();
		endif;
//$pdf->cell(276,5,$pdf->getY(),0,1,'C');
$pdf->ln(5);
$pdf->cell(276,5,'Nil_Exempt',0,1,'C');

$pdf->cell(35,5,'Party Type',1,0,'L');
$pdf->cell(35,5,'Nil_Rated',1,0,'L');
$pdf->cell(20,5,'Exempt',1,1,'L');
foreach ($det['nil'] as $ne):
$pdf->cell(35,5,'Intra Regd',1,0,'L');
$pdf->cell(35,5,number_format($ne['intrarnil'],2,'.',','),1,0,'L');
$pdf->cell(20,5,number_format($ne['intrarexe'],2,'.',','),1,1,'L');
 
$pdf->cell(35,5,'Intra UnRegd',1,0,'L');
$pdf->cell(35,5,number_format($ne['intraunil'],2,'.',','),1,0,'L');
$pdf->cell(20,5,number_format($ne['intrauexe'],2,'.',','),1,1,'L');

$pdf->cell(35,5,'Inter Regd',1,0,'L');
$pdf->cell(35,5,number_format($ne['interrnil'],2,'.',','),1,0,'L');
$pdf->cell(20,5,number_format($ne['interrexe'],2,'.',','),1,1,'L');

$pdf->cell(35,5,'Inter UnRegd',1,0,'L');
$pdf->cell(35,5,number_format($ne['interunil'],2,'.',','),1,0,'L');
$pdf->cell(20,5,number_format($ne['interuexe'],2,'.',','),1,1,'L');

$pdf->cell(35,5,'Total',1,0,'L');
$pdf->cell(35,5,number_format($ne['interrnil']+$ne['interunil']+$ne['intrarnil']+$ne['intraunil'],2,'.',','),1,0,'L');
$pdf->cell(20,5,number_format($ne['interrexe']+$ne['interuexe']+$ne['intrarexe']+$ne['intrauexe'],2,'.',','),1,1,'L');

endforeach;

		if ($pdf->getY()>175):
			$pdf->AddPage();
		endif;
$pdf->ln(5);
$pdf->cell(276,5,'HSN',0,1,'C');
$pdf->cell(35,5,'HSN Number',1,0,'L');
$pdf->cell(20,5,'Quantity',1,0,'L');
$pdf->cell(20,5,'Taxable Amount',1,0,'L');
$pdf->cell(16,5,'Rate of Tax',1,0,'L');
$pdf->cell(20,5,'IGST',1,0,'L');
$pdf->cell(20,5,'CGST',1,0,'L');
$pdf->cell(20,5,'SGST',1,0,'L');
$pdf->cell(20,5,'TOTAL',1,1,'L');
$tamount=$igst=$cgst=$sgst=$amount=$damount=0;
foreach ($det['hsn'] as $de):
		$pdf->cell(35,5,$de['hsn'],1,0,'L');
		$pdf->cell(20,5,$de['quantity'],1,0,'L');
		$pdf->cell(20,5,number_format($de['taxable'],2,'.',','),1,0,'R');
		$pdf->cell(16,5,$de['gst_rate'],1,0,'L');
		$pdf->cell(20,5,number_format($de['igst'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['cgst'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['sgst'],2,'.',','),1,0,'R');
		$damount=$de['taxable']+$de['igst']+$de['cgst']+$de['sgst'];
		$pdf->cell(20,5,number_format($damount,2,'.',','),1,1,'R');
		$tamount+=$de['taxable'];
		$cgst+=$de['cgst'];
		$sgst+=$de['sgst'];
		$igst+=$de['igst'];
		$amount+=$damount;
		if ($pdf->getY()>180):
		//$pdf->cell(15,5,$pdf->getY(),1,1,'R');
			$pdf->AddPage();
			$pdf->cell(276,5,'HSN',0,1,'C');
			$pdf->cell(35,5,'HSN Number',1,0,'L');
			$pdf->cell(20,5,'Quantity',1,0,'L');
			$pdf->cell(20,5,'Taxable Amount',1,0,'L');
			$pdf->cell(16,5,'Rate of Tax',1,0,'L');
			$pdf->cell(20,5,'IGST',1,0,'L');
			$pdf->cell(20,5,'CGST',1,0,'L');
			$pdf->cell(20,5,'SGST',1,0,'L');
			$pdf->cell(20,5,'TOTAL',1,1,'L');;

		endif;
endforeach;
	$pdf->cell(55,5,'Total',1,0,'C');
	$pdf->cell(20,5,number_format($tamount,2,'.',','),1,0,'R');
	$pdf->cell(16,5,'',1,0,'R');
	$pdf->cell(20,5,number_format($igst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($cgst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($sgst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($amount,2,'.',','),1,1,'R');


//Documents
if ($pdf->getY()>150):
		//$pdf->cell(15,5,$pdf->getY(),1,1,'R');
			$pdf->AddPage();
endif;
$pdf->ln(5);
$pdf->cell(276,5,'Documents',0,1,'C');
$pdf->cell(276,5,'Outward Invoices',0,1,'C');

$pdf->cell(35,5,'From',1,0,'L');
$pdf->cell(35,5,'To',1,0,'L');
$pdf->cell(35,5,'Toal Issued',1,0,'L');
$pdf->cell(35,5,'Cancelled',1,0,'L');
$pdf->cell(35,5,'Net Issued',1,1,'L');
foreach ($det['documents'] as $doc=>$v):
$pdf->cell(35,5,$doc.'-'.$v['begin'],1,0,'L');
$pdf->cell(35,5,$doc.'-'.$v['end'],1,0,'L');
$pdf->cell(35,5,$v['total'],1,0,'L');
$pdf->cell(35,5,$v['cancelled'],1,0,'L');
$pdf->cell(35,5,$v['total']-$v['cancelled'],1,1,'L');
endforeach;





//if ($c>20):

//else:
//$pdf->Image(base_url(IMGPATH.'home.png'),105,140,5,'','',site_url('welcome/home'));
//endif;
if ($pdf->getY()>175):
		//$pdf->cell(15,5,$pdf->getY(),1,1,'R');
			$pdf->AddPage();
endif;
$pdf->ln(5);
$pdf->cell(276,5,'OUTWARD',0,1,'C');
$pdf->cell(50,5,'Nature of Supplies',1,0,'L');
$pdf->cell(20,5,'Taxable Amount',1,0,'L');
$pdf->cell(20,5,'CGST',1,0,'L');
$pdf->cell(20,5,'SGST',1,0,'L');
$pdf->cell(20,5,'IGST',1,0,'L');
$pdf->cell(20,5,'TOTAL',1,1,'L');
$pdf->cell(50,5,'Taxable Sales',1,0,'C');
$pdf->cell(20,5,number_format($tamount,2,'.',','),1,0,'R');
$pdf->cell(20,5,number_format($cgst,2,'.',','),1,0,'R');
$pdf->cell(20,5,number_format($sgst,2,'.',','),1,0,'R');
$pdf->cell(20,5,number_format($igst,2,'.',','),1,0,'R');
$pdf->cell(20,5,number_format($amount,2,'.',','),1,1,'R');
$pdf->cell(50,5,'Nil Rated/Exempted Sales',1,0,'C');
$pdf->cell(20,5,number_format($ne['interrnil']+$ne['interunil']+$ne['intrarnil']+$ne['intraunil']+$ne['interrexe']+$ne['interuexe']+$ne['intrarexe']+$ne['intrauexe'],2,'.',','),1,0,'R');
$pdf->cell(20,5,'',1,0,'R');
$pdf->cell(20,5,'',1,0,'R');
$pdf->cell(20,5,'',1,0,'R');
$pdf->cell(20,5,number_format($ne['interrnil']+$ne['interunil']+$ne['intrarnil']+$ne['intraunil']+$ne['interrexe']+$ne['interuexe']+$ne['intrarexe']+$ne['intrauexe'],2,'.',','),1,1,'R');



$pdf->ln(5);
$pdf->cell(276,5,'GST3.2',0,1,'C');
$pdf->cell(15,5,'Bill No',1,0,'L');
$pdf->cell(16,5,'Date',1,0,'L');
$pdf->cell(59,5,'Party',1,0,'L');
$pdf->cell(35,5,'Place of Supply',1,0,'L');
$pdf->cell(35,5,'Party Status',1,0,'L');
$pdf->cell(16,5,'Rate of Tax',1,0,'L');
$pdf->cell(20,5,'Taxable Amount',1,0,'L');
$pdf->cell(20,5,'IGST',1,0,'L');
$pdf->cell(20,5,'TOTAL',1,1,'L');

foreach ($det['gst32'] as $de):
		$pdf->cell(15,5,$de['series'].'-'.$de['no'],1,0,'L');
		$pdf->cell(16,5,$de['date'],1,0,'L');
		$pdf->cell(59,5,$de['name'].'-'.$de['city'],1,0,'L');
		$pdf->cell(35,5,$de['party_state'],1,0,'L');
		$pdf->cell(35,5,$de['party_status'],1,0,'L');
		$pdf->cell(16,5,$de['gst_rate'],1,0,'L');
		$pdf->cell(20,5,number_format($de['taxable'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['igst'],2,'.',','),1,0,'R');
		$damount=$de['taxable']+$de['igst'];
		$pdf->cell(20,5,number_format($damount,2,'.',','),1,1,'R');
		
		if ($pdf->getY()>180):
			$pdf->AddPage();
			$pdf->ln(5);
			$pdf->cell(276,5,'GST3.2',0,1,'C');
			$pdf->cell(15,5,'Bill No',1,0,'L');
			$pdf->cell(16,5,'Date',1,0,'L');
			$pdf->cell(59,5,'Party',1,0,'L');
			$pdf->cell(35,5,'Place of Supply',1,0,'L');
			$pdf->cell(35,5,'Party Status',1,0,'L');
			$pdf->cell(16,5,'Rate of Tax',1,0,'L');
			$pdf->cell(20,5,'Taxable Amount',1,0,'L');
			$pdf->cell(20,5,'IGST',1,0,'L');
			$pdf->cell(20,5,'TOTAL',1,1,'L');
		endif;
endforeach;


$pdf->ln(5);

$pdf->ln(5);
$pdf->cell(276,5,'ITC',0,1,'C');
$pdf->cell(15,5,'Bill No',1,0,'L');
$pdf->cell(16,5,'Date',1,0,'L');
$pdf->cell(59,5,'Party',1,0,'L');
$pdf->cell(35,5,'Place of Supply',1,0,'L');
$pdf->cell(35,5,'GST No',1,0,'L');
$pdf->cell(20,5,'Taxable Amount',1,0,'L');
$pdf->cell(20,5,'CGST',1,0,'L');
$pdf->cell(20,5,'SGST',1,0,'L');
$pdf->cell(20,5,'IGST',1,0,'L');
$pdf->cell(20,5,'TOTAL',1,1,'L');
$tamount=$cgst=$sgst=$igst=$amount=$damount=0;
foreach ($det['gstitc'] as $de):
		$pdf->cell(15,5,$de['series'].'-'.$de['no'],1,0,'L');
		$pdf->cell(16,5,$de['date'],1,0,'L');
		$pdf->cell(59,5,$de['name'].'-'.$de['city'],1,0,'L');
		$pdf->cell(35,5,$de['party_state'],1,0,'L');
		$pdf->cell(35,5,$de['party_gstno'],1,0,'L');
		$pdf->cell(20,5,number_format($de['taxable'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['cgst'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['sgst'],2,'.',','),1,0,'R');
		$pdf->cell(20,5,number_format($de['igst'],2,'.',','),1,0,'R');
		$damount=$de['taxable']+$de['cgst']+$de['sgst']+$de['igst'];
		$pdf->cell(20,5,number_format($damount,2,'.',','),1,1,'R');
		$tamount+=$de['taxable'];
		$cgst+=$de['cgst'];
		$sgst+=$de['sgst'];
		$igst+=$de['igst'];
		$amount+=$damount;
		if ($pdf->getY()>180):
		//$pdf->cell(15,5,$pdf->getY(),1,1,'R');
			$pdf->AddPage();
			
			$pdf->cell(15,5,'Bill No',1,0,'L');
			$pdf->cell(16,5,'Date',1,0,'L');
			$pdf->cell(59,5,'Party',1,0,'L');
			$pdf->cell(35,5,'Place of Supply',1,0,'L');
			$pdf->cell(35,5,'GST No',1,0,'L');
			$pdf->cell(20,5,'Taxable Amount',1,0,'L');
			$pdf->cell(20,5,'CGST',1,0,'L');
			$pdf->cell(20,5,'SGST',1,0,'L');
			$pdf->cell(20,5,'IGST',1,0,'L');
			$pdf->cell(20,5,'TOTAL',1,1,'L');
		endif;
endforeach;
	$pdf->cell(160,5,'Total',1,0,'C');
	$pdf->cell(20,5,number_format($tamount,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($cgst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($sgst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($igst,2,'.',','),1,0,'R');
	$pdf->cell(20,5,number_format($amount,2,'.',','),1,1,'R');

		if ($pdf->getY()>180):
		//$pdf->cell(15,5,$pdf->getY(),1,1,'R');
			$pdf->AddPage();
			endif;

$pdf->ln(5);
$pdf->cell(276,5,'Nil_Inward',0,1,'C');

$pdf->cell(135,5,'Nature of Supply',1,0,'L');
$pdf->cell(35,5,'Inter State',1,0,'L');
$pdf->cell(20,5,'Intra-State',1,1,'L');
foreach ($det['gstnilinward'] as $ne):
$pdf->cell(135,5,'From a Supplier under compo scheme, exempt and nil rated supply',1,0,'L');
$pdf->cell(35,5,number_format($ne['inter'],2,'.',','),1,0,'L');
$pdf->cell(20,5,number_format($ne['intra'],2,'.',','),1,1,'L');
endforeach;



$pdf->Image(base_url(IMGPATH.'home.png'),145,200,5,'','',site_url('welcome/home'));



$pdf->output();






echo $frdate."<br>".$todate."<br>";
echo "<pre>";
print_r($det['documents']);
echo "</pre>";
print_r($series);
echo "<a href = ".site_url('welcome/home').">Home</a>";

?>
