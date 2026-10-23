  <!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkTracker - Dashboard & Timesheet</title>
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



    <!-- Main Navigation Header -->
    <nav class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800 sticky z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand logo -->
                <div class="flex items-center space-x-3">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-brand-600 to-indigo-400 flex items-center justify-center shadow-lg shadow-brand-500/20">
                        <i class="fa-solid fa-clock-rotate-left text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">Work<span class="text-brand-400">Tracker</span></span>
                </div>

                <!-- Right profile area -->
                <div class="flex items-center space-x-4">
                    <!-- Status Badge -->
                    <div id="statusBadge" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                        <span class="w-2 h-2 rounded-full bg-rose-500 mr-2 animate-pulse" id="statusDot"></span>
                        <span id="statusText">Clocked Out</span>
                    </div>

                    <!-- User profile dropdown mock -->
                    <div class="flex items-center space-x-3 border-l border-slate-800 pl-4">
                        <div class="h-9 w-9 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-sm font-semibold text-brand-400">
                            JD
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-xs font-semibold text-white leading-none">John Doe</p>
                            <p class="text-[11px] text-slate-400 leading-none mt-1">Senior Developer</p>
                        </div>
                        <a href="#" class="text-slate-400 hover:text-rose-400 text-sm ml-2 transition-colors" title="Logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-6">
        
        <!-- Live Clock & Shift Clock In/Out Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- Quick Action: Clock In / Out Box -->
            <div class="lg:col-span-7 bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 relative overflow-hidden shadow-xl flex flex-col justify-between">
                <!-- Ambient glow -->
                <div class="absolute -top-16 -right-16 w-60 h-60 bg-brand-600/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-800 pb-5">
                    <div>
                        <h2 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="fa-solid fa-business-time text-brand-400"></i>
                            Timesheet Punching
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Record your session timestamps for precise automated totalizing</p>
                    </div>
                    <!-- <div class="text-right">
                        <div id="liveTime" class="text-2xl font-mono font-bold text-white tracking-wider">00:00:00 AM</div>
                        <div id="liveDate" class="text-xs text-slate-400">Loading date...</div>
                    </div> -->

                    <div class="text-right">
                        <!-- Inject server timestamp in milliseconds for JS, and formatted string for initial load -->
                        <div id="liveTime" 
                            data-server-time="{{ \Carbon\Carbon::now()->getTimestampMs() }}" 
                            class="text-2xl font-mono font-bold text-white tracking-wider">
                            {{ \Carbon\Carbon::now()->format('h:i:s A') }}
                        </div>
                        <div id="liveDate" class="text-xs text-slate-400">
                            {{ \Carbon\Carbon::now()->format('D, M j, Y') }}
                        </div>
                    </div>
                </div>

                <!-- Shift Counter display -->
                <div class="my-6 p-4 rounded-xl bg-slate-950/80 border border-slate-800/80 flex items-center justify-between">
                    <div>
                        <span class="text-xs uppercase font-semibold text-slate-400 tracking-wider">Current Shift Elapsed</span>
                        <div id="shiftTimer" class="text-3xl font-mono font-extrabold text-slate-500 mt-1">00:00:00</div>
                    </div>
                    <div id="shiftIndicator" class="text-xs px-3 py-1.5 rounded-lg bg-slate-800 text-slate-400 border border-slate-700 font-medium">
                        Shift Inactive
                    </div>
                </div>

                <!-- Session Notes Input & Action Button -->
                <div class="space-y-4">
                    <div>
                        <label for="shiftNote" class="block text-xs font-medium text-slate-300 mb-1.5">
                            Session Note <span class="text-slate-500">(Optional - task summary or focus)</span>
                        </label>
                        <input 
                            type="text" 
                            id="shiftNote" 
                            placeholder="e.g., Working on customer concern" 
                            class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all"
                        >
                    </div>

                    <button 
                        id="clockBtn" 
                        onclick="toggleClockState()" 
                        class="w-full py-4 px-6 rounded-xl font-bold text-base text-white bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 active:scale-[0.99] transition-all shadow-lg shadow-brand-600/25 flex items-center justify-center space-x-2"
                    >
                        <i id="clockBtnIcon" class="fa-solid fa-play text-sm"></i>
                        <span id="clockBtnText">Clock In Now</span>
                    </button>
                </div>
            </div>

            <!-- Right Column: Quick Stats -->
            <div class="lg:col-span-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                
                <!-- Stat Card 1 -->
                <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-lg flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Hours Worked Today</p>
                        <h3 id="statToday" class="text-2xl font-bold text-white mt-1">6.50 <span class="text-xs font-normal text-slate-400">hrs</span></h3>
                        <p class="text-[11px] text-emerald-400 mt-1 flex items-center gap-1">
                            <i class="fa-solid fa-arrow-trend-up"></i> On track for 8.0 hrs target
                        </p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-brand-500/10 border border-brand-500/20 flex items-center justify-center text-brand-400">
                        <i class="fa-solid fa-calendar-day text-xl"></i>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-lg flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Hours Worked This Week</p>
                        <h3 id="statWeek" class="text-2xl font-bold text-white mt-1">38.25 <span class="text-xs font-normal text-slate-400">hrs</span></h3>
                        <p class="text-[11px] text-slate-400 mt-1">
                            Period: Mon - Sun
                        </p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400">
                        <i class="fa-solid fa-chart-column text-xl"></i>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-lg flex items-center justify-between sm:col-span-2 lg:col-span-1">
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Total Logs This Month</p>
                        <h3 id="statLogs" class="text-2xl font-bold text-white mt-1">18 <span class="text-xs font-normal text-slate-400">entries</span></h3>
                        <p class="text-[11px] text-slate-400 mt-1">
                            Calculated across 142 total net hours
                        </p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <i class="fa-solid fa-file-invoice text-xl"></i>
                    </div>
                </div>

            </div>
        </div>

        <!-- Activity & Timesheet Table Section -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
            
            <!-- Table Header Filters & Actions -->
            <div class="p-5 sm:p-6 border-b border-slate-800 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <h3 class="text-base font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-brand-400"></i>
                        Work Session History
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">Filter, review, and export your session logs to Excel</p>
                </div>

                <!-- Search and Filters Bar -->
                <div class="flex flex-wrap items-center gap-3">
                    <!-- Date Range Inputs -->
                    <div class="flex items-center space-x-2 bg-slate-950 px-3 py-1.5 rounded-xl border border-slate-800">
                        <i class="fa-regular fa-calendar text-slate-500 text-xs"></i>
                        <input type="date" id="startDate" onchange="filterLogs()" class="bg-transparent text-xs text-white focus:outline-none">
                        <span class="text-slate-600 text-xs">to</span>
                        <input type="date" id="endDate" onchange="filterLogs()" class="bg-transparent text-xs text-white focus:outline-none">
                    </div>

                    <!-- Text Search -->
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                        <input 
                            type="text" 
                            id="searchQuery" 
                            onkeyup="filterLogs()" 
                            placeholder="Search notes..." 
                            class="pl-8 pr-3 py-1.5 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-brand-500"
                        >
                    </div>

                    <!-- Export Excel Button -->
                    <button 
                        onclick="exportExcel()" 
                        class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold rounded-xl transition-all shadow-md shadow-emerald-600/20 flex items-center space-x-2"
                    >
                        <i class="fa-solid fa-file-excel text-sm"></i>
                        <span>Export Excel (.xlsx)</span>
                    </button>
                </div>
            </div>

            <!-- Table Component -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-slate-950/60 text-xs uppercase text-slate-400 font-semibold tracking-wider border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-3.5">Date</th>
                            <th class="px-6 py-3.5">Clock In</th>
                            <th class="px-6 py-3.5">Clock Out</th>
                            <th class="px-6 py-3.5">Net Hours</th>
                            <th class="px-6 py-3.5">Session Note</th>
                            <th class="px-6 py-3.5 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody id="logsTableBody" class="divide-y divide-slate-800/60">
                        <!-- Dynamic Log Rows will render here -->
                    </tbody>
                </table>
            </div>

            <!-- Table Footer Pagination/Summary -->
            <div class="px-6 py-4 bg-slate-950/40 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
                <span id="showingCount">Showing 3 session logs</span>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 rounded-lg bg-slate-800 border border-slate-700 text-slate-300 hover:bg-slate-700 disabled:opacity-50" disabled>Previous</button>
                    <button class="px-3 py-1 rounded-lg bg-slate-800 border border-slate-700 text-slate-300 hover:bg-slate-700 disabled:opacity-50" disabled>Next</button>
                </div>
            </div>

        </div>
    </main>

    <!-- Modal Notification Toast (For Excel export feedback) -->
    <div id="toast" class="fixed bottom-6 right-6 bg-emerald-600 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center space-x-3 translate-y-20 opacity-0 transition-all duration-300 z-50">
        <i class="fa-solid fa-circle-check text-lg"></i>
        <div>
            <p class="text-xs font-bold" id="toastTitle">Export Started</p>
            <p class="text-[11px] text-emerald-100" id="toastMsg">Generating your timesheet report...</p>
        </div>
    </div>

    <!-- Interactive JavaScript Engine -->
    <script>
        // Initial Mock Data
        let isClockedIn = false;
        let shiftStartTime = null;
        let shiftInterval = null;
        let shiftSeconds = 0;

        let mockLogs = [
            { id: 1, date: '2026-10-23', clockIn: '08:30:00 AM', clockOut: '03:00:00 PM', hours: '6.50 hrs', note: 'Sprint planning and bug fixes', active: false },
            { id: 2, date: '2026-10-22', clockIn: '09:00:00 AM', clockOut: '05:15:00 PM', hours: '8.25 hrs', note: 'Laravel Excel Export package integration', active: false },
            { id: 3, date: '2026-10-21', clockIn: '08:45:00 AM', clockOut: '05:00:00 PM', hours: '8.25 hrs', note: 'Database schema migration & testing', active: false }
        ];

        // Real-Time Clock Function
        // function updateLiveClock() {
        //     const now = new Date();
        //     const timeStr = now.toLocaleTimeString('en-US', { hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' });
        //     const dateStr = now.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' });
            
        //     document.getElementById('liveTime').innerText = timeStr;
        //     document.getElementById('liveDate').innerText = dateStr;
        // }
        // setInterval(updateLiveClock, 1000);
        

        // Initialize server time from data attribute
        const liveTimeEl = document.getElementById('liveTime');
        let serverTimeMs = parseInt(liveTimeEl.getAttribute('data-server-time')) || Date.now();
        function updateLiveClock() {
            // Increment by 1 second (1000 ms) every tick
            serverTimeMs += 1000;
            const serverDate = new Date(serverTimeMs);

            // Format Time (12-hour with AM/PM)
            const timeStr = serverDate.toLocaleTimeString('en-US', { 
                hour12: true, 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit' 
            });

            // Format Date
            const dateStr = serverDate.toLocaleDateString('en-US', { 
                weekday: 'short', 
                month: 'short', 
                day: 'numeric', 
                year: 'numeric' 
            });
            
            liveTimeEl.innerText = timeStr;
            document.getElementById('liveDate').innerText = dateStr;
        }

        // Run every second
        setInterval(updateLiveClock, 1000);
        updateLiveClock();

        // Render Table Rows
        function renderTable(data = mockLogs) {
            const tbody = document.getElementById('logsTableBody');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-8 text-center text-slate-500 italic">No work session logs match your query.</td></tr>`;
                document.getElementById('showingCount').innerText = 'Showing 0 session logs';
                return;
            }

            data.forEach(log => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-slate-800/40 transition-colors";
                tr.innerHTML = `
                    <td class="px-6 py-4 font-mono text-xs text-white">${log.date}</td>
                    <td class="px-6 py-4 font-mono text-xs text-emerald-400"><i class="fa-solid fa-right-to-bracket mr-1.5 text-[10px]"></i>${log.clockIn}</td>
                    <td class="px-6 py-4 font-mono text-xs ${log.active ? 'text-amber-400 font-bold' : 'text-slate-400'}">
                        ${log.active ? '<i class="fa-solid fa-spinner animate-spin mr-1.5 text-[10px]"></i>In Progress' : '<i class="fa-solid fa-right-from-bracket mr-1.5 text-[10px]"></i>' + log.clockOut}
                    </td>
                    <td class="px-6 py-4 font-semibold text-white">${log.hours}</td>
                    <td class="px-6 py-4 text-xs text-slate-300 max-w-xs truncate" title="${log.note}">${log.note || '-'}</td>
                    <td class="px-6 py-4 text-right">
                        ${log.active ? 
                            '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Active</span>' : 
                            '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-800 text-slate-400 border border-slate-700">Completed</span>'
                        }
                    </td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('showingCount').innerText = `Showing ${data.length} session logs`;
        }

        // Toggle Clock In / Clock Out State
        function toggleClockState() {
            const clockBtn = document.getElementById('clockBtn');
            const clockBtnText = document.getElementById('clockBtnText');
            const clockBtnIcon = document.getElementById('clockBtnIcon');
            const statusBadge = document.getElementById('statusBadge');
            const statusText = document.getElementById('statusText');
            const statusDot = document.getElementById('statusDot');
            const shiftTimer = document.getElementById('shiftTimer');
            const shiftIndicator = document.getElementById('shiftIndicator');
            const shiftNote = document.getElementById('shiftNote');

            if (!isClockedIn) {
                // Perform Clock IN
                isClockedIn = true;
                shiftSeconds = 0;
                const now = new Date();
                shiftStartTime = now.toLocaleTimeString('en-US', { hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' });

                // Update UI for Clocked In State
                clockBtnText.innerText = 'Clock Out Now';
                clockBtnIcon.className = 'fa-solid fa-stop text-sm';
                clockBtn.className = 'w-full py-4 px-6 rounded-xl font-bold text-base text-white bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 active:scale-[0.99] transition-all shadow-lg shadow-rose-600/25 flex items-center justify-center space-x-2';

                statusBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20';
                statusDot.className = 'w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-ping';
                statusText.innerText = 'Clocked In';

                shiftIndicator.className = 'text-xs px-3 py-1.5 rounded-lg bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-medium';
                shiftIndicator.innerText = 'Shift Active';
                shiftTimer.classList.replace('text-slate-500', 'text-emerald-400');

                // Start Timer Interval
                shiftInterval = setInterval(() => {
                    shiftSeconds++;
                    const hrs = String(Math.floor(shiftSeconds / 3600)).padStart(2, '0');
                    const mins = String(Math.floor((shiftSeconds % 3600) / 60)).padStart(2, '0');
                    const secs = String(shiftSeconds % 60).padStart(2, '0');
                    shiftTimer.innerText = `${hrs}:${mins}:${secs}`;
                }, 1000);

                // Insert active log into table top
                const todayStr = new Date().toISOString().split('T')[0];
                mockLogs.unshift({
                    id: Date.now(),
                    date: todayStr,
                    clockIn: shiftStartTime,
                    clockOut: '-',
                    hours: 'In Progress',
                    note: shiftNote.value || 'Active shift...',
                    active: true
                });

                renderTable();

            } else {
                // Perform Clock OUT
                isClockedIn = false;
                clearInterval(shiftInterval);

                const now = new Date();
                const clockOutTime = now.toLocaleTimeString('en-US', { hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' });
                const netHoursCalculated = (shiftSeconds / 3600).toFixed(2);

                // Update Active Log
                if (mockLogs[0] && mockLogs[0].active) {
                    mockLogs[0].clockOut = clockOutTime;
                    mockLogs[0].hours = `${netHoursCalculated} hrs`;
                    mockLogs[0].note = shiftNote.value || 'Completed shift session';
                    mockLogs[0].active = false;
                }

                // Reset UI to Clocked Out State
                clockBtnText.innerText = 'Clock In Now';
                clockBtnIcon.className = 'fa-solid fa-play text-sm';
                clockBtn.className = 'w-full py-4 px-6 rounded-xl font-bold text-base text-white bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 active:scale-[0.99] transition-all shadow-lg shadow-brand-600/25 flex items-center justify-center space-x-2';

                statusBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20';
                statusDot.className = 'w-2 h-2 rounded-full bg-rose-500 mr-2 animate-pulse';
                statusText.innerText = 'Clocked Out';

                shiftIndicator.className = 'text-xs px-3 py-1.5 rounded-lg bg-slate-800 text-slate-400 border border-slate-700 font-medium';
                shiftIndicator.innerText = 'Shift Inactive';
                shiftTimer.classList.replace('text-emerald-400', 'text-slate-500');
                shiftTimer.innerText = '00:00:00';
                shiftNote.value = '';

                renderTable();
            }
        }

        // Filter Table Logs
        function filterLogs() {
            const query = document.getElementById('searchQuery').value.toLowerCase();
            const start = document.getElementById('startDate').value;
            const end = document.getElementById('endDate').value;

            const filtered = mockLogs.filter(log => {
                const matchesNote = log.note.toLowerCase().includes(query) || log.date.includes(query);
                let matchesDate = true;
                if (start && log.date < start) matchesDate = false;
                if (end && log.date > end) matchesDate = false;
                return matchesNote && matchesDate;
            });

            renderTable(filtered);
        }

        // Trigger Excel Export Toast
        function exportExcel() {
            const toast = document.getElementById('toast');
            toast.classList.remove('translate-y-20', 'opacity-0');
            
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);
        }

        // Toggle Modal
        function toggleBladeModal() {
            const modal = document.getElementById('bladeModal');
            if (modal.classList.contains('opacity-0')) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                modal.classList.add('opacity-0', 'pointer-events-none');
            }
        }

        // Copy Code Snippet
        function copyBladeCode() {
            const codeText = document.getElementById('bladeCodeText').innerText;
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

        // Initial Table Load
        renderTable();
    </script>
</body>
</html>