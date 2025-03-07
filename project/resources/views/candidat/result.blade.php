<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Score</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="bg-indigo-600 px-6 py-4">
            <h1 class="text-xl font-bold text-white">{{ __('Votre Score') }}</h1>
        </div>

        <div class="p-6">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Votre score actuel') }}</h2>
                
                <div class="bg-gray-100 rounded-lg p-6 my-6">
                    <span class="text-6xl font-bold text-indigo-600">{{ $correctAnswersCount ?? 0 }}</span>
                    <span class="text-gray-500 ml-2 text-xl">/ 5</span>
                </div>

                @if(($correctAnswersCount ?? 0) < 50)
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
                        {{ __('Vous pouvez améliorer votre score!') }}
                    </div>
                @elseif(($correctAnswersCount ?? 0) >= 50 && ($correctAnswersCount ?? 0) < 80)
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded">
                        {{ __('Bon travail! Continuez comme ça!') }}
                    </div>
                @else
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                        {{ __('Excellent! Votre score est très bon!') }}
                    </div>
                @endif
            </div>

            <div class="text-center border-t pt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('Besoin d\'aide?') }}</h3>
                <p class="text-gray-600 mb-6">{{ __('Prenez rendez-vous avec un de nos conseillers pour améliorer votre score.') }}</p>
                <a href="{{ route('rendez-vous.create') }}" 
                   class="inline-block px-6 py-3 bg-indigo-600 text-white font-medium text-base leading-tight rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out">
                    {{ __('Prendre un rendez-vous') }}
                </a>
            </div>
        </div>
    </div>
</body>

</html>