<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PeerSync - Peer Tutoring Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .display { font-family: 'Fraunces', serif; }
    .hero-gradient { background: linear-gradient(135deg, #0D9488 0%, #0a7a73 100%); }
    .feature-card { transition: transform 0.3s, box-shadow 0.3s; }
    .feature-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(13,148,136,0.15); }
  </style>
</head>
<body class="bg-white">

  <!-- Navigation -->
  <nav class="bg-white border-b border-[#e2e0db] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="20" cy="20" r="18" stroke="#0D9488" stroke-width="2"/>
          <path d="M14 16C14 13.79 15.79 12 18 12C19.66 12 21.05 12.87 21.71 14.12C22.89 13.52 24.27 13 26 13C30.42 13 34 16.58 34 21C34 22.66 33.59 24.23 32.88 25.6" stroke="#0D9488" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span class="display text-2xl font-light tracking-tight text-[#0D9488]">PeerSync</span>
      </div>
      
      <div class="flex items-center gap-6">
        <a href="#features" class="text-[#9a8f82] hover:text-[#1a1a1a] transition">Features</a>
        <a href="#about" class="text-[#9a8f82] hover:text-[#1a1a1a] transition">About</a>
        <a href="login.php" class="px-6 py-2 bg-[#0D9488] text-white rounded-lg font-medium hover:bg-[#0a7a73] transition">Sign In</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-gradient text-white py-20 px-6">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="display text-5xl font-light mb-6">Connect Students with Tutors</h1>
      <p class="text-xl text-white/80 mb-8">A peer-to-peer tutoring platform designed for the ENAA community. Learn, teach, and grow together.</p>
      
      <div class="flex gap-4 justify-center">
        <a href="register.php" class="px-8 py-3 bg-white text-[#0D9488] rounded-lg font-semibold hover:bg-white/90 transition">
          Get Started
        </a>
        <a href="login.php" class="px-8 py-3 bg-white/20 text-white border border-white/50 rounded-lg font-semibold hover:bg-white/30 transition">
          Sign In
        </a>
      </div>

      <!-- Hero Stats -->
      <div class="grid grid-cols-3 gap-8 mt-16">
        <div>
          <p class="text-3xl font-semibold">342</p>
          <p class="text-white/70">Active Users</p>
        </div>
        <div>
          <p class="text-3xl font-semibold">1.2K+</p>
          <p class="text-white/70">Hours Tutored</p>
        </div>
        <div>
          <p class="text-3xl font-semibold">4.8/5</p>
          <p class="text-white/70">Avg Rating</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-20 px-6 bg-[#f5f3ef]">
    <div class="max-w-6xl mx-auto">
      <h2 class="display text-4xl font-light text-center mb-4 text-[#1a1a1a]">Powerful Features</h2>
      <p class="text-center text-[#9a8f82] mb-16 max-w-2xl mx-auto">Everything you need to succeed in peer tutoring</p>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="feature-card bg-white rounded-xl p-8 border border-[#e2e0db]">
          <div class="text-4xl mb-4">📚</div>
          <h3 class="text-xl font-semibold text-[#1a1a1a] mb-3">Easy Requests</h3>
          <p class="text-[#9a8f82]">Students can create tutoring requests with detailed descriptions and preferred timing.</p>
        </div>

        <div class="feature-card bg-white rounded-xl p-8 border border-[#e2e0db]">
          <div class="text-4xl mb-4">🎯</div>
          <h3 class="text-xl font-semibold text-[#1a1a1a] mb-3">Smart Matching</h3>
          <p class="text-[#9a8f82]">Get matched with qualified tutors based on expertise, availability, and ratings.</p>
        </div>

        <div class="feature-card bg-white rounded-xl p-8 border border-[#e2e0db]">
          <div class="text-4xl mb-4">💬</div>
          <h3 class="text-xl font-semibold text-[#1a1a1a] mb-3">Real-time Chat</h3>
          <p class="text-[#9a8f82]">Communicate during sessions with integrated messaging and collaborative tools.</p>
        </div>

        <div class="feature-card bg-white rounded-xl p-8 border border-[#e2e0db]">
          <div class="text-4xl mb-4">⭐</div>
          <h3 class="text-xl font-semibold text-[#1a1a1a] mb-3">Ratings & Reviews</h3>
          <p class="text-[#9a8f82]">Build trust through honest reviews and ratings from other community members.</p>
        </div>

        <div class="feature-card bg-white rounded-xl p-8 border border-[#e2e0db]">
          <div class="text-4xl mb-4">🏆</div>
          <h3 class="text-xl font-semibold text-[#1a1a1a] mb-3">Gamification</h3>
          <p class="text-[#9a8f82]">Earn points and badges, climb the leaderboard, and get recognized for your contributions.</p>
        </div>

        <div class="feature-card bg-white rounded-xl p-8 border border-[#e2e0db]">
          <div class="text-4xl mb-4">📊</div>
          <h3 class="text-xl font-semibold text-[#1a1a1a] mb-3">Analytics</h3>
          <p class="text-[#9a8f82]">Track your progress, hours taught, earnings, and performance metrics.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="hero-gradient text-white py-16 px-6">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="display text-4xl font-light mb-4">Ready to Get Started?</h2>
      <p class="text-xl text-white/80 mb-8">Join the ENAA peer tutoring community today</p>
      
      <div class="flex gap-4 justify-center">
        <a href="register.php" class="px-8 py-3 bg-white text-[#0D9488] rounded-lg font-semibold hover:bg-white/90 transition">
          Create Account
        </a>
        <a href="login.php" class="px-8 py-3 bg-white/20 text-white border border-white/50 rounded-lg font-semibold hover:bg-white/30 transition">
          Sign In
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-[#f5f3ef] border-t border-[#e2e0db] py-12 px-6">
    <div class="max-w-6xl mx-auto text-center">
      <p class="text-sm text-[#9a8f82]">© 2024 PeerSync. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>


