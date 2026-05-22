<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Browse Tutoring Requests - PeerSync</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .display { font-family: 'Fraunces', serif; }
    .sidebar-active { background: rgba(13,148,136,0.1); border-left: 3px solid #0D9488; }
    .request-card { transition: all 0.2s; }
    .request-card:hover { border-color: #0D9488; box-shadow: 0 4px 12px rgba(13,148,136,0.1); }
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
        <a href="tutor_dashboard.php" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#7a6f64] hover:bg-[#f5f3ef] transition text-sm">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
          Dashboard
        </a>
        <a href="#" class="sidebar-active w-full flex items-center gap-3 px-4 py-3 rounded-lg text-[#0D9488] font-medium text-sm">
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
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 lg:p-8">
      <!-- Page Header -->
      <div class="flex items-center justify-between mb-8">
        <div>
          <h1 class="text-3xl font-semibold text-[#1a1a1a] mb-2">Browse Tutoring Requests</h1>
          <p class="text-[#9a8f82]">Find and accept requests that match your expertise</p>
        </div>
        <div class="text-right">
          <p class="text-sm text-[#9a8f82]">Available Requests</p>
          <p class="text-3xl font-semibold text-[#0D9488]">8</p>
        </div>
      </div>

      <!-- Filters -->
      <div class="bg-white rounded-xl border border-[#e2e0db] p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <div>
            <label class="block text-sm font-medium text-[#5a5046] mb-2 uppercase">Subject</label>
            <select class="w-full px-4 py-2 border border-[#e2e0db] rounded-lg text-[#1a1a1a] focus:outline-none focus:border-[#0D9488]">
              <option>All Subjects</option>
              <option>Mathematics</option>
              <option>Physics</option>
              <option>Chemistry</option>
              <option>Programming</option>
            </select>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-[#5a5046] mb-2 uppercase">Level</label>
            <select class="w-full px-4 py-2 border border-[#e2e0db] rounded-lg text-[#1a1a1a] focus:outline-none focus:border-[#0D9488]">
              <option>All Levels</option>
              <option>Beginner</option>
              <option>Intermediate</option>
              <option>Advanced</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-[#5a5046] mb-2 uppercase">Duration</label>
            <select class="w-full px-4 py-2 border border-[#e2e0db] rounded-lg text-[#1a1a1a] focus:outline-none focus:border-[#0D9488]">
              <option>Any Time</option>
              <option>&lt; 1 hour</option>
              <option>1-2 hours</option>
              <option>&gt; 2 hours</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-[#5a5046] mb-2 uppercase">Urgency</label>
            <select class="w-full px-4 py-2 border border-[#e2e0db] rounded-lg text-[#1a1a1a] focus:outline-none focus:border-[#0D9488]">
              <option>Any</option>
              <option>Urgent (Today)</option>
              <option>This Week</option>
              <option>Flexible</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Requests Grid -->
      <div class="space-y-4">
        <!-- Request Card 1 -->
        <div class="request-card bg-white rounded-xl border border-[#e2e0db] p-6 hover:shadow-lg">
          <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-semibold">
                  JD
                </div>
                <div>
                  <h3 class="font-semibold text-[#1a1a1a]">John Doe</h3>
                  <p class="text-xs text-[#9a8f82]">Student • Rating: 4.8/5</p>
                </div>
              </div>
              <h2 class="text-lg font-semibold text-[#1a1a1a] mb-2">Mathematics - Algebra</h2>
              <p class="text-[#9a8f82] mb-3">Need help with quadratic equations and polynomial solving. Exam coming up next week.</p>
              
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-medium">Mathematics</span>
                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs rounded-full font-medium">Intermediate</span>
                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs rounded-full font-medium">Urgent</span>
              </div>

              <div class="grid grid-cols-3 gap-4 text-sm">
                <div>
                  <p class="text-[#9a8f82]">Duration</p>
                  <p class="font-semibold text-[#1a1a1a]">2 hours</p>
                </div>
                <div>
                  <p class="text-[#9a8f82]">Preferred Rate</p>
                  <p class="font-semibold text-[#1a1a1a]">$15/hr</p>
                </div>
                <div>
                  <p class="text-[#9a8f82]">Available</p>
                  <p class="font-semibold text-[#0D9488]">Today at 3 PM</p>
                </div>
              </div>
            </div>
            
            <button class="px-6 py-3 bg-[#0D9488] text-white rounded-lg font-medium hover:bg-[#0a7a73] transition whitespace-nowrap ml-4">
              Accept Request
            </button>
          </div>
        </div>

        <!-- Request Card 2 -->
        <div class="request-card bg-white rounded-xl border border-[#e2e0db] p-6 hover:shadow-lg">
          <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white font-semibold">
                  EM
                </div>
                <div>
                  <h3 class="font-semibold text-[#1a1a1a]">Emma Martinez</h3>
                  <p class="text-xs text-[#9a8f82]">Student • Rating: 4.6/5</p>
                </div>
              </div>
              <h2 class="text-lg font-semibold text-[#1a1a1a] mb-2">Physics - Mechanics</h2>
              <p class="text-[#9a8f82] mb-3">Struggling with Newton's laws and force calculations. Need help understanding concepts before the midterm.</p>
              
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium">Physics</span>
                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs rounded-full font-medium">Advanced</span>
              </div>

              <div class="grid grid-cols-3 gap-4 text-sm">
                <div>
                  <p class="text-[#9a8f82]">Duration</p>
                  <p class="font-semibold text-[#1a1a1a]">1.5 hours</p>
                </div>
                <div>
                  <p class="text-[#9a8f82]">Preferred Rate</p>
                  <p class="font-semibold text-[#1a1a1a]">$18/hr</p>
                </div>
                <div>
                  <p class="text-[#9a8f82]">Available</p>
                  <p class="font-semibold text-[#0D9488]">Tomorrow 2-5 PM</p>
                </div>
              </div>
            </div>
            
            <button class="px-6 py-3 bg-[#0D9488] text-white rounded-lg font-medium hover:bg-[#0a7a73] transition whitespace-nowrap ml-4">
              Accept Request
            </button>
          </div>
        </div>

        <!-- Request Card 3 -->
        <div class="request-card bg-white rounded-xl border border-[#e2e0db] p-6 hover:shadow-lg">
          <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-semibold">
                  AH
                </div>
                <div>
                  <h3 class="font-semibold text-[#1a1a1a]">Ahmed Hassan</h3>
                  <p class="text-xs text-[#9a8f82]">Student • Rating: 4.9/5</p>
                </div>
              </div>
              <h2 class="text-lg font-semibold text-[#1a1a1a] mb-2">Programming - Python</h2>
              <p class="text-[#9a8f82] mb-3">Want to learn Python basics and data structures. Prefer someone patient and good at explaining complex concepts.</p>
              
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-3 py-1 bg-orange-100 text-orange-700 text-xs rounded-full font-medium">Programming</span>
                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full font-medium">Beginner</span>
              </div>

              <div class="grid grid-cols-3 gap-4 text-sm">
                <div>
                  <p class="text-[#9a8f82]">Duration</p>
                  <p class="font-semibold text-[#1a1a1a]">3 hours</p>
                </div>
                <div>
                  <p class="text-[#9a8f82]">Preferred Rate</p>
                  <p class="font-semibold text-[#1a1a1a]">$12/hr</p>
                </div>
                <div>
                  <p class="text-[#9a8f82]">Available</p>
                  <p class="font-semibold text-[#0D9488]">Flexible</p>
                </div>
              </div>
            </div>
            
            <button class="px-6 py-3 bg-[#0D9488] text-white rounded-lg font-medium hover:bg-[#0a7a73] transition whitespace-nowrap ml-4">
              Accept Request
            </button>
          </div>
        </div>

        <!-- Request Card 4 -->
        <div class="request-card bg-white rounded-xl border border-[#e2e0db] p-6 hover:shadow-lg">
          <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-semibold">
                  LJ
                </div>
                <div>
                  <h3 class="font-semibold text-[#1a1a1a]">Lisa Johnson</h3>
                  <p class="text-xs text-[#9a8f82]">Student • Rating: 4.7/5</p>
                </div>
              </div>
              <h2 class="text-lg font-semibold text-[#1a1a1a] mb-2">Chemistry - Organic</h2>
              <p class="text-[#9a8f82] mb-3">Preparing for organic chemistry exam. Need help with reaction mechanisms and synthesis problems.</p>
              
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-3 py-1 bg-pink-100 text-pink-700 text-xs rounded-full font-medium">Chemistry</span>
                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs rounded-full font-medium">Advanced</span>
              </div>

              <div class="grid grid-cols-3 gap-4 text-sm">
                <div>
                  <p class="text-[#9a8f82]">Duration</p>
                  <p class="font-semibold text-[#1a1a1a]">2 hours</p>
                </div>
                <div>
                  <p class="text-[#9a8f82]">Preferred Rate</p>
                  <p class="font-semibold text-[#1a1a1a]">$20/hr</p>
                </div>
                <div>
                  <p class="text-[#9a8f82]">Available</p>
                  <p class="font-semibold text-[#0D9488]">This Weekend</p>
                </div>
              </div>
            </div>
            
            <button class="px-6 py-3 bg-[#0D9488] text-white rounded-lg font-medium hover:bg-[#0a7a73] transition whitespace-nowrap ml-4">
              Accept Request
            </button>
          </div>
        </div>
      </div>

      <!-- Load More -->
      <div class="mt-8 text-center">
        <button class="px-8 py-3 border border-[#0D9488] text-[#0D9488] rounded-lg font-medium hover:bg-[#f5f3ef] transition">
          Load More Requests
        </button>
      </div>
    </main>
  </div>

</body>
</html>
