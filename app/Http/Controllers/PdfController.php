<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use Spatie\PdfToText\Pdf;

class PdfController extends Controller
{
    public function show(Request $request)
    {
        $file= $request->file('file');
        if ($file) {
            $requestImage = $file;
            $imageName = $request->title . '-' . $requestImage->getClientOriginalName();
            $requestImage->storeAs('public/unsubscribedfiles', $imageName);
            $imagePath = 'storage/unsubscribedfiles' . '/' . $imageName;
           
        }
        $imagepath= 'pdf/activity.pdf';

        $pdf = new Fpdi();
        $pdf->setSourceFile(public_path($imagepath));
        $totalPages = $pdf->setSourceFile(public_path($imagepath));
        $pagesToExtract = '5';
        $pagesToExtract = min($totalPages, $pagesToExtract);
        $newPdf = new Fpdi();
        $pageWidth = 400; 
        $pageHeight = 300; 
        $pageOrientation = 'P'; 

        for ($pageNo = 1; $pageNo <= 5; $pageNo++) {
            $newPdf->AddPage($pageOrientation, array($pageWidth, $pageHeight));

            $newPdf->setSourceFile(public_path($imagepath));
            $newPdf->useTemplate($newPdf->importPage($pageNo));
        }

        $newPdfContent = $newPdf->Output('S');



        // file_put_contents("output_first_5_pages.pdf", $newPdfContent);
        // return response()->download("output_first_5_pages.pdf");

        return view('pdf', ['pdfContent' => $newPdfContent, 'pagesToExtract' => $pagesToExtract]);
    }


    public function getPdfPage(Request $request, $page)
    {
        $imagepath = 'pdf\activity.pdf';
        $pdf = new Fpdi();
        $pdf->setSourceFile(public_path($imagepath));
    
        $totalPages = $pdf->setSourceFile(public_path($imagepath));
    
        // If $page is not specified or out of range, display all pages
        if ($page === null || $page < 1 || $page > $totalPages) {
            $newPdf = $pdf;
        } else {
            $newPdf = new Fpdi();
            $pageWidth = 400;
            $pageHeight = 300;
            $pageOrientation = 'P';

            
    
            $newPdf->AddPage($pageOrientation, array($pageWidth, $pageHeight));
            $newPdf->setSourceFile(public_path($imagepath));
            $newPdf->useTemplate($newPdf->importPage($page));
        }
    
        $newPdfContent = $newPdf->Output('S');
    
        return response($newPdfContent, 200)
            ->header('Content-Type', 'application/pdf');
    }
}
