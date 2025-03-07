<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Quiz</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-full font-sans">
    <div class="flex flex-col h-screen">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg p-6">
            <div class="max-w-6xl mx-auto flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-clipboard-list mr-3"></i>Gestion des Quiz
                </h2>
                <a href="{{ route('quizzes.create') }}"
                    class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition duration-200 flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>Créer un Nouveau Quiz
                </a>
            </div>
        </div>

        <!-- Main content with shadow -->
        <div class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-xl p-8 mb-6 border border-gray-200">
                    <!-- Quizzes Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Titre du Quiz</th>
                                    <th scope="col" class="px-6 py-3">Nombre de Questions</th>
                                    <th scope="col" class="px-6 py-3">Date de Création</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($quizzes->isEmpty() ?? "")
                                    <tr>
                                        <td colspan="4" class="text-center py-10">
                                            <div class="flex flex-col items-center justify-center space-y-4">
                                                <i class="fas fa-box-open text-6xl text-gray-300"></i>
                                                <p class="text-xl text-gray-500">Aucun quiz n'a été créé</p>
                                                <a href="{{ route('quizzes.create') }}"
                                                    class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200">
                                                    Créer votre premier quiz
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($quizzes as $quiz)
                                        <tr class="bg-white border-b hover:bg-gray-50 transition duration-200">
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                {{ $quiz->title }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                                    {{ $quiz->quastions->count() }} / 5 Questions
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $quiz->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($quiz->status)
                                                    <button class="text-green-500 hover:text-green-700">
                                                        <i class="fas fa-check-circle"></i> Activé
                                                    </button>
                                                @else
                                                    <form action="{{ route('quizzes.toggleStatus', $quiz->id) }}" method="POST"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-times-circle"></i> Désactivé
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 flex space-x-2">
                                                <a href="{{ route('quizzes.edit', $quiz->id) }}"
                                                    class="text-blue-500 hover:text-blue-700">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('quizzes.delete', $quiz->id) }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('quizzes.view', $quiz->id) }}"
                                                    class="text-green-500 hover:text-green-700">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer with subtle styling -->
        <div class="bg-white border-t border-gray-200 py-4 px-6 text-center text-gray-600 text-sm">
            <p>&copy; 2025 Système de Gestion des Quiz</p>
        </div>
    </div>
</body>

</html>