
<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une question</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-full font-sans">
    <div class="flex flex-col h-screen">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg p-6">
            <div class="max-w-4xl mx-auto flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-edit mr-3"></i>Modifier la question
                </h2>
                <a href="" class="text-white hover:text-blue-200 transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                </a>
            </div>
        </div>
        
        <!-- Main content with shadow -->
        <div class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-xl p-8 mb-6 border border-gray-200">
                    <form action="{{ route('questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Question input with styling -->
                        <div class="mb-6">
                            <label for="designation" class="block text-sm font-medium text-gray-700 mb-2">Question</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-question-circle text-gray-400"></i>
                                </div>
                                <input type="text" name="questionDesignation" value="{{ $question->designation }}" 
                                    class="pl-10 w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block transition duration-200">
                            </div>
                        </div>
                        
                        <!-- Answers section with card styling -->
                        <div class="mb-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <div class="flex justify-between items-center mb-4">
                                <label class="block text-lg font-semibold text-gray-700">Réponses</label>
                                <button type="button" class="text-blue-500 hover:text-blue-700 font-medium flex items-center">
                                    <i class="fas fa-plus-circle mr-1"></i> Ajouter une réponse
                                </button>
                            </div>
                            
                            <!-- Answer list with improved styling -->
                            <div class="space-y-3">
                                @foreach ($question->answers as $index => $response)
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1 relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 font-medium">{{ $index + 1 }}</span>
                                            </div>
                                            <input type="text" name="response[]" value="{{ $response->designation }}" 
                                                class="pl-10 w-full px-4 py-3 bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block transition duration-200" />
                                        </div>
                                        <button type="button" class="p-2 text-red-500 hover:text-red-700 transition duration-200">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Action buttons with better styling -->
                        <div class="flex justify-between pt-4 border-t border-gray-200">
                            <a href="" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200 flex items-center">
                                <i class="fas fa-times mr-2"></i>Annuler
                            </a>
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center shadow-md">
                                <i class="fas fa-save mr-2"></i>Sauvegarder les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Footer with subtle styling -->
        <div class="bg-white border-t border-gray-200 py-4 px-6 text-center text-gray-600 text-sm">
            <p>&copy; 2025 Système de gestion des questions</p>
        </div>
    </div>
</body>
</html>