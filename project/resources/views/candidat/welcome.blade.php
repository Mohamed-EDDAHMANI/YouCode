<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test en ligne</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-auto p-6">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                <h2 class="text-2xl font-bold text-white">Test en ligne</h2>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-8 text-lg">Vous devez passer le test en ligne pour continuer.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition duration-300 text-center">
                        Retour à l'accueil
                    </a>
                    <a href="{{ route('ready') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition duration-300 text-center">
                        Passer le test
                    </a>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-sm text-gray-500 text-center">
                Merci d'avoir créé votre compte
            </div>
        </div>
    </div>
</body>

</html>