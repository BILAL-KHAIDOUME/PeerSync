<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tutoring Session - PeerSync</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .display { font-family: 'Fraunces', serif; }
    .video-container { background: #000; aspect-ratio: 16/9; border-radius: 12px; }
    .chat-message { animation: slideUp 0.3s ease; }
    @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  </style>
</head>
<body class="bg-[#1a1a1a] text-white">

  <!-- Header -->
  <header class="bg-[#0D9488] border-b border-[#0a7a73]">
    <div class="flex items-center justify-between px-6 py-3 max-w-7xl mx-auto">
      <div class="flex items-center gap-3">
        <a href="tutor_dashboard.php" class="p-2 hover:bg-white/10 rounded-lg transition">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
          </svg>
        </a>
        <span class="text-lg font-semibold">Mathematics - Algebra Session</span>
      </div>
      
      <div class="flex items-center gap-4">
        <div class="text-sm">
          <p class="text-white/70">Session Time</p>
          <p class="font-mono text-lg">45:32</p>
        </div>
        <button class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg transition font-medium">
          Leave Session
        </button>
      </div>
    </div>
  </header>

  <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-3 gap-6 min-h-screen">
    <!-- Main Video Area -->
    <div class="lg:col-span-2">
      <!-- Video Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <!-- Tutor Video -->
        <div class="bg-[#222] rounded-xl overflow-hidden border border-[#0D9488]">
          <div class="video-container flex items-center justify-center">
            <div class="text-center">
              <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#0D9488] to-[#0a7a73] mx-auto mb-4 flex items-center justify-center text-3xl">
                👩‍🏫
              </div>
              <p class="text-white font-semibold">Sarah Ahmed (Tutor)</p>
              <p class="text-white/50 text-sm">Camera on</p>
            </div>
          </div>
          <div class="bg-[#111] px-4 py-3 flex items-center gap-2">
            <span class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
            <span class="text-sm">Live</span>
          </div>
        </div>

        <!-- Student Video -->
        <div class="bg-[#222] rounded-xl overflow-hidden">
          <div class="video-container flex items-center justify-center">
            <div class="text-center">
              <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 mx-auto mb-4 flex items-center justify-center text-3xl">
                👨‍🎓
              </div>
              <p class="text-white font-semibold">John Doe (Student)</p>
              <p class="text-white/50 text-sm">Camera on</p>
            </div>
          </div>
          <div class="bg-[#111] px-4 py-3 flex items-center gap-2">
            <span class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
            <span class="text-sm">Live</span>
          </div>
        </div>
      </div>

      <!-- Whiteboard/Content Area -->
      <div class="bg-[#222] rounded-xl border border-[#0D9488] p-6 min-h-96">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold">Shared Whiteboard</h3>
          <div class="flex gap-2">
            <button class="p-2 bg-[#0D9488] hover:bg-[#0a7a73] rounded-lg transition">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/><path d="M20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
            </button>
            <button class="p-2 bg-[#0D9488] hover:bg-[#0a7a73] rounded-lg transition">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 4h12v12H6z"/><path d="M3 20h18"/></svg>
            </button>
          </div>
        </div>
        <div class="bg-white/5 rounded-lg h-80 flex items-center justify-center text-white/50">
          <p>Whiteboard content appears here</p>
        </div>
      </div>

      <!-- Session Controls -->
      <div class="flex gap-3 mt-6 justify-center">
        <button class="px-6 py-3 bg-red-600 hover:bg-red-700 rounded-lg font-medium transition flex items-center gap-2">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
          End Session
        </button>
        <button class="px-6 py-3 bg-[#0D9488] hover:bg-[#0a7a73] rounded-lg font-medium transition flex items-center gap-2">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M15 8.5H9v2h6V8.5zm3 6.5H6v2h12v-2z"/></svg>
          Mute Mic
        </button>
        <button class="px-6 py-3 bg-[#0D9488] hover:bg-[#0a7a73] rounded-lg font-medium transition flex items-center gap-2">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17 10.5V7c0 .55-.45 1-1 1H4c-.55 0-1-.45-1-1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
          Stop Camera
        </button>
      </div>
    </div>

    <!-- Chat & Info Sidebar -->
    <div class="lg:col-span-1">
      <!-- Tabs -->
      <div class="flex gap-2 mb-4 bg-[#222] p-2 rounded-lg">
        <button class="flex-1 px-4 py-2 bg-[#0D9488] text-white rounded-lg font-medium transition active">
          Chat
        </button>
        <button class="flex-1 px-4 py-2 bg-transparent text-white/70 hover:text-white rounded-lg font-medium transition">
          Info
        </button>
      </div>

      <!-- Chat Messages -->
      <div class="bg-[#222] rounded-xl p-4 h-96 flex flex-col border border-[#333]">
        <div class="flex-1 overflow-y-auto space-y-4 mb-4">
          <!-- Message 1 -->
          <div class="chat-message">
            <div class="flex items-end gap-2">
              <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#0D9488] to-[#0a7a73] flex items-center justify-center text-white text-xs font-semibold">
                SA
              </div>
              <div class="bg-[#0D9488] rounded-lg rounded-tl px-3 py-2 max-w-xs">
                <p class="text-sm">Let's start with the basics. Do you understand quadratic formulas?</p>
              </div>
            </div>
            <p class="text-xs text-white/40 ml-10 mt-1">2:45 PM</p>
          </div>

          <!-- Message 2 -->
          <div class="chat-message">
            <div class="flex items-end gap-2 flex-row-reverse">
              <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-semibold">
                JD
              </div>
              <div class="bg-white/10 rounded-lg rounded-tr px-3 py-2 max-w-xs">
                <p class="text-sm">Not really, can you explain?</p>
              </div>
            </div>
            <p class="text-xs text-white/40 mr-10 mt-1 text-right">2:46 PM</p>
          </div>

          <!-- Message 3 -->
          <div class="chat-message">
            <div class="flex items-end gap-2">
              <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#0D9488] to-[#0a7a73] flex items-center justify-center text-white text-xs font-semibold">
                SA
              </div>
              <div class="bg-[#0D9488] rounded-lg rounded-tl px-3 py-2 max-w-xs">
                <p class="text-sm">Sure! A quadratic equation has the form ax² + bx + c = 0</p>
              </div>
            </div>
            <p class="text-xs text-white/40 ml-10 mt-1">2:47 PM</p>
          </div>
        </div>

        <!-- Message Input -->
        <div class="flex gap-2">
          <input 
            type="text" 
            placeholder="Type a message..." 
            class="flex-1 bg-[#111] border border-[#333] rounded-lg px-3 py-2 text-sm text-white placeholder-white/40 focus:outline-none focus:border-[#0D9488]"
          />
          <button class="px-3 py-2 bg-[#0D9488] hover:bg-[#0a7a73] rounded-lg transition">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16.6915026,12.4744748 L3.50612381,13.2599618 C3.19218622,13.2599618 3.03521743,13.4170592 3.03521743,13.5741566 L1.15159189,20.0151496 C0.8376543,20.8006365 0.99,21.89 1.77946707,22.52 C2.41,22.99 3.50612381,23.1 4.13399899,22.8429026 L21.714504,14.0454487 C22.6563168,13.5741566 23.1272231,12.6315722 22.9702544,11.6889879 L4.13399899,1.16126654 C3.34915502,0.9041691 2.40734225,1.01511708 1.77946707,1.4863092 C0.994623095,2.11490069 0.837654326,3.20579788 1.15159189,3.99128471 L3.03521743,10.4322777 C3.03521743,10.5893751 3.19218622,10.7464725 3.50612381,10.7464725 L16.6915026,11.5319594 C16.6915026,11.5319594 17.1624089,11.5319594 17.1624089,12.0031515 C17.1624089,12.4744748 16.6915026,12.4744748 16.6915026,12.4744748 Z"/></svg>
          </button>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
