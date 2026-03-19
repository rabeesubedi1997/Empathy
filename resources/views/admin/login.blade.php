<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARANA — Empathy Detector | Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap');
        * { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(251,191,36,0.3), 0 0 40px rgba(251,191,36,0.1); }
            50% { box-shadow: 0 0 40px rgba(251,191,36,0.6), 0 0 80px rgba(251,191,36,0.2); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes particle {
            0% { opacity: 0; transform: translateY(0) scale(0); }
            50% { opacity: 1; transform: translateY(-60px) scale(1); }
            100% { opacity: 0; transform: translateY(-120px) scale(0); }
        }
        .glow-amber { animation: pulse-glow 3s ease-in-out infinite; }
        .float-anim { animation: float 6s ease-in-out infinite; }
        .particle { animation: particle 4s ease-in-out infinite; }
        .particle:nth-child(2) { animation-delay: 0.8s; }
        .particle:nth-child(3) { animation-delay: 1.6s; }
        .particle:nth-child(4) { animation-delay: 2.4s; }
        .bg-cinematic {
            background: radial-gradient(ellipse at 30% 20%, rgba(120,53,15,0.4) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 80%, rgba(30,58,138,0.3) 0%, transparent 60%),
                        linear-gradient(135deg, #0a0a0f 0%, #0f0f1a 50%, #0a0a0f 100%);
        }
        .glass { background: rgba(255,255,255,0.04); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); }
    </style>
</head>
<body class="min-h-screen bg-cinematic flex items-center justify-center p-4 overflow-hidden">

    <!-- Floating particles -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="particle absolute w-2 h-2 rounded-full bg-amber-400 opacity-0" style="left:20%;top:80%;"></div>
        <div class="particle absolute w-1.5 h-1.5 rounded-full bg-amber-300 opacity-0" style="left:60%;top:85%;"></div>
        <div class="particle absolute w-1 h-1 rounded-full bg-blue-400 opacity-0" style="left:40%;top:75%;"></div>
        <div class="particle absolute w-2 h-2 rounded-full bg-amber-500 opacity-0" style="left:80%;top:88%;"></div>
    </div>

    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-10 float-anim">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full glow-amber mb-4" style="background: radial-gradient(circle, rgba(251,191,36,0.2) 0%, rgba(251,191,36,0.05) 100%); border: 1px solid rgba(251,191,36,0.4);">
                <span class="text-3xl">🧠</span>
            </div>
            <h1 class="font-display text-4xl font-bold text-white tracking-wide">PARANA</h1>
            <p class="text-amber-400 text-sm tracking-[0.3em] uppercase mt-1">Empathy Detector</p>
        </div>

        <!-- Login Card -->
        <div class="glass rounded-2xl p-8">
            <h2 class="text-white text-xl font-semibold mb-2">Welcome back</h2>
            <p class="text-gray-400 text-sm mb-8">Sign in to access the empathy dashboard</p>

            @if($errors->any())
                <div class="mb-6 p-4 rounded-lg" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3);">
                    <p class="text-red-400 text-sm">{{ $errors->first() }}</p>
                </div>
            @endif

            <form action="/admin/login" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-gray-400 text-xs uppercase tracking-widest mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', 'admin@parana.ai') }}"
                        class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-600 outline-none transition-all duration-300 focus:border-amber-400"
                        style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);"
                        placeholder="your@email.com" required>
                </div>
                <div>
                    <label class="block text-gray-400 text-xs uppercase tracking-widest mb-2">Password</label>
                    <input type="password" name="password" value="parana2024"
                        class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-600 outline-none transition-all duration-300 focus:border-amber-400"
                        style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);"
                        placeholder="••••••••" required>
                </div>
                <button type="submit"
                    class="w-full py-3.5 rounded-xl font-semibold text-sm tracking-widest uppercase transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]"
                    style="background: linear-gradient(135deg, #f59e0b, #d97706); color: #0a0a0f; box-shadow: 0 8px 32px rgba(245,158,11,0.3);">
                    Enter Dashboard
                </button>
            </form>

            <!-- Demo credentials -->
            <div class="mt-8 p-4 rounded-xl" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                <p class="text-gray-500 text-xs uppercase tracking-widest mb-3">Demo Credentials</p>
                <div class="space-y-2">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">admin@parana.ai</span>
                        <span class="text-amber-400 font-mono">parana2024</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">doctor@parana.ai</span>
                        <span class="text-amber-400 font-mono">doctor123</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">researcher@parana.ai</span>
                        <span class="text-amber-400 font-mono">research123</span>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-center text-gray-600 text-xs mt-6">© {{ date('Y') }} PARANA Empathy Detector. All rights reserved.</p>
    </div>
</body>
</html>
