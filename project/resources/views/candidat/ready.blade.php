<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructions du Test</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-auto p-6">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-3">
                <h2 class="text-2xl font-bold text-white">Êtes-vous prêt?</h2>
            </div>
            <div class="p-6">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                Informations importantes sur le test
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Countdown Timer -->
                <div class="flex justify-center mb-4">
                    <div class="bg-gray-800 text-white rounded-full w-16 h-16 flex items-center justify-center">
                        <span id="countdown" class="text-2xl font-bold">10</span>
                    </div>
                </div>
                <p class="text-center text-gray-600 mb-6">Le test commencera automatiquement dans <span id="countdown-text">10</span> secondes</p>

                <h3 class="text-lg font-semibold text-gray-800 mb-4">Détails du test :</h3>
                <ul class="space-y-3 text-gray-600 mb-6">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Le test contient <strong>5 questions</strong></span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Vous disposez de <strong>2 minutes</strong> pour compléter le test</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Le chronomètre démarrera dès que vous cliquerez sur "Commencer"</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Répondez à toutes les questions avant la fin du temps imparti</span>
                    </li>
                </ul>

                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-5">
                    <a href="{{ route('home') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition duration-300 text-center">
                        Retour
                    </a>
                    <a id="start-test-btn" href="{{ route('test') }}" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-300 text-center flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Commencer le test
                    </a>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-sm text-gray-500 text-center">
                Bonne chance!
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = 10;
            const countdownElement = document.getElementById('countdown');
            const countdownTextElement = document.getElementById('countdown-text');
            const startTestBtn = document.getElementById('start-test-btn');
            
            // Update countdown every second
            const countdownInterval = setInterval(function() {
                timeLeft--;
                
                // Update the countdown display
                countdownElement.textContent = timeLeft;
                countdownTextElement.textContent = timeLeft;
                
                // Apply visual effects as time decreases
                if (timeLeft <= 3) {
                    countdownElement.classList.add('text-red-500');
                    countdownElement.classList.add('animate-pulse');
                }
                
                // When countdown reaches zero
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    
                    // Simulate click on the start test button
                    startTestBtn.classList.add('animate-pulse');
                    
                    // Add a small delay before redirecting
                    setTimeout(function() {
                        window.location.href = startTestBtn.getAttribute('href');
                    }, 500);
                }
            }, 1000);
            
            // Allow user to click the button manually before countdown ends
            startTestBtn.addEventListener('click', function() {
                clearInterval(countdownInterval);
            });
        });
    </script>
</body>

</html>