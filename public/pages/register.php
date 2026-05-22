<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up - PeerSync</title>
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
      background: #0D9488;
      transition: background 0.2s, transform 0.1s;
    }
    .btn-primary:hover { background: #0a7a73; }
    .btn-primary:active { transform: scale(0.98); }
    .fade-in { animation: fadeIn 0.6s ease both; }
    .fade-in-delay { animation: fadeIn 0.6s ease 0.15s both; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(12px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .input-field {
      border: 1px solid #e2e0db;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-field:focus {
      border-color: #0D9488;
      box-shadow: 0 0 0 3px rgba(13,148,136,0.08);
    }
    .role-option {
      border: 2px solid #e2e0db;
      transition: border-color 0.2s, background 0.2s;
      cursor: pointer;
    }
    .role-option.selected {
      border-color: #0D9488;
      background: rgba(13,148,136,0.05);
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

      <h1 class="display text-[22px] font-semibold text-[#1a1a1a] mb-1">Create account</h1>
      <p class="text-sm text-[#9a8f82] mb-6 font-light">Join the peer tutoring community</p>

      <!-- Form -->
      <form class="space-y-4" onsubmit="handleSignup(event)">
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-xs font-medium text-[#5a5046] mb-1.5 tracking-wide uppercase">First Name</label>
            <input type="text" placeholder="John" required class="input-field w-full rounded-xl px-4 py-3 text-sm text-[#1a1a1a] placeholder-[#c5bdb4] bg-[#faf9f7]" />
          </div>
          <div>
            <label class="block text-xs font-medium text-[#5a5046] mb-1.5 tracking-wide uppercase">Last Name</label>
            <input type="text" placeholder="Doe" required class="input-field w-full rounded-xl px-4 py-3 text-sm text-[#1a1a1a] placeholder-[#c5bdb4] bg-[#faf9f7]" />
          </div>
        </div>

        <div>
          <label class="block text-xs font-medium text-[#5a5046] mb-1.5 tracking-wide uppercase">Email</label>
          <input type="email" placeholder="you@example.com" required class="input-field w-full rounded-xl px-4 py-3 text-sm text-[#1a1a1a] placeholder-[#c5bdb4] bg-[#faf9f7]" />
        </div>

        <div>
          <label class="block text-xs font-medium text-[#5a5046] mb-1.5 tracking-wide uppercase">Password</label>
          <input type="password" placeholder="••••••••" required class="input-field w-full rounded-xl px-4 py-3 text-sm text-[#1a1a1a] placeholder-[#c5bdb4] bg-[#faf9f7]" />
        </div>

        <div>
          <label class="block text-xs font-medium text-[#5a5046] mb-3 tracking-wide uppercase">I am a</label>
          <div class="flex gap-2">
            <button type="button" class="role-option flex-1 rounded-lg py-3 text-sm font-medium text-[#1a1a1a] transition-all" onclick="selectRole(this, 'student')">
              👨‍🎓 Student
            </button>
            <button type="button" class="role-option flex-1 rounded-lg py-3 text-sm font-medium text-[#1a1a1a] transition-all" onclick="selectRole(this, 'tutor')">
              👨‍🏫 Tutor
            </button>
          </div>
        </div>

        <label class="flex items-center gap-2.5 mt-5 cursor-pointer group">
          <input type="checkbox" required class="w-4 h-4 rounded accent-[#0D9488]" />
          <span class="text-sm text-[#7a6f64] group-hover:text-[#1a1a1a] transition-colors font-light">I agree to the <a href="#" class="text-[#0D9488] hover:underline">Terms & Privacy</a></span>
        </label>

        <button type="submit" class="btn-primary mt-6 w-full text-white rounded-xl py-3 text-sm font-medium tracking-wide cursor-pointer">
          Create Account
        </button>
      </form>

    </div>

    <!-- Footer -->
    <div class="fade-in-delay text-center mt-6">
      <span class="text-sm text-[#9a8f82] font-light">Already have an account? </span>
      <a href="login.php" class="text-sm text-[#0D9488] font-medium hover:underline underline-offset-2">Sign in</a>
    </div>

  </div>

  <script>
    let selectedRole = null;

    function selectRole(btn, role) {
      document.querySelectorAll('.role-option').forEach(b => b.classList.remove('selected'));
      btn.classList.add('selected');
      selectedRole = role;
    }

    async function handleSignup(event) {
      event.preventDefault();
      if (!selectedRole) {
        alert('Please select a role');
        return;
      }

      // Get form values
      const form = event.target;
      const firstName = form.querySelector('input[placeholder="John"]').value;
      const lastName = form.querySelector('input[placeholder="Doe"]').value;
      const email = form.querySelector('input[type="email"]').value;
      const password = form.querySelector('input[type="password"]').value;

      // Validate
      if (!firstName || !lastName || !email || !password) {
        alert('Please fill in all fields');
        return;
      }

      try {
        const response = await fetch('/api/auth/register', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            nom: lastName,
            prenom: firstName,
            email: email,
            password: password,
            role: selectedRole
          })
        });

        const result = await response.json();

        if (result.success) {
          alert('Registration successful! Redirecting to login...');
          setTimeout(() => {
            window.location.href = '/login.php';
          }, 1500);
        } else {
          alert('Registration failed: ' + result.message);
        }
      } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Check browser console for details.');
      }
    }
  </script>

</body>
</html>
