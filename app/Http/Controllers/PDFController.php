<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $image = $generator->getBarcode('081331723987', $generator::TYPE_CODE_128);
        $data = ['title' => 'domPDF in Laravel 10','img'=>$image];

        // $customPaper = array(0,0,650,1100);
        // $pdf = PDF::setPaper($customPaper,'potrait')->loadView('pdf.document', $data);
        $pdf = PDF::setPaper('A6','potrait')->loadView('pdf.document', $data);

        return $pdf->stream('document.pdf');



        // return response($image)->header('Content-type','image/png');

    }
}
