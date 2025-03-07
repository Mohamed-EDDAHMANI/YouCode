{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md">
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="text-2xl font-bold mb-6 text-center">Inscription</h2>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="flex gap-5">
                    <div>
                        <!-- Prénom -->
                        <div class="mt-4">
                            <label for="name" class="block font-medium text-gray-700">Le nom complet</label>
                            <input id="name" class="block mt-1 w-full border border-gray-300 rounded-lg p-2" type="text"
                                name="name" value="{{ old('name') }}" required autofocus />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <label for="email" class="block font-medium text-gray-700">Email</label>
                            <input id="email" class="block mt-1 w-full border border-gray-300 rounded-lg p-2"
                                type="email" name="email" value="{{ old('email') }}" required />
                        </div>

                        <!-- Mot de passe -->
                        <div class="mt-4">
                            <label for="password" class="block font-medium text-gray-700">Mot de passe</label>
                            <input id="password" class="block mt-1 w-full border border-gray-300 rounded-lg p-2"
                                type="password" name="password" required autocomplete="new-password" />
                        </div>

                    </div>

                    <div>
                        <!-- Téléphone -->
                        <div class="mt-4">
                            <label for="phone" class="block font-medium text-gray-700">Téléphone</label>
                            <input id="phone" class="block mt-1 w-full border border-gray-300 rounded-lg p-2"
                                type="number" name="phone" value="{{ old('phone') }}" required />
                        </div>

                        <!-- Adresse -->
                        <div class="mt-4">
                            <label for="address" class="block font-medium text-gray-700">Adresse</label>
                            <input id="address" class="block mt-1 w-full border border-gray-300 rounded-lg p-2"
                                type="text" name="address" required />
                        </div>

                        <!-- Date de naissance -->
                        <div class="mt-4">
                            <label for="dateBorn" class="block font-medium text-gray-700">Date de naissance</label>
                            <input id="dateBorn" class="block mt-1 w-full border border-gray-300 rounded-lg p-2"
                                type="date" name="dateBorn" required />
                        </div>
                    </div>
                </div>

                <!-- Téléchargement de l'image CIN -->
                <div class="mt-4">
                    <label for="cin" class="block font-medium text-gray-700">CIN</label>
                    <div class="mt-2">
                        <label for="cin"
                            class="block text-center cursor-pointer bg-gray-100 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-200 transition">
                            Télécharger une image
                        </label>
                        <input id="cin" type="file" name="cin" accept="image/*" class="hidden" required />
                    </div>
                </div>

                <!-- Liens et Bouton d'inscription -->
                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        Déjà inscrit ?
                    </a>

                    <button type="submit"
                        class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        S'inscrire
                    </button>
                </div>
            </form>

            <p class="mt-4 text-center text-sm">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Connectez-vous ici</a>
            </p>
        </div>
    </div>
</body>

</html>