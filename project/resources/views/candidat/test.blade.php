<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test en ligne</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Timer Bar -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <div class="text-gray-700">
                        <span class="font-bold">Temps restant:</span>
                        <span id="timer" class="ml-2 font-mono">2:00</span>
                    </div>
                    <div class="text-gray-700">
                        Question <span id="current-question">1</span>/5
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div id="timer-bar" class="bg-blue-600 h-2.5 rounded-full transition-all duration-1000"
                        style="width: 100%"></div>
                </div>
            </div>

            <!-- Quiz Form -->
            <form id="quiz-form" method="POST" action="{{ route('submit_quiz') }}">
                @csrf
                <input type="hidden" id="time_spent" name="time_spent" value="0">
                <input type="hidden" id="current_question_id" name="current_question_id" value="1">

                <!-- Questions Container -->
                <div id="questions-container">
                    <!-- Question will be loaded here dynamically -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <div id="loading" class="flex flex-col items-center justify-center py-12">
                                <svg class="animate-spin h-8 w-8 text-blue-600 mb-4" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <p class="text-gray-600">Chargement de la question...</p>
                            </div>

                            <div id="question-content" class="hidden">
                                <h3 id="question-text" class="text-lg font-semibold text-gray-800 mb-6"></h3>

                                <div id="answers-container" class="space-y-3">
                                    <!-- Answers will be loaded here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-6 flex justify-between">
                    <div class="flex-grow"></div>
                    <button type="button" id="next-btn"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        Question suivante
                    </button>
                    <button type="submit" id="submit-btn"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg font-medium transition duration-300 hidden">
                        Terminer le test
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Timer variables
            let totalSeconds = 120; // 2 minutes
            const timerElement = document.getElementById('timer');
            const timerBarElement = document.getElementById('timer-bar');

            // Quiz variables
            let currentQuestionId = 1; // Start with no question loaded
            const totalQuestions = 5;
            let userAnswers = {};

            // DOM elements
            const questionsContainer = document.getElementById('questions-container');
            const questionContent = document.getElementById('question-content');
            const loading = document.getElementById('loading');
            const questionText = document.getElementById('question-text');
            const answersContainer = document.getElementById('answers-container');
            const currentQuestionElement = document.getElementById('current-question');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');
            const quizForm = document.getElementById('quiz-form');
            const timeSpentInput = document.getElementById('time_spent');
            const currentQuestionIdInput = document.getElementById('current_question_id');

            // Event listeners
            nextBtn.addEventListener('click', showNextQuestion);
            quizForm.addEventListener('submit', submitQuiz);

            // Fetch question by ID
            async function getQuestion(currentQuestionId) {
                try {
                    const response = await fetch(`/question/${currentQuestionId}`);
                    if (response.ok) {
                        const data = await response.json();
                        return data;
                    } else {
                        const errorData = await response.text();
                        console.error('Error response:', errorData);
                        throw new Error('Failed to fetch question');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            // Load question by ID
            async function loadQuestion(currentQuestionId) {
                // Show loading state
                questionContent.classList.add('hidden');
                loading.classList.remove('hidden');

                const question = await getQuestion(currentQuestionId);
                // Update question text
                questionText.textContent = question.designation;

                // Clear previous answers
                answersContainer.innerHTML = '';

                // Add answers
                question.answers.forEach(answer => {
                    const isChecked = userAnswers[question.id] === answer.id;

                    const answerHTML = `
                <div class="answer-option">
                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors ${isChecked ? 'bg-blue-50 border-blue-300' : ''}">
                        <input type="radio" name="answer" value="${answer.id}" class="h-4 w-4 text-blue-600" ${isChecked ? 'checked' : ''}>
                        <span class="ml-3">${answer.designation}</span>
                    </label>
                </div>
            `;

                    answersContainer.insertAdjacentHTML('beforeend', answerHTML);
                });

                // Add event listeners to answer options
                document.querySelectorAll('input[name="answer"]').forEach(input => {
                    input.addEventListener('change', (e) => {
                        userAnswers[question.id] = parseInt(e.target.value);

                        // Update styling for selected answer
                        document.querySelectorAll('.answer-option label').forEach(label => {
                            label.classList.remove('bg-blue-50', 'border-blue-300');
                        });
                        e.target.closest('label').classList.add('bg-blue-50', 'border-blue-300');

                        // Enable next button
                        nextBtn.disabled = false;
                    });
                });

                // Update navigation buttons
                updateNavigationButtons();

                // Update current question indicator
                currentQuestionElement.textContent = question.id;

                // Update current question id input
                currentQuestionIdInput.value = question.id;

                // Hide loading, show content
                loading.classList.add('hidden');
                questionContent.classList.remove('hidden');
            }

            // Show next question
            async function showNextQuestion() {
                if (currentQuestionId < totalQuestions) {
                    currentQuestionId++;
                    await loadQuestion(currentQuestionId);
                }
            }

            // Update navigation buttons
            function updateNavigationButtons() {
                // Show/hide next and submit buttons
                if (currentQuestionId < totalQuestions) {
                    nextBtn.classList.remove('hidden');
                    submitBtn.classList.add('hidden');

                    // Disable next button if no answer selected
                    nextBtn.disabled = !userAnswers[currentQuestionId];
                } else {
                    nextBtn.classList.add('hidden');
                    submitBtn.classList.remove('hidden');
                }
            }

            // Submit quiz
            function submitQuiz(e) {
                if (e) e.preventDefault();

                // Create answered questions array
                const answeredQuestions = [];
                for (const questionId in userAnswers) {
                    answeredQuestions.push({
                        question_id: parseInt(questionId),
                        answer_id: userAnswers[questionId]

                    });
                }

                // Add answers to form
                const answersInput = document.createElement('input');
                answersInput.type = 'hidden';
                answersInput.name = 'answers';
                answersInput.value = JSON.stringify(answeredQuestions);
                quizForm.appendChild(answersInput);

                // Submit form
                console.log('Submitting quiz with answers:', answeredQuestions);
                console.log('Time spent:', timeSpentInput.value, 'seconds');

                // In a real app, you would uncomment this:
                quizForm.submit();

                // For demo purposes, show completion and redirect
                questionsContainer.innerHTML = `
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-green-100 border-l-4 border-green-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                Test terminé ! Redirection en cours...
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Merci d'avoir complété le test</h3>
                    <p class="text-gray-600 mb-6">Vos réponses ont été enregistrées.</p>
                    <div class="animate-spin mx-auto h-8 w-8 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        `;

                // Hide navigation buttons
                nextBtn.classList.add('hidden');
                submitBtn.classList.add('hidden');

                // Stop timer
                clearInterval(timerInterval);

                // In a real app, redirect after a delay
                setTimeout(() => {
                    // window.location.href = "{{ route('results') }}";
                    alert("Dans une application réelle, l'utilisateur serait redirigé vers la page des résultats.");
                }, 2000);
            }

            // Start the quiz by loading the first question
            loadQuestion(currentQuestionId);

            // Start the timer
            const timerInterval = setInterval(updateTimer, 1000);

            // Timer update function
            function updateTimer() {
                totalSeconds--;

                // Update time display
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;
                timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                // Update progress bar
                const percentLeft = (totalSeconds / 120) * 100;
                timerBarElement.style.width = `${percentLeft}%`;

                // Change color when less than 30 seconds
                if (totalSeconds <= 30) {
                    timerBarElement.classList.remove('bg-blue-600');
                    timerBarElement.classList.add('bg-red-600');
                    timerElement.classList.add('text-red-600');

                    if (totalSeconds <= 10) {
                        timerElement.classList.add('animate-pulse');
                    }
                }

                // Auto submit when time is up
                if (totalSeconds <= 0) {
                    clearInterval(timerInterval);
                    submitQuiz();
                }

                // Update time spent input
                timeSpentInput.value = 120 - totalSeconds;
            }
        });
    </script>
</body>

</html>