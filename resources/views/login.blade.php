<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkTracker - Login UI & Blade Template</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full text-slate-800 antialiased flex flex-col min-h-screen justify-between">

    <!-- Top Developer Toolbar -->
    <header class="bg-slate-800 border-b border-slate-700/80 text-white px-4 py-3 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center space-x-3">
                <!-- <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-brand-500/20 text-brand-400 border border-brand-500/30">
                    <i class="fa-solid fa-code-branch mr-1.5">resources/views/auth/login.blade.php</i>
                </span>
                <span class="text-sm font-medium text-slate-300 hidden sm:inline">Co-Senior Dev UI Prototype</span> -->
            </div>
            
            <div class="flex items-center space-x-3">
                <!-- Toggle Error State Simulation Button -->
                <button id="toggleErrorBtn" onclick="toggleErrorState()" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-amber-500/10 text-amber-400 border border-amber-500/30 hover:bg-amber-500/20 transition-colors">
                    <i class="fa-solid fa-bug mr-1.5"></i>
                    <span>Toggle Error State</span>
                </button>

                <!-- Blade Snippet Modal Trigger -->
                <!-- <button onclick="toggleBladeModal()" class="inline-flex items-center px-3.5 py-1.5 text-xs font-semibold rounded-lg bg-brand-600 text-white hover:bg-brand-500 shadow-sm transition-all focus:ring-2 focus:ring-brand-400 focus:outline-none">
                    <i class="fa-solid fa-file-code mr-1.5"></i>
                    <span>Get Blade Code</span>
                </button> -->
            </div>
        </div>
    </header>

    <!-- Main Content Grid / Split-Screen View -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-5xl bg-slate-800/90 rounded-2xl shadow-2xl border border-slate-700/60 overflow-hidden grid grid-cols-1 lg:grid-cols-12">
            
            <!-- Left Side: Branding & Features Pitch (Hidden on small screens) -->
            <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 via-brand-900/60 to-slate-900 p-8 lg:p-12 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-slate-700/50 relative overflow-hidden">
                <!-- Ambient Background Glow -->
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div>
                    <!-- Brand Logo -->
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="h-11 w-11 rounded-xl bg-gradient-to-tr from-brand-600 to-blue-400 flex items-center justify-center shadow-lg shadow-brand-500/30">
                            <i class="fa-solid fa-clock-rotate-left text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-white">Work<span class="text-brand-400">Tracker</span></span>
                    </div>

                    <h1 class="text-2xl lg:text-3xl font-bold text-white leading-tight mb-4">
                        Streamlined Work Log & Reporting Platform
                    </h1>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Seamlessly record session logs, automatically calculate net working hours, and export audit-ready Excel reports for your team.
                    </p>

                    <!-- Feature List -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-start space-x-3 text-slate-300 text-xs sm:text-sm">
                            <i class="fa-solid fa-circle-check text-brand-400 mt-1"></i>
                            <span>Automated login/logout timestamp pairing</span>
                        </div>
                        <div class="flex items-start space-x-3 text-slate-300 text-xs sm:text-sm">
                            <i class="fa-solid fa-circle-check text-brand-400 mt-1"></i>
                            <span>Real-time daily & weekly work hours totalizer</span>
                        </div>
                        <div class="flex items-start space-x-3 text-slate-300 text-xs sm:text-sm">
                            <i class="fa-solid fa-circle-check text-brand-400 mt-1"></i>
                            <span>One-click custom Excel (.xlsx) report export</span>
                        </div>
                    </div>
                </div>

                <!-- Footer note in sidebar -->
                <div class="mt-8 pt-6 border-t border-slate-800 text-xs text-slate-500 flex items-center justify-between">
                    <!-- <span>Laravel v11.x Ready</span>
                    <span>Maatwebsite Excel</span> -->
                </div>
            </div>

            <!-- Right Side: Interactive Login Form -->
            <div class="lg:col-span-7 bg-slate-900/60 p-6 sm:p-10 lg:p-12 flex flex-col justify-center">
                <div class="max-w-md mx-auto w-full">
                    
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-white tracking-tight">Welcome Back</h2>
                        <p class="text-slate-400 text-sm mt-1">Enter your credentials to access your timesheet dashboard</p>
                    </div>

                    <!-- Laravel Session / Error Alert Banner (Toggleable State) -->
                    <div id="errorAlert" class="hidden mb-6 rounded-xl bg-red-500/10 border border-red-500/30 p-4 text-sm text-red-400 space-y-1 animate-fade-in">
                        <div class="flex items-center space-x-2 font-semibold">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>Whoops! Something went wrong.</span>
                        </div>
                        <ul class="list-disc list-inside text-xs text-red-300 pl-1 space-y-1 mt-1">
                            <li>These credentials do not match our records.</li>
                        </ul>
                    </div>

                    <div id="successAlert" class="hidden mb-6 rounded-xl bg-emerald-500/10 border border-emerald-500/30 p-4 text-sm text-emerald-400 flex items-center space-x-2 animate-fade-in">
                        <i class="fa-solid fa-circle-check text-base"></i>
                        <span>Authenticated successfully! Redirecting to dashboard...</span>
                    </div>

                    <form id="loginForm" onsubmit="handleLoginSubmit(event)" class="space-y-5" novalidate>
                        <!-- Email Input Field -->
                        <div>
                            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                Email Address
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="developer@worktracker.com"
                                    required
                                    placeholder="name@company.com"
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-800/80 border border-slate-700 text-white placeholder-slate-500 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all"
                                >
                            </div>
                            <p id="emailError" class="hidden mt-1.5 text-xs text-red-400 flex items-center space-x-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span>Please enter a valid email address.</span>
                            </p>
                        </div>

                        <!-- Password Input Field -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                                    Password
                                </label>
                                <a href="#" class="text-xs font-medium text-brand-400 hover:text-brand-300 transition-colors hover:underline">
                                    Forgot password?
                                </a>
                            </div>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                    <i class="fa-solid fa-lock text-xs"></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    value="password123"
                                    required
                                    placeholder="••••••••"
                                    class="block w-full pl-10 pr-11 py-3 bg-slate-800/80 border border-slate-700 text-white placeholder-slate-500 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all"
                                >
                                <!-- Toggle Password Visibility -->
                                <button 
                                    type="button" 
                                    onclick="togglePasswordVisibility()" 
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-white transition-colors focus:outline-none"
                                >
                                    <i id="passwordToggleIcon" class="fa-regular fa-eye text-sm"></i>
                                </button>
                            </div>
                            <p id="passwordError" class="hidden mt-1.5 text-xs text-red-400 flex items-center space-x-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span>Password is required.</span>
                            </p>
                        </div>

                        <!-- Remember Me & Extras -->
                        <div class="flex items-center justify-between py-1">
                            <label class="flex items-center space-x-2.5 cursor-pointer select-none">
                                <input 
                                    type="checkbox" 
                                    id="remember" 
                                    name="remember"
                                    class="h-4 w-4 rounded border-slate-700 bg-slate-800 text-brand-600 focus:ring-brand-500 focus:ring-offset-slate-900 transition-colors"
                                >
                                <span class="text-xs font-medium text-slate-300">Remember this device</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="w-full py-3.5 px-4 rounded-xl font-semibold text-sm text-white bg-gradient-to-r from-brand-600 to-blue-600 hover:from-brand-500 hover:to-blue-500 active:scale-[0.99] transition-all shadow-lg shadow-brand-600/30 flex items-center justify-center space-x-2"
                        >
                            <span id="btnText">Sign In to Dashboard</span>
                            <i id="btnIcon" class="fa-solid fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                            <div id="btnSpinner" class="hidden border-2 border-white/30 border-t-white rounded-full w-4 h-4 animate-spin"></div>
                        </button>
                    </form>

                    <!-- Mock Footer Links -->
                    <div class="mt-8 text-center text-xs text-slate-500">
                        Don't have an account? 
                        <a href="#" class="text-brand-400 hover:text-brand-300 font-medium hover:underline">Contact System Administrator</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 text-center text-xs text-slate-500 border-t border-slate-800/80">
        WorkTracker Application &bull; Built with Laravel & Tailwind CSS
    </footer>

    <!-- Laravel Blade Code Reference Drawer / Modal -->
    

    <!-- JavaScript Interactions -->
    <script>
        let isErrorState = false;

        // Toggle Password Visibility
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('passwordToggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Toggle Error State Simulation
        function toggleErrorState() {
            isErrorState = !isErrorState;
            const errorAlert = document.getElementById('errorAlert');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const toggleBtn = document.getElementById('toggleErrorBtn');

            if (isErrorState) {
                errorAlert.classList.remove('hidden');
                emailError.classList.remove('hidden');
                passwordError.classList.remove('hidden');
                
                emailInput.classList.add('border-red-500', 'bg-red-500/5');
                emailInput.classList.remove('border-slate-700');

                passwordInput.classList.add('border-red-500', 'bg-red-500/5');
                passwordInput.classList.remove('border-slate-700');

                toggleBtn.classList.replace('bg-amber-500/10', 'bg-amber-500/30');
            } else {
                errorAlert.classList.add('hidden');
                emailError.classList.add('hidden');
                passwordError.classList.add('hidden');

                emailInput.classList.remove('border-red-500', 'bg-red-500/5');
                emailInput.classList.add('border-slate-700');

                passwordInput.classList.remove('border-red-500', 'bg-red-500/5');
                passwordInput.classList.add('border-slate-700');

                toggleBtn.classList.replace('bg-amber-500/30', 'bg-amber-500/10');
            }
        }

        // Handle Form Submit Animation Simulation
        function handleLoginSubmit(event) {
            event.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');
            const btnSpinner = document.getElementById('btnSpinner');
            const successAlert = document.getElementById('successAlert');

            // Show Loading
            btnText.innerText = 'Authenticating...';
            btnIcon.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            submitBtn.disabled = true;

            setTimeout(() => {
                btnSpinner.classList.add('hidden');
                btnIcon.classList.remove('hidden');
                btnIcon.className = 'fa-solid fa-check text-xs';
                btnText.innerText = 'Success!';
                submitBtn.classList.replace('from-brand-600', 'from-emerald-600');
                submitBtn.classList.replace('to-blue-600', 'to-emerald-500');

                successAlert.classList.remove('hidden');
            }, 1200);
        }

        // Toggle Blade Modal Drawer
        function toggleBladeModal() {
            const modal = document.getElementById('bladeModal');
            if (modal.classList.contains('opacity-0')) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                modal.classList.add('opacity-0', 'pointer-events-none');
            }
        }

        // Copy Blade Code Snippet
        function copyBladeCode() {
            const codeText = document.getElementById('bladeCodeText').innerText;
            
            // Execute Copy
            const tempTextArea = document.createElement('textarea');
            tempTextArea.value = codeText;
            document.body.appendChild(tempTextArea);
            tempTextArea.select();
            document.execCommand('copy');
            document.body.removeChild(tempTextArea);

            const copyBtnText = document.getElementById('copyBtnText');
            copyBtnText.innerText = 'Copied!';
            setTimeout(() => {
                copyBtnText.innerText = 'Copy Code';
            }, 2000);
        }
    </script>
</body>
</html>