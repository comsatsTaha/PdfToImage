<!DOCTYPE html>
<html>
<head>
    <title>Embedded PDF</title>
</head>
<body>
    <embed src="data:application/pdf;base64,{{ base64_encode($pdfContent) }}" width="100%" height="500">
</body>
</html>
