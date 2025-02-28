<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouCode - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .youcode-logo {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .youcode-logo .you {
            color: #000;
        }

        .youcode-logo .code {
            color: #2563eb;
        }
    </style>
</head>

<body class="bg-gray-100">


    <!-- home admin -->
    <div class="page">
        @include('layouts.admin')
    </div>

    <div class="hidden page">
        @include('layouts.question')
    </div>

    <!-- Footer -->
    @include('layouts.footer')


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>