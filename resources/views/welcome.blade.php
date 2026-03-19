<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARANA — Empathy Detector</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap');
        *, body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .bg-cinematic {
            background: radial-gradient(ellipse at 20% 10%, rgba(120,53,15,0.35) 0%, transparent 55%),
                        radial-gradient(ellipse at 80% 90%, rgba(30,58,138,0.25) 0%, transparent 55%),
                        radial-gradient(ellipse at 50% 50%, rgba(15,15,30,1) 0%, #0a0a0f 100%);
        }
        @keyframes shimmer { 0%{background-position:-200% center} 100%{background-position:200% center} }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
        @keyframes fade-up { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
        @keyframes particle { 0%{opacity:0;transform:translateY(0) scale(0)} 50%{opacity:0.7;transform:translateY(-80px) scale(1)} 100%{opacity:0;transform:translateY(-160px) scale(0)} }
        .shimmer-text { background: linear-gradient(90deg,#f59e0b,#fde68a,#f59e0b); background-size:200%; -webkit-background-clip:text; -webkit-text-fill-color:transparent; animation: shimmer 4s linear infinite; }
        .float-anim { animation: float 7s ease-in-out infinite; }
        .fade-up { animation: fade-up 0.8s ease forwards; }
        .glass { background:rgba(255,255,255,0.04); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,0.07); }
        .particle { position:absolute; border-radius:50%; animation: particle 5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-cinematic min-h-screen text-white overflow-x-hidden">

    <!-- Particles -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="particle w-2 h-2 bg-amber-400" style="left:15%;top:85%;animation-delay:0s"></div>
        <div class="particle w-1 h-1 bg-amber-300" style="left:55%;top:90%;animation-delay:1.2s"></div>
        <div class="particle w-1.5 h-1.5 bg-blue-400" style="left:35%;top:80%;animation-delay:2.4s"></div>
        <div class="particle w-2 h-2 bg-amber-500" style="left:75%;top:88%;animation-delay:0.6s"></div>
        <div class="particle w-1 h-1 bg-purple-400" style="left:90%;top:75%;animation-delay:1.8s"></div>
    </div>

    <!-- Nav -->
    <nav class="fixed top-0 left-0 right-0 z-50 px-8 py-5 flex items-center justify-between" style="background:rgba(10,10,15,0.8); backdrop-filter:blur(20px); border-bottom:1px solid rgba(255,255,255,0.05);">
        <div class="flex items-center gap-3">
            <span class="text-2xl float-anim">🧠</span>
            <div>
                <span class="font-display text-xl font-bold text-white tracking-wide">PARANA</span>
                <span class="text-amber-400 text-[9px] block tracking-[0.25em] uppercase">Empathy Detector</span>
            </div>
        </div>
        <a href="{{ route('admin.login') }}" class="px-5 py-2 rounded-xl text-sm font-semibold transition-all hover:scale-105" style="background:linear-gradient(135deg,#f59e0b,#d97706); color:#0a0a0f;">Enter Dashboard</a>
    </nav>

    <!-- Hero -->
    <section class="min-h-screen flex items-center justify-center px-4 pt-20">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs mb-8 fade-up" style="background:rgba(245,158,11,0.1); border:1px solid rgba(245,158,11,0.2); color:#f59e0b; animation-delay:0.1s">
                🧠 AI-Powered Empathy Detection System
            </div>
            <h1 class="font-display text-6xl md:text-8xl font-bold leading-tight mb-6 fade-up" style="animation-delay:0.2s">
                Feel What<br><span class="shimmer-text italic">They Feel</span>
            </h1>
            <p class="text-gray-400 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed fade-up" style="animation-delay:0.3s">
                PARANA is a cinematic empathy analysis platform that translates human emotion into visual data — bridging the gap between patients and practitioners through real-time empathy visualization.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center fade-up" style="animation-delay:0.4s">
                <a href="{{ route('admin.login') }}" class="px-8 py-4 rounded-xl font-semibold text-sm tracking-widest uppercase transition-all hover:scale-105" style="background:linear-gradient(135deg,#f59e0b,#d97706); color:#0a0a0f; box-shadow:0 8px 40px rgba(245,158,11,0.35);">Launch Dashboard</a>
                <a href="{{ route('patients.create') }}" class="px-8 py-4 rounded-xl font-semibold text-sm tracking-widest uppercase transition-all hover:scale-105" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1);">Register Patient</a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-24 px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-display text-4xl font-bold text-white mb-4">Empathy as <em class="text-amber-400">Science</em></h2>
                <p class="text-gray-500">Advanced detection tools built for clinical precision and human warmth</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    ['🎯','Real-Time Scoring','Instantaneous empathy score calculation with animated cinematic visualization, updated dynamically as patient data is entered.'],
                    ['📊','Trend Analysis','Track empathy fluctuations over 12-month periods with smooth chart animations and color-coded intensity indicators.'],
                    ['🌈','Mood Detection','Multi-dimensional mood state classification — Calm, Anxious, Joyful, Melancholic, Distressed — with human-like visual cues.'],
                    ['👤','Patient Profiles','Comprehensive patient registry with name, age, sex, address, diagnosis, and empathy data stored and visualized cinematically.'],
                    ['🧬','Dimensional Analysis','Break down empathy into Emotional, Cognitive, and Affective dimensions with independent scoring and glow indicators.'],
                    ['✨','Cinematic Interface','Deep contrast dark UI with warm amber highlights, particle effects, glow animations, and glass morphism aesthetics.'],
                ] as [$icon,$title,$desc])
                <div class="glass rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="text-3xl mb-4">{{ $icon }}</div>
                    <h3 class="text-white font-semibold mb-2">{{ $title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 px-8">
        <div class="max-w-3xl mx-auto text-center glass rounded-3xl p-16">
            <div class="text-5xl mb-6 float-anim">🧠</div>
            <h2 class="font-display text-4xl font-bold text-white mb-4">Begin Your <em class="text-amber-400">Empathy Journey</em></h2>
            <p class="text-gray-500 mb-8">Join practitioners who use PARANA to deepen patient understanding and drive compassionate care.</p>
            <a href="{{ route('admin.login') }}" class="inline-block px-10 py-4 rounded-xl font-semibold tracking-widest uppercase transition-all hover:scale-105" style="background:linear-gradient(135deg,#f59e0b,#d97706); color:#0a0a0f; box-shadow:0 8px 40px rgba(245,158,11,0.35);">Enter PARANA</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t py-12 px-8" style="border-color:rgba(255,255,255,0.05); background:rgba(10,10,15,0.8);">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span>🧠</span>
                    <span class="font-display font-bold text-white">PARANA</span>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">An AI-powered empathy detection and visualization platform for mental health practitioners.</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-widest mb-4">Platform</p>
                <div class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="block text-gray-600 text-sm hover:text-amber-400 transition-colors">Dashboard</a>
                    <a href="{{ route('patients.index') }}" class="block text-gray-600 text-sm hover:text-amber-400 transition-colors">Patients</a>
                    <a href="{{ route('patients.create') }}" class="block text-gray-600 text-sm hover:text-amber-400 transition-colors">Register Patient</a>
                </div>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-widest mb-4">Features</p>
                <div class="space-y-2">
                    <span class="block text-gray-600 text-sm">Empathy Scoring</span>
                    <span class="block text-gray-600 text-sm">Mood Detection</span>
                    <span class="block text-gray-600 text-sm">Trend Analysis</span>
                    <span class="block text-gray-600 text-sm">Dimensional Breakdown</span>
                </div>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-widest mb-4">Access</p>
                <div class="space-y-2">
                    <a href="{{ route('admin.login') }}" class="block text-gray-600 text-sm hover:text-amber-400 transition-colors">Sign In</a>
                    <span class="block text-gray-600 text-sm">admin@parana.ai</span>
                    <span class="block text-gray-500 text-xs font-mono">parana2024</span>
                </div>
            </div>
        </div>
        <div class="border-t pt-6 text-center" style="border-color:rgba(255,255,255,0.05);">
            <p class="text-gray-600 text-sm">© {{ date('Y') }} PARANA Empathy Detector. All rights reserved.</p>
            <p class="text-gray-700 text-xs mt-1">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:text-amber-400 transition-colors">LaraCopilot</a></p>
        </div>
    </footer>

</body>
</html>
