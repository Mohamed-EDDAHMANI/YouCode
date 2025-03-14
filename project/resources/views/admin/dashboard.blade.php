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
    <div class="page one">
        @include('layouts.admin')
    </div>

    <div class=" page hidden two">
        @include('layouts.question')
    </div>
    </div>

    <div class=" page hidden quize">
        @include('layouts.quize')
    </div>

    <!-- Footer -->
    @include('layouts.footer')


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script>
        function openPage(index) {
            const pages = Array.from(document.getElementsByClassName('page'));
            pages.map(item => {
                item.classList.add('hidden')
            });
            // console.log(pages[index]);
            // console.log('-----------------');
            pages[index].classList.remove('hidden');
        }
    </script>
</body>

</html>