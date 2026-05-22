<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tutor Dashboard - PeerSync</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .display { font-family: 'Fraunces', serif; }
    .sidebar-active { background: rgba(13,148,136,0.1); border-left: 3px solid #0D9488; }
    .stat-card { background: linear-gradient(135deg, #f5f3ef 0%, #faf9f7 100%); }
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
            SA
          </div>
          <div class="hidden sm:block">
            <p class="text-sm font-medium text-[#1a1a1a]">Sarah Ahmed</p>
            <p class="text-xs text-[#9a8f82]">Tutor</p>
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
        <a href="tutor_browse_requests.php" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 21H3V3h9V1H3a2 2 0 0 0-2 2v18a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2v-9h-2v9z"/><circle cx="17" cy="7" r="4"/><path d="M21 7v6M18 10h6"/></svg>
          Browse Requests
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
          My Sessions
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm1-13h-2v6l5.25 3.15.75-1.23-4-2.42z"/></svg>
          Hours & Earnings
        </a>
        <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
          Leaderboard
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
          <p class="text-sm text-[#9a8f82] mb-2">Active Sessions</p>
          <p class="text-3xl font-semibold text-[#1a1a1a]">2</p>
          <p class="text-xs text-[#9a8f82] mt-2">Next session in 2h</p>
        </div>
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Total Sessions</p>
          <p class="text-3xl font-semibold text-[#1a1a1a]">48</p>
          <p class="text-xs text-[#9a8f82] mt-2">Avg rating: 4.9/5</p>
        </div>
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Hours This Month</p>
          <p class="text-3xl font-semibold text-[#1a1a1a]">36h</p>
          <p class="text-xs text-[#9a8f82] mt-2">+4h this week</p>
        </div>
        <div class="stat-card rounded-xl p-6 border border-[#e2e0db]">
          <p class="text-sm text-[#9a8f82] mb-2">Total Earnings</p>
          <p class="text-3xl font-semibold text-[#0D9488]">$540</p>
          <p class="text-xs text-[#9a8f82] mt-2">$15/hour average</p>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="tutor_browse_requests.php" class="bg-gradient-to-br from-[#0D9488] to-[#0a7a73] rounded-xl p-6 text-white hover:shadow-lg transition">
          <h3 class="text-lg font-semibold mb-1">Browse Requests</h3>
          <p class="text-sm text-white/80">5 new requests available</p>
        </a>
        
        <div class="bg-white rounded-xl border border-[#e2e0db] p-6">
          <h3 class="font-semibold text-[#1a1a1a] mb-3">Your Specialties</h3>
          <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-medium">Mathematics</span>
            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium">Physics</span>
            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs rounded-full font-medium">Programming</span>
          </div>
        </div>

        <div class="bg-white rounded-xl border border-[#e2e0db] p-6">
          <h3 class="font-semibold text-[#1a1a1a] mb-3">Next Session</h3>
          <p class="text-sm text-[#9a8f82] mb-1">Mathematics - Algebra</p>
          <p class="text-lg font-semibold text-[#0D9488]">Today • 3:00 PM</p>
        </div>
      </div>

      <!-- Recent Sessions -->
      <div class="bg-white rounded-xl border border-[#e2e0db] p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-lg font-semibold text-[#1a1a1a]">Recent Sessions</h2>
          <a href="#" class="text-sm text-[#0D9488] hover:text-[#0a7a73] font-medium">View All →</a>
        </div>

        <div class="space-y-4">
          <!-- Session Card 1 -->
          <div class="flex items-center justify-between p-4 border border-[#e2e0db] rounded-lg hover:bg-[#f5f3ef] transition">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-semibold">
                  JD
                </div>
                <div>
                  <h3 class="font-semibold text-[#1a1a1a]">John Doe</h3>
                  <p class="text-sm text-[#9a8f82]">Physics - Mechanics</p>
                </div>
              </div>
            </div>
            <div class="text-right">
              <p class="text-sm font-medium text-[#1a1a1a]">Today • 2:30 PM</p>
              <p class="text-xs text-[#0D9488]">Duration: 1.5h</p>
            </div>
          </div>

          <!-- Session Card 2 -->
          <div class="flex items-center justify-between p-4 border border-[#e2e0db] rounded-lg hover:bg-[#f5f3ef] transition">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white font-semibold">
                  EM
                </div>
                <div>
                  <h3 class="font-semibold text-[#1a1a1a]">Emma Martinez</h3>
                  <p class="text-sm text-[#9a8f82]">Mathematics - Calculus</p>
                </div>
              </div>
            </div>
            <div class="text-right">
              <p class="text-sm font-medium text-[#1a1a1a]">Yesterday • 4:00 PM</p>
              <p class="text-xs text-[#0D9488]">Duration: 2h</p>
            </div>
          </div>

          <!-- Session Card 3 -->
          <div class="flex items-center justify-between p-4 border border-[#e2e0db] rounded-lg hover:bg-[#f5f3ef] transition">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-semibold">
                  AH
                </div>
                <div>
                  <h3 class="font-semibold text-[#1a1a1a]">Ahmed Hassan</h3>
                  <p class="text-sm text-[#9a8f82]">Programming - Python</p>
                </div>
              </div>
            </div>
            <div class="text-right">
              <p class="text-sm font-medium text-[#1a1a1a]">Mon • 3:30 PM</p>
              <p class="text-xs text-[#0D9488]">Duration: 1h</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>
</html>
