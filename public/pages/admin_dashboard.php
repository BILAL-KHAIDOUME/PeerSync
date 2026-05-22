<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - PeerSync</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .display { font-family: 'Fraunces', serif; }
    .sidebar-active { background: rgba(13,148,136,0.1); border-left: 3px solid #0D9488; }
    .stat-card { background: linear-gradient(135deg, #f5f3ef 0%, #faf9f7 100%); }
    .chart-bar { background: linear-gradient(180deg, #0D9488 0%, #0a7a73 100%); }
  </style>
</head>
<body class="bg-[#f5f3ef] min-h-screen">

  <!-- Header -->
  <header class="bg-white border-b border-[#e2e0db]">
    <div class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
      <div class="flex items-center gap-3">
        <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="20" cy="20" r="18" stroke="#0D9488" stroke-width="2"/>
          <path d="M14 16C14 13.79 15.79 12 18 12C19.66 12 21.05 12.87 21.71 14.12C22.89 13.52 24.27 13 26 13C30.42 13 34 16.58 34 21C34 22.66 33.59 24.23 32.88 25.6" stroke="#0D9488" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span class="display text-2xl font-light tracking-tight text-[#0D9488]">PeerSync</span>
        <span class="ml-4 px-3 py-1 bg-red-100 text-red-700 text-xs rounded-full font-semibold uppercase">Admin</span>
      </div>
      
      <div class="flex items-center gap-4">
        <button class="relative p-2 text-[#7a6f64] hover:bg-[#f5f3ef] rounded-lg transition">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
          </svg>
          <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>
        
        <div class="flex items-center gap-3 pl-4 border-l border-[#e2e0db]">
          <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-white text-sm font-medium">
            AD
          </div>
          <div class="hidden sm:block">
            <p class="text-sm font-medium text-[#1a1a1a]">Admin User</p>
            <p class="text-xs text-[#9a8f82]">Administrator</p>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="flex max-w-7xl mx-auto">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-[#e2e0db] p-6 hidden lg:block min-h-screen">
      <nav class="space-y-2">
        <a href="#" class="sidebar-active w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#0D9488] font-medium text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
          Dashboard
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Manage Users
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
          Monitor Sessions
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
          Reports & Analytics
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M2 12h20"/></svg>
          Settings
        </a>
        <hr class="my-4 border-[#e2e0db]" />
        <a href="login.php" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Logout
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 lg:p-8">
      <!-- Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Total Users</p>
          <p class="text-3xl font-semibold text-[#1a1a1a]">342</p>
          <p class="text-xs text-green-600 mt-2">↑ 12% this month</p>
        </div>
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Active Sessions</p>
          <p class="text-3xl font-semibold text-[#1a1a1a]">24</p>
          <p class="text-xs text-[#9a8f82] mt-2">Right now</p>
        </div>
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Total Hours</p>
          <p class="text-3xl font-semibold text-[#1a1a1a]">1,240h</p>
          <p class="text-xs text-green-600 mt-2">↑ 8.2% this month</p>
        </div>
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Avg Rating</p>
          <p class="text-3xl font-semibold text-[#0D9488]">4.8</p>
          <p class="text-xs text-[#9a8f82] mt-2">Out of 5.0</p>
        </div>
      </div>

      <!-- Charts -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- User Growth Chart -->
        <div class="bg-white rounded-xl border border-[#e2e0db] p-6">
          <h3 class="text-lg font-semibold text-[#1a1a1a] mb-6">User Growth</h3>
          <div class="flex items-end justify-around h-48 gap-2">
            <div class="w-full flex flex-col items-center">
              <div class="chart-bar" style="height: 40%"></div>
              <p class="text-xs text-[#9a8f82] mt-2">Jan</p>
            </div>
            <div class="w-full flex flex-col items-center">
              <div class="chart-bar" style="height: 55%"></div>
              <p class="text-xs text-[#9a8f82] mt-2">Feb</p>
            </div>
            <div class="w-full flex flex-col items-center">
              <div class="chart-bar" style="height: 70%"></div>
              <p class="text-xs text-[#9a8f82] mt-2">Mar</p>
            </div>
            <div class="w-full flex flex-col items-center">
              <div class="chart-bar" style="height: 85%"></div>
              <p class="text-xs text-[#9a8f82] mt-2">Apr</p>
            </div>
            <div class="w-full flex flex-col items-center">
              <div class="chart-bar" style="height: 95%"></div>
              <p class="text-xs text-[#9a8f82] mt-2">May</p>
            </div>
          </div>
        </div>

        <!-- User Distribution -->
        <div class="bg-white rounded-xl border border-[#e2e0db] p-6">
          <h3 class="text-lg font-semibold text-[#1a1a1a] mb-6">User Distribution</h3>
          <div class="space-y-4">
            <div>
              <div class="flex justify-between mb-2">
                <p class="text-sm text-[#9a8f82]">Students</p>
                <p class="text-sm font-semibold text-[#1a1a1a]">185 (54%)</p>
              </div>
              <div class="w-full bg-[#e2e0db] rounded-full h-2">
                <div class="bg-blue-500 h-2 rounded-full" style="width: 54%"></div>
              </div>
            </div>
            <div>
              <div class="flex justify-between mb-2">
                <p class="text-sm text-[#9a8f82]">Tutors</p>
                <p class="text-sm font-semibold text-[#1a1a1a]">142 (41%)</p>
              </div>
              <div class="w-full bg-[#e2e0db] rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 41%"></div>
              </div>
            </div>
            <div>
              <div class="flex justify-between mb-2">
                <p class="text-sm text-[#9a8f82]">Admins</p>
                <p class="text-sm font-semibold text-[#1a1a1a]">15 (5%)</p>
              </div>
              <div class="w-full bg-[#e2e0db] rounded-full h-2">
                <div class="bg-red-500 h-2 rounded-full" style="width: 5%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="bg-white rounded-xl border border-[#e2e0db] p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-lg font-semibold text-[#1a1a1a]">Recent Sessions</h2>
          <a href="#" class="text-sm text-[#0D9488] hover:text-[#0a7a73] font-medium">View All →</a>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="border-b border-[#e2e0db]">
              <tr>
                <th class="text-left px-4 py-3 text-[#9a8f82] font-semibold uppercase">Student</th>
                <th class="text-left px-4 py-3 text-[#9a8f82] font-semibold uppercase">Tutor</th>
                <th class="text-left px-4 py-3 text-[#9a8f82] font-semibold uppercase">Subject</th>
                <th class="text-left px-4 py-3 text-[#9a8f82] font-semibold uppercase">Duration</th>
                <th class="text-left px-4 py-3 text-[#9a8f82] font-semibold uppercase">Date</th>
                <th class="text-left px-4 py-3 text-[#9a8f82] font-semibold uppercase">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#e2e0db]">
              <tr class="hover:bg-[#f5f3ef] transition">
                <td class="px-4 py-4 text-[#1a1a1a] font-medium">John Doe</td>
                <td class="px-4 py-4 text-[#1a1a1a]">Sarah Ahmed</td>
                <td class="px-4 py-4 text-[#9a8f82]">Mathematics</td>
                <td class="px-4 py-4 text-[#9a8f82]">2 hours</td>
                <td class="px-4 py-4 text-[#9a8f82]">Today 3:00 PM</td>
                <td class="px-4 py-4"><span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium">Completed</span></td>
              </tr>
              <tr class="hover:bg-[#f5f3ef] transition">
                <td class="px-4 py-4 text-[#1a1a1a] font-medium">Emma Martinez</td>
                <td class="px-4 py-4 text-[#1a1a1a]">Mike Wilson</td>
                <td class="px-4 py-4 text-[#9a8f82]">Physics</td>
                <td class="px-4 py-4 text-[#9a8f82]">1.5 hours</td>
                <td class="px-4 py-4 text-[#9a8f82]">Yesterday 2:30 PM</td>
                <td class="px-4 py-4"><span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium">Completed</span></td>
              </tr>
              <tr class="hover:bg-[#f5f3ef] transition">
                <td class="px-4 py-4 text-[#1a1a1a] font-medium">Ahmed Hassan</td>
                <td class="px-4 py-4 text-[#1a1a1a]">Lisa Chen</td>
                <td class="px-4 py-4 text-[#9a8f82]">Programming</td>
                <td class="px-4 py-4 text-[#9a8f82]">3 hours</td>
                <td class="px-4 py-4 text-[#9a8f82]">Mon 4:00 PM</td>
                <td class="px-4 py-4"><span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-medium">In Progress</span></td>
              </tr>
              <tr class="hover:bg-[#f5f3ef] transition">
                <td class="px-4 py-4 text-[#1a1a1a] font-medium">Lisa Johnson</td>
                <td class="px-4 py-4 text-[#1a1a1a]">Sarah Ahmed</td>
                <td class="px-4 py-4 text-[#9a8f82]">Chemistry</td>
                <td class="px-4 py-4 text-[#9a8f82]">2 hours</td>
                <td class="px-4 py-4 text-[#9a8f82]">Sat 10:00 AM</td>
                <td class="px-4 py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full font-medium">Scheduled</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="#" class="bg-gradient-to-br from-[#0D9488] to-[#0a7a73] rounded-xl p-6 text-white hover:shadow-lg transition">
          <h3 class="text-lg font-semibold mb-1">Manage Users</h3>
          <p class="text-sm text-white/80">Verify & manage user accounts</p>
        </a>
        
        <a href="#" class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl p-6 text-white hover:shadow-lg transition">
          <h3 class="text-lg font-semibold mb-1">Monitor Sessions</h3>
          <p class="text-sm text-white/80">Track ongoing tutoring sessions</p>
        </a>

        <a href="#" class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl p-6 text-white hover:shadow-lg transition">
          <h3 class="text-lg font-semibold mb-1">View Reports</h3>
          <p class="text-sm text-white/80">Detailed analytics & insights</p>
        </a>
      </div>
    </main>
  </div>

</body>
</html>
