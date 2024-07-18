<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Required</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            margin-top: 50px;
        }

        .error-page {
            display: inline-block;
            padding: 20px;
            border: 1px solid #dee2e6;
            background-color: #fff;
            border-radius: 5px;
        }

        .error-page h1 {
            font-size: 24px;
            color: #dc3545;
        }

        .error-page p {
            font-size: 18px;
            color: #6c757d;
        }

        .error-page a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .error-page a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-page">
            <h1>402 LOG IN IS REQUIRED!</h1>
            <p>Sorry, you need to be logged in to access this page.</p>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</body>
</html>
