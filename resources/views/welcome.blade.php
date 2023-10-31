<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="pdfContainer"></div>

    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script> <!-- Use a CDN-hosted PDF.js library -->

    <script>
       var pdfUrl = @json(asset('pdf/activity.pdf'));

        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdfDoc) {
            var pdfContainer = document.getElementById('pdfContainer');

            for (var pageNum = 1; pageNum <= 5; pageNum++) {
                pdfDoc.getPage(pageNum).then(function(page) {
                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');

                    var viewport = page.getViewport({ scale: 1.5 });

                    canvas.width = viewport.width;
                    canvas.height = viewport.height;

                    pdfContainer.appendChild(canvas);

                    page.render({
                        canvasContext: context,
                        viewport: viewport
                    });
                });
            }
        });
    </script>
</body>
</html>
