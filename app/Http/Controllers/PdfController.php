<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;



class PdfController extends Controller
{
    public function show()
    {

        $filePath = public_path('pdf\activity.pdf');
        
          
        return response()->file($filePath);

      
    }
}
