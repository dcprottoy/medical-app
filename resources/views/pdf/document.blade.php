<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <img src="data:image/png;base64,{{ base64_encode($img) }}">
    <p>This PDF document is generated using domPDF A6 in Laravel.</p>
</body>
</html>
