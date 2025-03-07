<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Quiz</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .question-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .question-card:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .answers-container {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            opacity: 0;
        }
        .question-card:hover .answers-container {
            max-height: 500px;
            opacity: 1;
        }
        .correct-answer-icon {
            transition: transform 0.3s ease, color 0.3s ease;
        }
        .correct-answer-icon:hover {
            transform: scale(1.2);
            color: green;
        }
        .question-type-badge {
            transition: all 0.3s ease;
        }
        .question-type-badge:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="bg-gray-100 h-full font-sans">
    <div class="flex flex-col h-screen">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg p-6">
            <div class="max-w-6xl mx-auto flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-clipboard-list mr-3"></i>Détails du Quiz
                </h2>
                <div class="flex space-x-2">
                    <a href="{{ route('quizzes.edit', $quiz->id) }}"
                        class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition duration-200 flex items-center">
                        <i class="fas fa-edit mr-2"></i>Modifier
                    </a>
                    <a href=""
                        class="bg-white text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                    </a>
                </div>
            </div>
        </div>

        <!-- Main content with shadow -->
        <div class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-xl p-8 mb-6 border border-gray-200">
                    <!-- Quiz Details Section -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Quiz Information -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4 border-b pb-2">Informations du Quiz</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-600">Titre:</span>
                                    <p class="text-lg">{{ $quiz->title }}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Description:</span>
                                    <p class="text-md text-gray-700">{{ $quiz->description ?? 'Aucune description' }}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Date de Création:</span>
                                    <p>{{ $quiz->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Nombre de Questions:</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        {{ $quiz->quastions->count() }} / 10
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Questions List -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4 border-b pb-2">Questions</h3>
                            @if($quiz->quastions->isEmpty())
                                <div class="text-center py-6 text-gray-500">
                                    <i class="fas fa-question-circle text-4xl mb-3 text-gray-300"></i>
                                    <p>Aucune question n'a été ajoutée à ce quiz</p>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach($quiz->quastions as $index => $question)
                                        <div class="question-card bg-gray-50 p-4 rounded-lg relative">
                                            <div class="flex justify-between items-center mb-2">
                                                <div class="flex items-center space-x-2">
                                                    <h4 class="font-medium text-gray-700">Question {{ $index + 1 }}</h4>
                                                    
                                                    @if($question->type)
                                                        <span class="question-type-badge bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">
                                                            {{ $question->type }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('editQuestion', $question->id) }}"
                                                        class="text-blue-500 hover:text-blue-700">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('questions.delete', $question->id) }}" method="POST"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <p class="text-gray-600 mb-2">{{ $question->designation }}</p>
                                            
                                            <div class="answers-container space-y-2">
                                                @foreach($question->answers as $option)
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center">
                                                            <span class="mr-2 {{ $option->is_correct ? 'text-green-500' : 'text-gray-500' }}">
                                                                <i class="fas {{ $option->is_correct ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                                            </span>
                                                            <span>{{ $option->designation }}</span>
                                                        </div>
                                                        @if($option->is_correct)
                                                            <div class="correct-answer-icon cursor-pointer flex items-center space-x-2" 
                                                                 title="Réponse correcte" 
                                                                 data-tooltip="Ceci est la bonne réponse">
                                                                <i class="fas fa-trophy text-yellow-500"></i>
                                                                <span class="text-xs text-gray-600">{{ $option->text }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                            <div class="absolute top-2 right-2 text-gray-400 text-xs">
                                                <i class="fas fa-eye"></i> Survolez pour voir les réponses
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
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