@include('layouts.sidbar')

<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une question</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 h-full w-full flex flex-col">
    <!-- Main container with full height and overflow handling -->
    <div class="flex flex-col h-screen w-full">
        <!-- Header section with fixed height -->
        <div class="bg-white shadow-md p-4 border-b">
            <h2 class="text-2xl font-bold text-gray-800">Liste des questions</h2>
        </div>

        <!-- Content area with overflow scroll -->
        <div class="flex-1 overflow-y-auto p-4">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <!-- Search or filter options could go here -->
                <div class="flex justify-between mb-4">
                    <input type="text" placeholder="Rechercher une question..."
                        class="px-4 py-2 border rounded-lg w-64">
                    <a href="{{ route('createQuestion') }}" onclick=""
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Nouvelle question
                    </a>
                </div>

                <!-- Table with questions -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-4 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">
                                    Question</th>
                                <th
                                    class="px-4 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">
                                    Réponses</th>
                                <th
                                    class="px-4 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        <input type="text" value="{{ $question->designation }}">
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200">
                                        @foreach ($question->answers as $response)
                                            <div class="flex items-center mb-2">
                                                <input type="text" name="designation[]" value="{{ $response->designation }}"
                                                    class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-200 space-x-2">
                                        <a href="{{ route('editQuestion', $question->id) }}"
                                            class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition duration-200">
                                            <span>Modifier</span>
                                        </a>
                                        <form action="{{ route('questions.delete', $question->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition duration-200">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>