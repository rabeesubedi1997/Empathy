<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PARANA') — Empathy Detector</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');
        *, body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #0a0a0f; }
        ::-webkit-scrollbar-thumb { background: rgba(245,158,11,0.4); border-radius: 2px; }

        .bg-app {
            background: radial-gradient(ellipse at 10% 0%, rgba(120,53,15,0.25) 0%, transparent 50%),
                        radial-gradient(ellipse at 90% 100%, rgba(30,58,138,0.2) 0%, transparent 50%),
                        #0a0a0f;
        }
        .glass { background: rgba(255,255,255,0.04); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.07); }
        .glass-hover:hover { background: rgba(255,255,255,0.07); }
        .sidebar-item { transition: all 0.2s ease; border-left: 2px solid transparent; }
        .sidebar-item:hover, .sidebar-item.active { border-left-color: #f59e0b; background: rgba(245,158,11,0.08); color: #f59e0b; }

        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            100% { transform: scale(2.5); opacity: 0; }
        }
        @keyframes breathe {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.05); opacity: 1; }
        }
        @keyframes slide-in {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        .pulse-ring::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 2px solid currentColor;
            animation: pulse-ring 2s cubic-bezier(0.455,0.03,0.515,0.955) infinite;
        }
        .breathe { animation: breathe 4s ease-in-out infinite; }
        .slide-in { animation: slide-in 0.4s ease forwards; }
        .fade-up { animation: fade-up 0.5s ease forwards; }
        .shimmer-text {
            background: linear-gradient(90deg, #f59e0b, #fde68a, #f59e0b);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite;
        }
        .empathy-bar {
            transition: width 1.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
    </style>
</head>
<body class="bg-app min-h-screen text-white">

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 flex-shrink-0 glass border-r border-white/5 flex flex-col" style="background: rgba(10,10,15,0.9);">
        <!-- Brand -->
        <div class="p-6 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="relative w-10 h-10 rounded-full flex items-center justify-center" style="background: radial-gradient(circle, rgba(251,191,36,0.2), rgba(251,191,36,0.05)); border: 1px solid rgba(251,191,36,0.4);">
                    <span class="text-lg">🧠</span>
                    <div class="pulse-ring relative text-amber-400"></div>
                </div>
                <div>
                    <h1 class="font-display text-lg font-bold text-white tracking-wide">PARANA</h1>
                    <p class="text-amber-400 text-[9px] tracking-[0.2em] uppercase">Empathy Detector</p>
                </div>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <p class="text-gray-600 text-[9px] uppercase tracking-widest px-3 mb-3">Navigation</p>
            <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 text-sm">
                <span>📊</span> Dashboard
            </a>
            <a href="{{ route('patients.index') }}" class="sidebar-item {{ request()->routeIs('patients.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 text-sm">
                <span>👤</span> Patients
            </a>
            <a href="{{ route('patients.create') }}" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 text-sm">
                <span>➕</span> New Patient
            </a>

            <div class="pt-4">
                <p class="text-gray-600 text-[9px] uppercase tracking-widest px-3 mb-3">System</p>
                <a href="#" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 text-sm">
                    <span>📈</span> Analytics
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 text-sm">
                    <span>⚙️</span> Settings
                </a>
            </div>
        </nav>

        <!-- User -->
        <div class="p-4 border-t border-white/5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: #0a0a0f;">
                    {{ strtoupper(substr(session('admin_user', 'A'), 0, 1)) }}
                </div>
                <div>
                    <p class="text-white text-xs font-medium">{{ ucfirst(session('admin_user', 'Admin')) }}</p>
                    <p class="text-gray-500 text-[10px]">{{ session('admin_email', '') }}</p>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left text-gray-500 text-xs px-3 py-2 rounded-lg hover:text-red-400 hover:bg-red-400/10 transition-all">
                    ← Sign out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
