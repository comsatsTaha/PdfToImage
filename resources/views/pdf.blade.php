<!DOCTYPE html>
<html>
<head>
    <title>Embedded PDF</title>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



</head>
<body>
    <embed id="pdf-embed" src="data:application/pdf;base64,{{ base64_encode($pdfContent) }}" width="100%" height="500">

        <div id="pagination">
            @for ($pageNo = 1; $pageNo <= $pagesToExtract; $pageNo++)
                <button class="page-button" data-page="{{ $pageNo }}">{{ $pageNo }}</button>
            @endfor
        </div>
        
        <script>
          
        
            var dataPageValue = "4"; 
            const pdfEmbed = document.getElementById('pdf-embed');
            
            var baseUrl = pdfEmbed.src.split('#')[0];
            
            pdfEmbed.src = baseUrl + `#page=${dataPageValue}`;
        </script>
        
        
  
      

    <script>
       
    </script>


        
</body>
</html>
