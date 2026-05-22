
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .display { font-family: 'Fraunces', serif; }
    .grain::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
      opacity: 0.5;
    }
    input:focus { outline: none; }
    .btn-primary {
      background: #1a1a1a;
      transition: background 0.2s, transform 0.1s;
    }
    .btn-primary:hover { background: #333; }
    .btn-primary:active { transform: scale(0.98); }
    .fade-in { animation: fadeIn 0.6s ease both; }
    .fade-in-delay { animation: fadeIn 0.6s ease 0.15s both; }
    .fade-in-delay-2 { animation: fadeIn 0.6s ease 0.3s both; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(12px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .input-field {
      border: 1px solid #e2e0db;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-field:focus {
      border-color: #1a1a1a;
      box-shadow: 0 0 0 3px rgba(26,26,26,0.08);
    }
    .divider-line {
      flex: 1;
      height: 1px;
      background: #e2e0db;
    }
    .social-btn {
      border: 1px solid #e2e0db;
      transition: background 0.15s, border-color 0.15s;
    }
    .social-btn:hover {
      background: #f7f6f4;
      border-color: #ccc;
    }
  </style>
</head>
<body class="grain min-h-screen bg-[#f5f3ef] flex items-center justify-center px-4 py-12">

  <div class="relative z-10 w-full max-w-sm">

    <!-- Wordmark -->
    <div class="fade-in text-center mb-10">
      <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3">
        <circle cx="20" cy="20" r="18" stroke="#0D9488" stroke-width="2"/>
        <path d="M14 16C14 13.79 15.79 12 18 12C19.66 12 21.05 12.87 21.71 14.12C22.89 13.52 24.27 13 26 13C30.42 13 34 16.58 34 21C34 22.66 33.59 24.23 32.88 25.6" stroke="#0D9488" stroke-width="2" stroke-linecap="round"/>
      </svg>
      <span class="display text-3xl font-light tracking-tight text-[#0D9488]">PeerSync</span>
    </div>

    <!-- Card -->
    <div class="fade-in-delay bg-white rounded-2xl px-8 pt-8 pb-9 shadow-[0_2px_24px_rgba(0,0,0,0.07)]">

      <h1 class="display text-[22px] font-semibold text-[#1a1a1a] mb-1">Welcome back</h1>
      <p class="text-sm text-[#9a8f82] mb-7 font-light">Sign in to your tutoring account</p>

      <!-- Social buttons -->
      <div class="flex gap-3 mb-6">
        <button class="social-btn flex-1 flex items-center justify-center gap-2 rounded-xl py-2.5 text-sm text-[#1a1a1a] font-medium cursor-pointer">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
          </svg>
          Google
        </button>
        <button class="social-btn flex-1 flex items-center justify-center gap-2 rounded-xl py-2.5 text-sm text-[#1a1a1a] font-medium cursor-pointer">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836a9.59 9.59 0 0 1 2.504.337c1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
          </svg>
          GitHub
        </button>
      </div>

      <!-- Divider -->
      <div class="flex items-center gap-3 mb-6">
        <span class="divider-line"></span>
        <span class="text-xs text-[#b5a99a] font-light tracking-wide">or continue with email</span>
        <span class="divider-line"></span>
      </div>

      <!-- Form -->
      <div class="space-y-4">
        <div>
          <label class="block text-xs font-medium text-[#5a5046] mb-1.5 tracking-wide uppercase" for="email">Email</label>
          <input
            id="email"
            type="email"
            placeholder="you@example.com"
            class="input-field w-full rounded-xl px-4 py-3 text-sm text-[#1a1a1a] placeholder-[#c5bdb4] bg-[#faf9f7]"
          />
        </div>
        <div>
          <div class="flex items-center justify-between mb-1.5">
            <label class="block text-xs font-medium text-[#5a5046] tracking-wide uppercase" for="password">Password</label>
            <a href="#" class="text-xs text-[#9a8f82] hover:text-[#1a1a1a] transition-colors">Forgot?</a>
          </div>
          <input
            id="password"
            type="password"
            placeholder="••••••••"
            class="input-field w-full rounded-xl px-4 py-3 text-sm text-[#1a1a1a] placeholder-[#c5bdb4] bg-[#faf9f7]"
          />
        </div>
      </div>

      <!-- Remember me -->
      <label class="flex items-center gap-2.5 mt-5 cursor-pointer group">
        <input type="checkbox" class="w-4 h-4 rounded accent-[#1a1a1a] cursor-pointer" />
        <span class="text-sm text-[#7a6f64] group-hover:text-[#1a1a1a] transition-colors font-light">Remember me for 30 days</span>
      </label>

      <!-- Submit -->
      <button class="btn-primary mt-6 w-full text-white rounded-xl py-3 text-sm font-medium tracking-wide cursor-pointer" onclick="handleLogin()">
        Sign in
      </button>

    </div>

    <!-- Footer -->
    <div class="fade-in-delay-2 text-center mt-6">
      <span class="text-sm text-[#9a8f82] font-light">Don't have an account? </span>
      <a href="register.php" class="text-sm text-[#0D9488] font-medium hover:underline underline-offset-2">Create one</a>
    </div>

  </div>

  <script>
    function handleLogin() {
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      // TODO: Connect to backend authentication
      console.log('Login attempt:', { email, password });
    }
  </script>

</body>
</html>


