<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkTracker - Create New User</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            900: '#312e81',
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
<body class="h-full bg-slate-950 text-slate-200 antialiased flex flex-col min-h-screen">

    <!-- Navigation Bar -->
    <nav class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800 sticky z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand logo -->
                <div class="flex items-center space-x-3">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-brand-600 to-indigo-400 flex items-center justify-center shadow-lg shadow-brand-500/20">
                        <i class="fa-solid fa-clock-rotate-left text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">Work<span class="text-brand-400">Tracker</span> <span class="text-xs font-medium px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-widest ml-1">Admin</span></span>
                </div>

                <!-- Admin Profile Area & Nav Links -->
                <div class="flex items-center space-x-6">
                    <div class="hidden sm:flex items-center space-x-4 text-xs font-medium">
                        <a href="#" class="text-brand-400 border-b-2 pb-1">Users</a>
                        <a href="#" class="text-brand-400 border-b-2 border-brand-500 pb-1">Reports & Analytics</a>
                    </div>

                    <div class="flex items-center space-x-3 border-l border-slate-800 pl-4">
                        <div class="h-9 w-9 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-600 border border-slate-700 flex items-center justify-center text-sm font-semibold text-white shadow-md">
                            SA
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-xs font-semibold text-white leading-none">Sarah Admin</p>
                            <p class="text-[11px] text-slate-400 leading-none mt-1">HR & Operations Lead</p>
                        </div>
                        <a href="#" class="text-slate-400 hover:text-rose-400 text-sm ml-2 transition-colors" title="Logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <!-- Main Content Body -->
    <main class="flex-1 max-w-4xl w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- Top Header & Back Button -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center gap-2.5">
                    <i class="fa-solid fa-user-plus text-brand-400"></i>
                    Create New User Account
                </h1>
                <p class="text-xs text-slate-400 mt-1">Add a new team member or manager to WorkTracker with custom access roles.</p>
            </div>
            
            <a href=" route('users.index') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 font-medium text-xs rounded-xl transition-all flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Users List</span>
            </a>
        </div>

        <!-- Validation Summary Alert -->
        @if ($errors->any())
            <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs flex items-start gap-3 shadow-lg">
                <i class="fa-solid fa-triangle-exclamation text-base text-rose-400 mt-0.5"></i>
                <div>
                    <p class="font-bold">Please correct the following errors:</p>
                    <ul class="list-disc list-inside mt-1 space-y-0.5 text-rose-300/90">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Form Card Container -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-2xl relative overflow-hidden">
            <div class="absolute -top-16 -right-16 w-60 h-60 bg-brand-600/10 rounded-full blur-3xl pointer-events-none"></div>

            <form action=" route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Section 1: Basic Profile Details -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-brand-400 border-b border-slate-800 pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-id-card"></i> Profile Details
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Full Name <span class="text-rose-400">*</span>
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name') }}" 
                                    placeholder="e.g. Alex Rivera" 
                                    class="w-full pl-9 pr-3.5 py-2.5 bg-slate-950 border @error('name') border-rose-500 focus:ring-rose-500 @else border-slate-800 focus:ring-brand-500 @enderror rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-2"
                                    required
                                >
                            </div>
                            @error('name')
                                <p class="text-[11px] text-rose-400 mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Corporate Email <span class="text-rose-400">*</span>
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    value="{{ old('email') }}" 
                                    placeholder="e.g. alex.rivera@worktracker.io" 
                                    class="w-full pl-9 pr-3.5 py-2.5 bg-slate-950 border @error('email') border-rose-500 focus:ring-rose-500 @else border-slate-800 focus:ring-brand-500 @enderror rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-2"
                                    required
                                >
                            </div>
                            @error('email')
                                <p class="text-[11px] text-rose-400 mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Role & Department -->
                <div class="space-y-4 pt-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-brand-400 border-b border-slate-800 pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-user-shield"></i> Access Role & Job Title
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Role Selection -->
                        <div>
                            <label for="role" class="block text-xs font-semibold text-slate-300 mb-1.5">
                                System Role <span class="text-rose-400">*</span>
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-user-tag absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                                <select 
                                    name="role" 
                                    id="role" 
                                    class="w-full pl-9 pr-8 py-2.5 bg-slate-950 border @error('role') border-rose-500 focus:ring-rose-500 @else border-slate-800 focus:ring-brand-500 @enderror rounded-xl text-xs text-white focus:outline-none focus:ring-2 appearance-none"
                                    required
                                >
                                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select assigned role...</option>
                                    <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>Employee / User (Timeclock Access)</option>
                                    <option value="manager" {{ old('role') === 'manager' ? 'selected' : '' }}>Team Lead / Manager</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>System Administrator</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs pointer-events-none"></i>
                            </div>
                            @error('role')
                                <p class="text-[11px] text-rose-400 mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Job Title -->
                        <div>
                            <label for="job_title" class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Job Title
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-briefcase absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                                <input 
                                    type="text" 
                                    name="job_title" 
                                    id="job_title" 
                                    value="{{ old('job_title') }}" 
                                    placeholder="e.g. Senior Frontend Developer" 
                                    class="w-full pl-9 pr-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-brand-500"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Credentials -->
                <div class="space-y-4 pt-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-brand-400 border-b border-slate-800 pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-lock"></i> Security Credentials
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Password <span class="text-rose-400">*</span>
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-key absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    placeholder="••••••••" 
                                    class="w-full pl-9 pr-10 py-2.5 bg-slate-950 border @error('password') border-rose-500 focus:ring-rose-500 @else border-slate-800 focus:ring-brand-500 @enderror rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-2"
                                    required
                                >
                                <button type="button" onclick="togglePasswordVisibility('password', 'pwdIcon')" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white">
                                    <i id="pwdIcon" class="fa-solid fa-eye text-xs"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-[11px] text-rose-400 mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold text-slate-300 mb-1.5">
                                Confirm Password <span class="text-rose-400">*</span>
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-shield-check absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="password_confirmation" 
                                    placeholder="••••••••" 
                                    class="w-full pl-9 pr-10 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-brand-500"
                                    required
                                >
                                <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'pwdConfirmIcon')" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white">
                                    <i id="pwdConfirmIcon" class="fa-solid fa-eye text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Action Buttons -->
                <div class="pt-4 border-t border-slate-800 flex items-center justify-end space-x-3">
                    <a href=" route('users.index') }}" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-xs rounded-xl transition-all">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-500 text-white font-semibold text-xs rounded-xl shadow-lg shadow-brand-600/30 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-user-check"></i>
                        <span>Create User Account</span>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Password Visibility Toggle Script -->
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>

