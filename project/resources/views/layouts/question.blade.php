@include('layouts.sidbar')

<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une question</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 h-full flex flex-col">
    <div class="container mx-auto py-2 px-4 flex-grow flex items-center justify-center">
        <div class="w-full max-w-3xl bg-white rounded-lg shadow-md md:p-4">
            <div class="border-b border-gray-200 pb-6 mb-4">
                <h2 class="text-2xl font-bold text-center text-gray-800">Créer une nouvelle question</h2>
                <p class="text-center text-gray-500 mt-2">Entrez votre question et définissez les réponses possibles.</p>
            </div>

            <form action="{{ route('storeQuastion') }}" method="POST" id="questionForm">
                @csrf
                <div class="mb-4">
                    <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Question</label>
                    <textarea
                        class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="question" name="designation" rows="2" placeholder="Entrez votre question ici..."
                        required></textarea>
                </div>

                <div class="mb-4 bg-gray-50 p-4 rounded-lg">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Réponses</label>
                            <p class="text-xs text-gray-500 mt-1">Sélectionnez le type de question.</p>
                        </div>
                        <div class="flex items-center space-x-6">
                            <div class="flex items-center">
                                <input type="radio" id="multipleChoice" name="type" value="choices" 
                                       class="w-4 h-4 cursor-pointer" checked onchange="toggleQuestionType()">
                                <label for="multipleChoice" class="ml-2 text-gray-700 font-medium">4 Choix</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="trueFalse" name="type" value="bool" 
                                       class="w-4 h-4 cursor-pointer" onchange="toggleQuestionType()">
                                <label for="trueFalse" class="ml-2 text-gray-700 font-medium">Vrai/Faux</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Multiple choice options (4 choices) -->
                <div id="multipleChoiceOptions" class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="bg-gray-50 p-3 rounded-lg hover:bg-gray-100 transition duration-150 response-container"
                                onclick="selectResponse({{ $i - 1 }})">
                                <div class="flex items-center">
                                    <input type="radio" id="correct{{ $i }}" name="is_correct" value="{{ $i - 1 }}"
                                        class="w-5 h-5 cursor-pointer" required>
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 ml-2 bg-gray-600 text-white rounded-full text-xs">{{ $i }}</span>
                                    <label for="response{{ $i }}" class="ml-2 text-gray-700 font-medium">Réponse {{ $i }}</label>
                                </div>
                                <div class="mt-2">
                                    <input type="text"
                                        class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        id="response{{ $i }}" name="designation[]" placeholder="Entrez la réponse {{ $i }}" required>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- True/False options -->
                <div id="trueFalseOptions" class="space-y-3 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="bg-gray-50 p-3 rounded-lg hover:bg-gray-100 transition duration-150 response-container-tf"
                            onclick="selectTrueFalse(true)">
                            <div class="flex items-center">
                                <input type="radio" id="responseTrue" name="designation" value="true"
                                    class="w-5 h-5 cursor-pointer" required>
                                <span
                                    class="inline-flex items-center justify-center w-6 h-6 ml-2 bg-green-600 text-white rounded-full text-xs">V</span>
                                <label for="responseTrue" class="ml-2 text-gray-700 font-medium">Vrai</label>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-3 rounded-lg hover:bg-gray-100 transition duration-150 response-container-tf"
                            onclick="selectTrueFalse(false)">
                            <div class="flex items-center">
                                <input type="radio" id="responseFalse" name="designation" value="false"
                                    class="w-5 h-5 cursor-pointer" required>
                                <span
                                    class="inline-flex items-center justify-center w-6 h-6 ml-2 bg-red-600 text-white rounded-full text-xs">F</span>
                                <label for="responseFalse" class="ml-2 text-gray-700 font-medium">Faux</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8">
                    <button type="button"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400"
                        onclick="resetForm()">Réinitialiser</button>
                    <button type="submit"
                        class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium">Enregistrer
                        la question</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle between question types
        function toggleQuestionType() {
            const multipleChoice = document.getElementById('multipleChoice').checked;
            const multipleChoiceOptions = document.getElementById('multipleChoiceOptions');
            const trueFalseOptions = document.getElementById('trueFalseOptions');
            
            if (multipleChoice) {
                multipleChoiceOptions.classList.remove('hidden');
                trueFalseOptions.classList.add('hidden');
                
                // Enable multiple choice inputs and disable true/false
                enableMultipleChoiceInputs(true);
                enableTrueFalseInputs(false);
            } else {
                multipleChoiceOptions.classList.add('hidden');
                trueFalseOptions.classList.remove('hidden');
                
                // Disable multiple choice inputs and enable true/false
                enableMultipleChoiceInputs(false);
                enableTrueFalseInputs(true);
            }
        }
        
        // Enable/disable inputs based on question type
        function enableMultipleChoiceInputs(enabled) {
            const inputs = document.querySelectorAll('#multipleChoiceOptions input');
            inputs.forEach(input => {
                input.disabled = !enabled;
                input.required = enabled;
            });
        }
        
        function enableTrueFalseInputs(enabled) {
            const inputs = document.querySelectorAll('#trueFalseOptions input');
            inputs.forEach(input => {
                input.disabled = !enabled;
                input.required = enabled;
            });
        }
        
        // Select response for multiple choice
        function selectResponse(index) {
            document.getElementById('correct' + (index + 1)).checked = true;
            
            // Highlight selected response
            const containers = document.querySelectorAll('.response-container');
            containers.forEach((container, i) => {
                if (i === index) {
                    container.classList.remove('bg-gray-50', 'hover:bg-gray-100');
                    container.classList.add('bg-green-50', 'border', 'border-green-200');
                } else {
                    container.classList.remove('bg-green-50', 'border', 'border-green-200');
                    container.classList.add('bg-gray-50', 'hover:bg-gray-100');
                }
            });
        }
        
        // Select response for true/false
        function selectTrueFalse(isTrue) {
            if (isTrue) {
                document.getElementById('responseTrue').checked = true;
            } else {
                document.getElementById('responseFalse').checked = true;
            }
            
            // Highlight selected response
            const containers = document.querySelectorAll('.response-container-tf');
            containers.forEach((container, i) => {
                if ((i === 0 && isTrue) || (i === 1 && !isTrue)) {
                    container.classList.remove('bg-gray-50', 'hover:bg-gray-100');
                    container.classList.add('bg-green-50', 'border', 'border-green-200');
                } else {
                    container.classList.remove('bg-green-50', 'border', 'border-green-200');
                    container.classList.add('bg-gray-50', 'hover:bg-gray-100');
                }
            });
        }
        
        // Reset form
        function resetForm() {
            document.getElementById('questionForm').reset();
            
            // Reset multiple choice containers
            document.querySelectorAll('.response-container').forEach(container => {
                container.classList.remove('bg-green-50', 'border', 'border-green-200');
                container.classList.add('bg-gray-50', 'hover:bg-gray-100');
            });
            
            // Reset true/false containers
            document.querySelectorAll('.response-container-tf').forEach(container => {
                container.classList.remove('bg-green-50', 'border', 'border-green-200');
                container.classList.add('bg-gray-50', 'hover:bg-gray-100');
            });
            
            // Default to multiple choice
            document.getElementById('multipleChoice').checked = true;
            toggleQuestionType();
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            toggleQuestionType();
        });
    </script>
</body>
</html>