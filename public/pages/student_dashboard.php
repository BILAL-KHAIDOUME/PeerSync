<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Dashboard - PeerSync</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .display { font-family: 'Fraunces', serif; }
    .sidebar-active { background: rgba(13,148,136,0.1); border-left: 3px solid #0D9488; }
    .stat-card { background: linear-gradient(135deg, #f5f3ef 0%, #faf9f7 100%); }
    .badge { display: inline-block; }
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
          <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#0D9488] to-[#0a7a73] flex items-center justify-center text-white text-sm font-medium">
            JD
          </div>
          <div class="hidden sm:block">
            <p class="text-sm font-medium text-[#1a1a1a]">John Doe</p>
            <p class="text-xs text-[#9a8f82]">Student</p>
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
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
          Create Request
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
          My Requests
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
          Sessions
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          Reviews
        </a>
        <hr class="my-4 border-[#e2e0db]" />
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Profile
        </a>
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
          <p class="text-sm text-[#9a8f82] mb-2">Active Requests</p>
          <p class="text-3xl font-semibold text-[#1a1a1a]">3</p>
          <p class="text-xs text-[#9a8f82] mt-2">2 pending, 1 in progress</p>
        </div>
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Completed Sessions</p>
          <p class="text-3xl font-semibold text-[#1a1a1a]">12</p>
          <p class="text-xs text-[#9a8f82] mt-2">Avg rating: 4.8/5</p>
        </div>
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Hours Tutored</p>
          <p class="text-3xl font-semibold text-[#1a1a1a]">24h</p>
          <p class="text-xs text-[#9a8f82] mt-2">This semester</p>
        </div>
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Points Earned</p>
          <p class="text-3xl font-semibold text-[#0D9488]">450</p>
          <p class="text-xs text-[#9a8f82] mt-2">+50 this week</p>
        </div>
      </div>

      <!-- Recent Requests -->
      <div class="bg-white rounded-xl border border-[#e2e0db] p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-lg font-semibold text-[#1a1a1a]">Recent Requests</h2>
          <a href="#" class="text-sm text-[#0D9488] hover:text-[#0a7a73] font-medium">View All →</a>
        </div>

        <div class="space-y-4">
          <!-- Request Card 1 -->
          <div class="flex items-start justify-between p-4 border border-[#e2e0db] rounded-lg hover:bg-[#f5f3ef] transition">
            <div class="flex-1">
              <div class="flex items-center gap-2 mb-1">
                <h3 class="font-semibold text-[#1a1a1a]">Mathematics - Algebra</h3>
                <span class="badge px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded font-medium">Pending</span>
              </div>
              <p class="text-sm text-[#9a8f82] mb-2">Need help with quadratic equations</p>
              <p class="text-xs text-[#c5bdb4]">Created 2 hours ago</p>
            </div>
            <button class="px-4 py-2 bg-[#0D9488] text-white rounded-lg text-sm font-medium hover:bg-[#0a7a73] transition">
              Browse Tutors
            </button>
          </div>

          <!-- Request Card 2 -->
          <div class="flex items-start justify-between p-4 border border-[#e2e0db] rounded-lg hover:bg-[#f5f3ef] transition">
            <div class="flex-1">
              <div class="flex items-center gap-2 mb-1">
                <h3 class="font-semibold text-[#1a1a1a]">Physics - Mechanics</h3>
                <span class="badge px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded font-medium">In Progress</span>
              </div>
              <p class="text-sm text-[#9a8f82] mb-2">Assigned to Sarah Ahmed</p>
              <p class="text-xs text-[#c5bdb4]">Session: Today at 3:00 PM</p>
            </div>
            <button class="px-4 py-2 bg-white border border-[#e2e0db] text-[#1a1a1a] rounded-lg text-sm font-medium hover:bg-[#f5f3ef] transition">
              Details
            </button>
          </div>

          <!-- Request Card 3 -->
          <div class="flex items-start justify-between p-4 border border-[#e2e0db] rounded-lg hover:bg-[#f5f3ef] transition">
            <div class="flex-1">
              <div class="flex items-center gap-2 mb-1">
                <h3 class="font-semibold text-[#1a1a1a]">English - Essay Writing</h3>
                <span class="badge px-2 py-1 bg-green-100 text-green-700 text-xs rounded font-medium">Completed</span>
              </div>
              <p class="text-sm text-[#9a8f82] mb-2">Completed with Ahmed Hassan</p>
              <p class="text-xs text-[#c5bdb4]">Rating: 5/5 ⭐</p>
            </div>
            <button class="px-4 py-2 bg-white border border-[#e2e0db] text-[#1a1a1a] rounded-lg text-sm font-medium hover:bg-[#f5f3ef] transition">
              Leave Review
            </button>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Create Request CTA -->
        <div class="bg-gradient-to-br from-[#0D9488] to-[#0a7a73] rounded-xl p-8 text-white">
          <h3 class="text-xl font-semibold mb-2">Need Tutoring Help?</h3>
          <p class="text-sm text-white/80 mb-4">Create a new request and get matched with qualified tutors</p>
          <button class="px-4 py-2 bg-white text-[#0D9488] rounded-lg font-medium hover:bg-white/90 transition">
            Create Request →
          </button>
        </div>

        <!-- Achievements -->
        <div class="bg-white rounded-xl border border-[#e2e0db] p-8">
          <h3 class="text-lg font-semibold text-[#1a1a1a] mb-4">Achievements</h3>
          <div class="grid grid-cols-3 gap-4">
            <div class="text-center">
              <div class="text-3xl mb-1">🏆</div>
              <p class="text-xs text-[#9a8f82]">Power User</p>
            </div>
            <div class="text-center">
              <div class="text-3xl mb-1">⭐</div>
              <p class="text-xs text-[#9a8f82]">5-Star Rating</p>
            </div>
            <div class="text-center">
              <div class="text-3xl opacity-30 mb-1">🚀</div>
              <p class="text-xs text-[#9a8f82]">Locked</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>
</html>
