<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Nouveau Quiz</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-full font-sans">
    <div class="flex flex-col h-screen">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg p-6">
            <div class="max-w-6xl mx-auto flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-plus-circle mr-3"></i>Créer un Nouveau Quiz
                </h2>
                <a href="" class="text-white hover:text-blue-200 transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <!-- Main content with shadow -->
        <div class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-6xl mx-auto">
                <form action="{{ route('quizzes.store') }}" method="POST" id="quizForm">
                    @csrf
                    <div class="bg-white rounded-xl shadow-xl p-8 mb-6 border border-gray-200">
                        <!-- Quiz Details Section -->
                        <div class="mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Quiz Title Input -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Titre du Quiz
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-heading text-gray-400"></i>
                                        </div>
                                        <input type="text" name="title" id="title" required
                                            class="pl-10 w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block transition duration-200"
                                            placeholder="Entrez le titre du quiz">
                                    </div>
                                </div>

                                <!-- Quiz Type Selection -->
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                        Type de Quiz
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-tags text-gray-400"></i>
                                        </div>
                                        <select name="type" id="type" required
                                            class="pl-10 w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block transition duration-200">
                                            <option value="">Sélectionnez un type</option>
                                            <option value="logique">Logique</option>
                                            <option value="technique">Technique</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Questions Selection Section -->
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-700">
                                    Sélection des Questions
                                </h3>
                                <div class="text-sm text-gray-600">
                                    Questions sélectionnées :
                                    <span id="selectedQuestionsCount">0</span> / 5
                                </div>
                            </div>

                            <!-- Questions Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 w-10">
                                                <input type="checkbox" id="selectAllQuestions" class="form-checkbox">
                                            </th>
                                            <th scope="col" class="px-6 py-3">Question</th>
                                            <th scope="col" class="px-6 py-3">Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($questions as $question)
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="px-6 py-4">
                                                    <input type="checkbox" name="selected_questions[]"
                                                        value="{{ $question->id }}" class="question-checkbox form-checkbox"
                                                        data-type="{{ $question->type }}">
                                                </td>
                                                <td class="px-6 py-4">{{ $question->designation }}</td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="px-2 py-1 rounded-full text-xs 
                                                            {{ $question->type == 'bool' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                        {{ $question->type }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex justify-between">
                            <a href=""
                                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200">
                                Annuler
                            </a>
                            <button type="submit" id="createQuizBtn"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                Créer le Quiz
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('selectAllQuestions');
            const questionCheckboxes = document.querySelectorAll('.question-checkbox');
            const selectedQuestionsCount = document.getElementById('selectedQuestionsCount');
            const createQuizBtn = document.getElementById('createQuizBtn');
            const quizTypeSelect = document.getElementById('type');

            selectAllCheckbox.addEventListener('change', function () {
                let selectedCount = 0;
                questionCheckboxes.forEach(checkbox => {
                    if (!checkbox.disabled) {
                        checkbox.checked = this.checked;
                    }
                });
                updateSelectedCount();
            });

            questionCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    updateSelectedCount();
                });
            })
            function updateSelectedCount() {
                const selectedQuestions = document.querySelectorAll('.question-checkbox:checked');
                let selectedCount = selectedQuestions.length;

                if (selectedCount > 5) {
                    this.checked = false;
                    const lastCheckedCheckbox = selectedQuestions[selectedQuestions.length - 1];
                    lastCheckedCheckbox.checked = false;
                    alert('Vous ne pouvez pas sélectionner plus de 5 questions');
                    updateSelectedCount();
                    return;
                }

                selectedQuestionsCount.textContent = selectedCount;
                createQuizBtn.disabled = selectedCount === 0;
                createQuizBtn.classList.toggle('opacity-50', selectedCount === 0);
            }

            // quizTypeSelect.addEventListener('change', function () {
            //     const selectedType = this.value;

            //     questionCheckboxes.forEach(checkbox => {
            //         const questionType = checkbox.getAttribute('data-type');

            //         if (selectedType && questionType !== selectedType) {
            //             checkbox.disabled = true;
            //             checkbox.parentElement.parentElement.classList.add('opacity-50');
            //             checkbox.checked = false;
            //         } else {
            //             checkbox.disabled = false;
            //             checkbox.parentElement.parentElement.classList.remove('opacity-50');
            //         }
            //     });

            //     updateSelectedCount();
            // });

            updateSelectedCount();
        });
    </script>
</body>

</html>