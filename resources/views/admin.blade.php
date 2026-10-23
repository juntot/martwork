<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkTracker - Admin Reports & Excel Export</title>
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
        /* Custom scrollbar styling */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body class="h-full bg-slate-950 text-slate-200 antialiased flex flex-col min-h-screen">

   

    <!-- Main Navigation Header -->
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
    <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- Header Title Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center gap-2.5">
                    <i class="fa-solid fa-chart-line text-brand-400"></i>
                    Team Hours & Timesheet Reports
                </h1>
                <p class="text-xs text-slate-400 mt-1">Audit employee total worked hours, overtime, shifts, and generate official Excel reports.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="openExportModal()" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs rounded-xl shadow-lg shadow-emerald-600/20 flex items-center gap-2 transition-all">
                    <i class="fa-solid fa-file-excel text-sm"></i>
                    <span>Export Report to Excel (.xlsx)</span>
                </button>
            </div>
        </div>

        <!-- KPI Top Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- KPI 1 -->
            <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-slate-400 tracking-wider">Total Worked Hours</p>
                        <h3 id="kpiTotalHours" class="text-2xl font-extrabold text-white mt-1">1,248.5 <span class="text-xs font-normal text-slate-400">hrs</span></h3>
                        <p class="text-[11px] text-emerald-400 mt-1 flex items-center gap-1">
                            <i class="fa-solid fa-arrow-trend-up"></i> +12.4% vs last period
                        </p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-brand-500/10 border border-brand-500/20 flex items-center justify-center text-brand-400">
                        <i class="fa-solid fa-clock text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- KPI 2 -->
            <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-slate-400 tracking-wider">Currently Clocked In</p>
                        <h3 id="kpiActiveUsers" class="text-2xl font-extrabold text-emerald-400 mt-1">6 / 8 <span class="text-xs font-normal text-slate-400">users</span></h3>
                        <p class="text-[11px] text-slate-400 mt-1 flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span> Live active team
                        </p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <i class="fa-solid fa-user-clock text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- KPI 3 -->
            <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-slate-400 tracking-wider">Avg Daily Hours / User</p>
                        <h3 id="kpiAvgDaily" class="text-2xl font-extrabold text-white mt-1">7.8 <span class="text-xs font-normal text-slate-400">hrs/day</span></h3>
                        <p class="text-[11px] text-indigo-400 mt-1">Standard: 8.0 hrs/day</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400">
                        <i class="fa-solid fa-chart-simple text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- KPI 4 -->
            <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-slate-400 tracking-wider">Overtime Accumulated</p>
                        <h3 id="kpiOvertime" class="text-2xl font-extrabold text-amber-400 mt-1">42.0 <span class="text-xs font-normal text-slate-400">hrs</span></h3>
                        <p class="text-[11px] text-amber-400/80 mt-1">across 5 employees</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                        <i class="fa-solid fa-business-time text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Generator Control Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 sm:p-6 shadow-xl">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 border-b border-slate-800 pb-5 mb-5">
                <div>
                    <h2 class="text-base font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-sliders text-brand-400"></i> Report Query Parameters
                    </h2>
                    <p class="text-xs text-slate-400 mt-0.5">Filter timesheet aggregated summaries or specific employee detailed logs</p>
                </div>
                
                <!-- Quick Preset Pills -->
                <div class="flex flex-wrap items-center gap-1.5 bg-slate-950 p-1 rounded-xl border border-slate-800 text-xs">
                    <button onclick="setPreset('this_week')" id="preset-this_week" class="preset-btn px-3 py-1.5 rounded-lg text-slate-400 hover:text-white transition-all font-medium">This Week</button>
                    <button onclick="setPreset('this_month')" id="preset-this_month" class="preset-btn px-3 py-1.5 rounded-lg text-white bg-brand-600 font-medium shadow-sm">This Month</button>
                    <button onclick="setPreset('last_month')" id="preset-last_month" class="preset-btn px-3 py-1.5 rounded-lg text-slate-400 hover:text-white transition-all font-medium">Last Month</button>
                    <button onclick="setPreset('custom')" id="preset-custom" class="preset-btn px-3 py-1.5 rounded-lg text-slate-400 hover:text-white transition-all font-medium">Custom Range</button>
                </div>
            </div>

            <!-- Form Controls Bar -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4">
                
                <!-- User Selector -->
                <div class="lg:col-span-4">
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Employee Target</label>
                    <div class="relative">
                        <i class="fa-solid fa-user-tag absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                        <select id="userFilter" onchange="runFilter()" class="w-full pl-9 pr-8 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white focus:outline-none focus:ring-2 focus:ring-brand-500 appearance-none">
                            <option value="all">All Team Members (8 Users)</option>
                            <option value="1">John Doe - Senior Developer</option>
                            <option value="2">Jane Smith - Product Designer</option>
                            <option value="3">Alex Rivera - QA Engineer</option>
                            <option value="4">Michael Chen - DevOps Engineer</option>
                            <option value="5">Emily Davis - Frontend Lead</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs pointer-events-none"></i>
                    </div>
                </div>

                <!-- Start Date -->
                <div class="lg:col-span-3">
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Start Date</label>
                    <div class="relative">
                        <input type="date" id="startDate" onchange="runFilter()" value="2026-10-01" class="w-full px-3.5 py-2 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>

                <!-- End Date -->
                <div class="lg:col-span-3">
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">End Date</label>
                    <div class="relative">
                        <input type="date" id="endDate" onchange="runFilter()" value="2026-10-23" class="w-full px-3.5 py-2 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white focus:outline-none focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>

                <!-- Summary Mode Toggle & Run Action -->
                <div class="lg:col-span-2 flex flex-col justify-end">
                    <button onclick="runFilter()" class="w-full py-2.5 px-4 bg-brand-600 hover:bg-brand-500 text-white font-semibold text-xs rounded-xl shadow-md shadow-brand-600/30 transition-all flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-filter text-xs"></i>
                        <span>Apply Filter</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
            
            <div class="p-5 sm:p-6 border-b border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-base font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-table text-brand-400"></i>
                        User Work Hours Summary
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5" id="summarySubtitle">Showing calculated totals for 5 employee records</p>
                </div>

                <div class="flex items-center space-x-2">
                    <span class="text-xs text-slate-400">Search User:</span>
                    <div class="relative">
                        <input type="text" id="tableSearch" onkeyup="searchUsers()" placeholder="Name or email..." class="pl-8 pr-3 py-1.5 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-brand-500">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- User Reports Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-slate-950/70 text-xs uppercase text-slate-400 font-semibold tracking-wider border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">Employee</th>
                            <th class="px-6 py-4 text-center">Shifts Recorded</th>
                            <th class="px-6 py-4">Total Worked Hours</th>
                            <th class="px-6 py-4">Daily Avg</th>
                            <th class="px-6 py-4">Overtime Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="reportTableBody" class="divide-y divide-slate-800/60">
                        <!-- Dynamic User Summary Rows Rendered via JS -->
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="px-6 py-4 bg-slate-950/40 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
                <span id="footerRecordCount">Showing 5 employees</span>
                <div class="flex items-center space-x-2">
                    <button onclick="openExportModal()" class="px-3 py-1.5 rounded-lg bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-600/20 transition-all font-medium flex items-center gap-1.5">
                        <i class="fa-solid fa-file-excel"></i> Export Selected Query
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- User Shift Punch Detail Drilldown Modal -->
    <div id="detailModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl w-full max-w-4xl max-h-[85vh] flex flex-col shadow-2xl overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-slate-800/80 border-b border-slate-800 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div id="modalUserAvatar" class="h-10 w-10 rounded-full bg-brand-600 text-white font-bold flex items-center justify-center text-sm shadow-md">
                        JD
                    </div>
                    <div>
                        <h3 id="modalUserName" class="text-base font-bold text-white">John Doe - Detailed Punch Logs</h3>
                        <p id="modalUserMeta" class="text-xs text-slate-400">john.doe@worktracker.io • Senior Developer</p>
                    </div>
                </div>
                <button onclick="closeDetailModal()" class="text-slate-400 hover:text-white p-2 rounded-lg hover:bg-slate-800">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Modal Content (User's Individual Shift Items) -->
            <div class="p-6 overflow-y-auto space-y-4">
                <div class="flex justify-between items-center bg-slate-950 p-4 rounded-xl border border-slate-800">
                    <div>
                        <p class="text-xs text-slate-400">Period Filtered Total</p>
                        <p id="modalPeriodHours" class="text-lg font-bold text-emerald-400">162.50 hrs (20 shifts)</p>
                    </div>
                    <button onclick="exportSingleUserExcel()" class="px-3.5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold rounded-xl transition-all flex items-center gap-1.5">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>Export This User's Excel</span>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-300">
                        <thead class="bg-slate-950 text-slate-400 uppercase font-semibold border-b border-slate-800">
                            <tr>
                                <th class="p-3">Date</th>
                                <th class="p-3">Clock In</th>
                                <th class="p-3">Clock Out</th>
                                <th class="p-3">Net Hours</th>
                                <th class="p-3">Session Note / Tasks</th>
                            </tr>
                        </thead>
                        <tbody id="modalPunchLogsBody" class="divide-y divide-slate-800/60 font-mono">
                            <!-- Populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-950/60 border-t border-slate-800 flex justify-end">
                <button onclick="closeDetailModal()" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold rounded-xl">
                    Close Details
                </button>
            </div>
        </div>
    </div>

    <!-- Excel Export Modal Configuration & Download Simulation -->
    <div id="exportModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden">
            <div class="px-6 py-4 bg-slate-800/80 border-b border-slate-800 flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <div class="h-8 w-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                        <i class="fa-solid fa-file-excel text-lg"></i>
                    </div>
                    <h3 class="text-base font-bold text-white">Generate Excel (.xlsx) Report</h3>
                </div>
                <button onclick="closeExportModal()" class="text-slate-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="p-6 space-y-4 text-xs text-slate-300">
                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 space-y-2">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Target User Filter:</span>
                        <span id="expUserLabel" class="font-bold text-white">All Team Members</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Date Range:</span>
                        <span id="expDateLabel" class="font-bold text-white">2026-10-01 to 2026-10-23</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Excel Format:</span>
                        <span class="font-mono text-emerald-400">Maatwebsite / Laravel Excel (.xlsx)</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block font-semibold text-slate-200">Include Columns in Worksheet:</label>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <label class="flex items-center space-x-2 bg-slate-950 p-2 rounded-lg border border-slate-800"><input type="checkbox" checked disabled class="accent-emerald-500"> <span>Employee Metadata</span></label>
                        <label class="flex items-center space-x-2 bg-slate-950 p-2 rounded-lg border border-slate-800"><input type="checkbox" checked disabled class="accent-emerald-500"> <span>Net Worked Hours</span></label>
                        <label class="flex items-center space-x-2 bg-slate-950 p-2 rounded-lg border border-slate-800"><input type="checkbox" checked class="accent-emerald-500"> <span>Shift Timestamp Breakdown</span></label>
                        <label class="flex items-center space-x-2 bg-slate-950 p-2 rounded-lg border border-slate-800"><input type="checkbox" checked class="accent-emerald-500"> <span>Session Notes & Logs</span></label>
                    </div>
                </div>

                <!-- Simulation Progress Bar (Hidden initially) -->
                <div id="exportProgressBox" class="hidden space-y-1.5 pt-2">
                    <div class="flex justify-between text-[11px]">
                        <span class="text-slate-400">Compiling dataset and generating formulas...</span>
                        <span id="exportProgressPercent" class="text-emerald-400 font-bold">0%</span>
                    </div>
                    <div class="w-full bg-slate-950 rounded-full h-2 overflow-hidden border border-slate-800">
                        <div id="exportProgressBar" class="bg-gradient-to-r from-emerald-500 to-teal-400 h-full w-0 transition-all duration-200"></div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-950/60 border-t border-slate-800 flex items-center justify-between">
                <button onclick="closeExportModal()" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold rounded-xl">
                    Cancel
                </button>
                <button id="startDownloadBtn" onclick="triggerExcelDownloadSimulation()" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-emerald-600/30 flex items-center gap-2">
                    <i class="fa-solid fa-download"></i>
                    <span>Download WorkSheet</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Laravel Controller & Export Class Code Drawer Modal -->
    

    <!-- Notification Toast -->
    <div id="toast" class="fixed bottom-6 right-6 bg-emerald-600 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center space-x-3 translate-y-20 opacity-0 transition-all duration-300 z-50">
        <i class="fa-solid fa-file-circle-check text-xl"></i>
        <div>
            <p class="text-xs font-bold" id="toastTitle">Export Complete</p>
            <p class="text-[11px] text-emerald-100" id="toastMsg">WorkTracker Excel Report file downloaded!</p>
        </div>
    </div>

    <!-- Interactive Logic Script -->
    <script>
        // Mock Team Data
        const teamData = [
            {
                id: 1,
                name: 'John Doe',
                email: 'john.doe@worktracker.io',
                role: 'Senior Developer',
                initials: 'JD',
                color: 'bg-indigo-600',
                shifts: 20,
                totalHours: 162.5,
                dailyAvg: 8.1,
                overtime: '+2.5 hrs',
                overtimeStatus: 'normal',
                active: true,
                logs: [
                    { date: '2026-10-23', clockIn: '08:30:00 AM', clockOut: 'In Progress', hours: 'Active', note: 'Sprint planning and Laravel Excel Export package' },
                    { date: '2026-10-22', clockIn: '09:00:00 AM', clockOut: '05:15:00 PM', hours: '8.25 hrs', note: 'Database optimization & index tuning' },
                    { date: '2026-10-21', clockIn: '08:45:00 AM', clockOut: '05:00:00 PM', hours: '8.25 hrs', note: 'Frontend dashboard Blade components refactoring' }
                ]
            },
            {
                id: 2,
                name: 'Jane Smith',
                email: 'jane.smith@worktracker.io',
                role: 'Product Designer',
                initials: 'JS',
                color: 'bg-purple-600',
                shifts: 19,
                totalHours: 152.0,
                dailyAvg: 8.0,
                overtime: '0.0 hrs',
                overtimeStatus: 'none',
                active: true,
                logs: [
                    { date: '2026-10-23', clockIn: '09:00:00 AM', clockOut: 'In Progress', hours: 'Active', note: 'Figma user testing & design review' },
                    { date: '2026-10-22', clockIn: '09:00:00 AM', clockOut: '05:00:00 PM', hours: '8.00 hrs', note: 'Admin report Wireframe updates' }
                ]
            },
            {
                id: 3,
                name: 'Alex Rivera',
                email: 'alex.rivera@worktracker.io',
                role: 'QA Engineer',
                initials: 'AR',
                color: 'bg-teal-600',
                shifts: 21,
                totalHours: 174.0,
                dailyAvg: 8.3,
                overtime: '+14.0 hrs',
                overtimeStatus: 'high',
                active: true,
                logs: [
                    { date: '2026-10-23', clockIn: '08:00:00 AM', clockOut: 'In Progress', hours: 'Active', note: 'Automated E2E tests execution' },
                    { date: '2026-10-22', clockIn: '08:00:00 AM', clockOut: '06:30:00 PM', hours: '10.50 hrs', note: 'Regression testing sprint release' }
                ]
            },
            {
                id: 4,
                name: 'Michael Chen',
                email: 'michael.chen@worktracker.io',
                role: 'DevOps Engineer',
                initials: 'MC',
                color: 'bg-blue-600',
                shifts: 18,
                totalHours: 144.0,
                dailyAvg: 8.0,
                overtime: '0.0 hrs',
                overtimeStatus: 'none',
                active: false,
                logs: [
                    { date: '2026-10-22', clockIn: '09:00:00 AM', clockOut: '05:00:00 PM', hours: '8.00 hrs', note: 'CI/CD pipeline staging updates' }
                ]
            },
            {
                id: 5,
                name: 'Emily Davis',
                email: 'emily.davis@worktracker.io',
                role: 'Frontend Lead',
                initials: 'ED',
                color: 'bg-amber-600',
                shifts: 22,
                totalHours: 181.5,
                dailyAvg: 8.25,
                overtime: '+21.5 hrs',
                overtimeStatus: 'high',
                active: true,
                logs: [
                    { date: '2026-10-23', clockIn: '08:15:00 AM', clockOut: 'In Progress', hours: 'Active', note: 'Tailwind CSS dark mode fixes' }
                ]
            }
        ];

        // Render Table Rows based on filters
        function renderTable(data = teamData) {
            const tbody = document.getElementById('reportTableBody');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-8 text-center text-slate-500 italic">No employee timesheet records match the selected query.</td></tr>`;
                document.getElementById('footerRecordCount').innerText = 'Showing 0 records';
                return;
            }

            data.forEach(user => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-slate-800/40 transition-colors";
                
                let overtimeBadge = '';
                if (user.overtimeStatus === 'high') {
                    overtimeBadge = `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">${user.overtime} Overtime</span>`;
                } else if (user.overtimeStatus === 'normal') {
                    overtimeBadge = `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">${user.overtime} Overtime</span>`;
                } else {
                    overtimeBadge = `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-800 text-slate-400 border border-slate-700">Standard</span>`;
                }

                tr.innerHTML = `
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="h-9 w-9 rounded-full ${user.color} text-white font-bold flex items-center justify-center text-xs shadow-md">
                                ${user.initials}
                            </div>
                            <div>
                                <div class="font-bold text-white text-xs flex items-center gap-1.5">
                                    ${user.name}
                                    ${user.active ? '<span class="w-2 h-2 rounded-full bg-emerald-400" title="Clocked In"></span>' : ''}
                                </div>
                                <div class="text-[11px] text-slate-400">${user.email} • <span class="text-slate-500">${user.role}</span></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center font-mono text-xs text-white">${user.shifts} shifts</td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-white font-mono text-xs">${user.totalHours.toFixed(2)} hrs</div>
                        <div class="text-[10px] text-slate-400 font-mono">${Math.floor(user.totalHours)}h ${Math.round((user.totalHours % 1) * 60)}m</div>
                    </td>
                    <td class="px-6 py-4 font-mono text-xs text-slate-300">${user.dailyAvg} hrs/day</td>
                    <td class="px-6 py-4">${overtimeBadge}</td>
                    <td class="px-6 py-4 text-right">
                        <button onclick="openDetailModal(${user.id})" class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-brand-300 hover:text-white rounded-lg text-xs font-semibold border border-slate-700 transition-all flex items-center gap-1.5 ml-auto">
                            <i class="fa-solid fa-list-ul"></i>
                            <span>View Logs</span>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('footerRecordCount').innerText = `Showing ${data.length} employee summaries`;
        }

        // Quick Preset Filter Handler
        function setPreset(preset) {
            document.querySelectorAll('.preset-btn').forEach(btn => {
                btn.className = 'preset-btn px-3 py-1.5 rounded-lg text-slate-400 hover:text-white transition-all font-medium';
            });
            document.getElementById(`preset-${preset}`).className = 'preset-btn px-3 py-1.5 rounded-lg text-white bg-brand-600 font-medium shadow-sm';

            const startInput = document.getElementById('startDate');
            const endInput = document.getElementById('endDate');

            if (preset === 'this_week') {
                startInput.value = '2026-10-19';
                endInput.value = '2026-10-23';
            } else if (preset === 'this_month') {
                startInput.value = '2026-10-01';
                endInput.value = '2026-10-23';
            } else if (preset === 'last_month') {
                startInput.value = '2026-09-01';
                endInput.value = '2026-09-30';
            }
            runFilter();
        }

        // Filter Logic
        function runFilter() {
            const selectedUserId = document.getElementById('userFilter').value;
            let filtered = teamData;

            if (selectedUserId !== 'all') {
                filtered = teamData.filter(u => u.id === parseInt(selectedUserId));
            }

            renderTable(filtered);
            updateKPICards(filtered);
        }

        function searchUsers() {
            const query = document.getElementById('tableSearch').value.toLowerCase();
            const filtered = teamData.filter(u => u.name.toLowerCase().includes(query) || u.email.toLowerCase().includes(query));
            renderTable(filtered);
        }

        // Recalculate KPIs based on filtered set
        function updateKPICards(dataset) {
            const totalHours = dataset.reduce((acc, curr) => acc + curr.totalHours, 0);
            const activeCount = dataset.filter(u => u.active).length;
            const avgDaily = dataset.length ? (totalHours / dataset.length / 20).toFixed(1) : 0;

            document.getElementById('kpiTotalHours').innerText = `${totalHours.toLocaleString()} hrs`;
            document.getElementById('kpiActiveUsers').innerText = `${activeCount} / ${dataset.length} users`;
            document.getElementById('kpiAvgDaily').innerText = `${avgDaily} hrs/day`;
        }

        // Open Individual User Punch Log Modal
        function openDetailModal(userId) {
            const user = teamData.find(u => u.id === userId);
            if (!user) return;

            document.getElementById('modalUserAvatar').innerText = user.initials;
            document.getElementById('modalUserName').innerText = `${user.name} - Timesheet Logs`;
            document.getElementById('modalUserMeta').innerText = `${user.email} • ${user.role}`;
            document.getElementById('modalPeriodHours').innerText = `${user.totalHours.toFixed(2)} hrs (${user.shifts} shifts recorded)`;

            const body = document.getElementById('modalPunchLogsBody');
            body.innerHTML = '';

            user.logs.forEach(log => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-slate-800/40";
                tr.innerHTML = `
                    <td class="p-3 text-white font-bold">${log.date}</td>
                    <td class="p-3 text-emerald-400"><i class="fa-solid fa-right-to-bracket mr-1"></i>${log.clockIn}</td>
                    <td class="p-3 text-slate-400">${log.clockOut}</td>
                    <td class="p-3 text-white font-bold">${log.hours}</td>
                    <td class="p-3 text-slate-400 font-sans">${log.note}</td>
                `;
                body.appendChild(tr);
            });

            const modal = document.getElementById('detailModal');
            modal.classList.remove('opacity-0', 'pointer-events-none');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('opacity-0', 'pointer-events-none');
        }

        // Excel Export Modal Controls
        function openExportModal() {
            const userFilterVal = document.getElementById('userFilter').value;
            const userFilterText = document.getElementById('userFilter').options[document.getElementById('userFilter').selectedIndex].text;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            document.getElementById('expUserLabel').innerText = userFilterText;
            document.getElementById('expDateLabel').innerText = `${startDate} to ${endDate}`;

            document.getElementById('exportProgressBox').classList.add('hidden');
            document.getElementById('exportProgressBar').style.width = '0%';
            document.getElementById('startDownloadBtn').disabled = false;

            const modal = document.getElementById('exportModal');
            modal.classList.remove('opacity-0', 'pointer-events-none');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('opacity-0', 'pointer-events-none');
        }

        function exportSingleUserExcel() {
            closeDetailModal();
            openExportModal();
        }

        // Simulate Maatwebsite / Laravel Excel Download Progress
        function triggerExcelDownloadSimulation() {
            const btn = document.getElementById('startDownloadBtn');
            const progressBox = document.getElementById('exportProgressBox');
            const bar = document.getElementById('exportProgressBar');
            const percentText = document.getElementById('exportProgressPercent');

            btn.disabled = true;
            progressBox.classList.remove('hidden');

            let pct = 0;
            const timer = setInterval(() => {
                pct += 20;
                bar.style.width = pct + '%';
                percentText.innerText = pct + '%';

                if (pct >= 100) {
                    clearInterval(timer);
                    setTimeout(() => {
                        closeExportModal();
                        showToast('Excel Report Generated!', 'Your .xlsx report file has been successfully generated & downloaded.');
                    }, 400);
                }
            }, 180);
        }

        // Toast Feedback
        function showToast(title, msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastTitle').innerText = title;
            document.getElementById('toastMsg').innerText = msg;

            toast.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3500);
        }

        // Code Drawer Modal
        function toggleBladeModal() {
            const modal = document.getElementById('bladeModal');
            if (modal.classList.contains('opacity-0')) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                modal.classList.add('opacity-0', 'pointer-events-none');
            }
        }

        function copyCodeSnippet(elementId) {
            const text = document.getElementById(elementId).innerText;
            const temp = document.createElement('textarea');
            temp.value = text;
            document.body.appendChild(temp);
            temp.select();
            document.execCommand('copy');
            document.body.removeChild(temp);
            showToast('Code Copied', 'Laravel Export Class copied to clipboard!');
        }

        // Initialize table on page load
        renderTable();
    </script>
</body>
</html>