@extends('layouts.parana')
@section('title', 'New Patient')

@section('content')
<div class="p-8">
    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <div class="mb-8 slide-in">
            <a href="{{ route('patients.index') }}" class="text-gray-500 text-sm hover:text-amber-400 transition-colors">← Back to Patients</a>
            <h1 class="font-display text-4xl font-bold text-white mt-3">Register <em class="text-amber-400">New Patient</em></h1>
            <p class="text-gray-500 text-sm mt-1">Patient details will preview in real-time as you type</p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-5 gap-6">

            <!-- Form -->
            <div class="xl:col-span-3">
                <form action="{{ route('patients.store') }}" method="POST" id="patientForm" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div class="glass rounded-2xl p-6">
                        <h3 class="text-white text-sm font-semibold mb-4 flex items-center gap-2"><span>👤</span> Personal Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Full Name *</label>
                                <input type="text" name="name" id="f_name" value="{{ old('name') }}" placeholder="e.g. Elena Vasquez"
                                    class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-600 outline-none transition-all"
                                    style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);"
                                    required oninput="previewUpdate()">
                                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Age *</label>
                                    <input type="number" name="age" id="f_age" value="{{ old('age') }}" placeholder="34" min="1" max="120"
                                        class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-600 outline-none transition-all"
                                        style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);"
                                        required oninput="previewUpdate()">
                                    @error('age')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Sex *</label>
                                    <select name="sex" id="f_sex"
                                        class="w-full px-4 py-3 rounded-xl text-white outline-none transition-all"
                                        style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);"
                                        required onchange="previewUpdate()">
                                        <option value="" class="bg-gray-900">Select</option>
                                        <option value="Male" class="bg-gray-900" {{ old('sex')=='Male'?'selected':'' }}>Male</option>
                                        <option value="Female" class="bg-gray-900" {{ old('sex')=='Female'?'selected':'' }}>Female</option>
                                        <option value="Non-binary" class="bg-gray-900" {{ old('sex')=='Non-binary'?'selected':'' }}>Non-binary</option>
                                        <option value="Prefer not to say" class="bg-gray-900" {{ old('sex')=='Prefer not to say'?'selected':'' }}>Prefer not to say</option>
                                    </select>
                                    @error('sex')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div>
                                <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Address *</label>
                                <textarea name="address" id="f_address" rows="2" placeholder="142 Marigold Lane, Buenos Aires, Argentina"
                                    class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-600 outline-none transition-all resize-none"
                                    style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);"
                                    required oninput="previewUpdate()">{{ old('address') }}</textarea>
                                @error('address')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="glass rounded-2xl p-6">
                        <h3 class="text-white text-sm font-semibold mb-4 flex items-center gap-2"><span>📞</span> Contact</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="patient@email.com"
                                    class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-600 outline-none transition-all"
                                    style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">
                            </div>
                            <div>
                                <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+1 555 000 0000"
                                    class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-600 outline-none transition-all"
                                    style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">
                            </div>
                        </div>
                    </div>

                    <!-- Clinical -->
                    <div class="glass rounded-2xl p-6">
                        <h3 class="text-white text-sm font-semibold mb-4 flex items-center gap-2"><span>🧠</span> Clinical Assessment</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Diagnosis</label>
                                <input type="text" name="diagnosis" value="{{ old('diagnosis') }}" placeholder="e.g. Generalized Anxiety Disorder"
                                    class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-600 outline-none transition-all"
                                    style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Empathy Score <span class="text-amber-400 ml-1" id="scoreVal">50</span></label>
                                    <input type="range" name="empathy_score" id="f_score" min="0" max="100" value="{{ old('empathy_score', 50) }}"
                                        class="w-full accent-amber-400" oninput="scoreUpdate(this.value); previewUpdate()">
                                    <div class="flex justify-between text-gray-600 text-xs mt-1">
                                        <span>Low</span><span>High</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Mood State</label>
                                    <select name="mood_state" id="f_mood"
                                        class="w-full px-4 py-3 rounded-xl text-white outline-none transition-all"
                                        style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);"
                                        onchange="previewUpdate()">
                                        <option value="Neutral" class="bg-gray-900">😐 Neutral</option>
                                        <option value="Calm" class="bg-gray-900">😌 Calm</option>
                                        <option value="Anxious" class="bg-gray-900">😰 Anxious</option>
                                        <option value="Joyful" class="bg-gray-900">😊 Joyful</option>
                                        <option value="Melancholic" class="bg-gray-900">😔 Melancholic</option>
                                        <option value="Distressed" class="bg-gray-900">😣 Distressed</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Clinical Notes</label>
                                <textarea name="notes" rows="3" placeholder="Observations, session notes..."
                                    class="w-full px-4 py-3 rounded-xl text-white placeholder-gray-600 outline-none transition-all resize-none"
                                    style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-4 rounded-xl font-semibold tracking-widest uppercase transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]"
                        style="background: linear-gradient(135deg,#f59e0b,#d97706); color:#0a0a0f; box-shadow:0 8px 32px rgba(245,158,11,0.3);">
                        Register Patient in PARANA
                    </button>
                </form>
            </div>

            <!-- Live Preview Panel -->
            <div class="xl:col-span-2">
                <div class="sticky top-6 space-y-4">
                    <p class="text-gray-500 text-xs uppercase tracking-widest">Live Preview</p>

                    <!-- Patient Card Preview -->
                    <div class="glass rounded-2xl p-6 fade-up">
                        <!-- Avatar -->
                        <div class="flex items-center gap-4 mb-6">
                            <div id="prev_avatar" class="w-16 h-16 rounded-full flex items-center justify-center text-xl font-bold flex-shrink-0 relative breathe"
                                style="background: radial-gradient(circle, rgba(245,158,11,0.2), rgba(245,158,11,0.05)); border: 2px solid rgba(245,158,11,0.4);">
                                <span id="prev_initials" class="text-amber-400">?</span>
                                <div class="pulse-ring text-amber-400 absolute"></div>
                            </div>
                            <div>
                                <h3 id="prev_name" class="text-white text-lg font-semibold">Patient Name</h3>
                                <p id="prev_meta" class="text-gray-500 text-sm">Age · Sex</p>
                                <p id="prev_mood" class="text-gray-400 text-sm mt-0.5">😐 Neutral</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-5">
                            <p class="text-gray-600 text-xs uppercase tracking-widest mb-1">Address</p>
                            <p id="prev_address" class="text-gray-300 text-sm leading-relaxed">—</p>
                        </div>

                        <!-- Empathy Visualization -->
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <p class="text-gray-500 text-xs uppercase tracking-widest">Empathy Score</p>
                                <div class="flex items-center gap-2">
                                    <span id="prev_label" class="text-xs text-amber-400">Moderate</span>
                                    <span id="prev_score" class="text-2xl font-bold text-amber-400">50</span>
                                </div>
                            </div>

                            <!-- Animated empathy bar -->
                            <div class="h-3 rounded-full overflow-hidden" style="background:rgba(255,255,255,0.06)">
                                <div id="prev_bar" class="h-full rounded-full empathy-bar" style="width:50%; background: linear-gradient(90deg,#f59e0b,#fbbf24);"></div>
                            </div>

                            <!-- Score rings visualization -->
                            <div class="flex justify-center py-4">
                                <div class="relative flex items-center justify-center">
                                    <svg width="120" height="120" viewBox="0 0 120 120">
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="8"/>
                                        <circle id="prev_ring" cx="60" cy="60" r="50" fill="none" stroke="#f59e0b" stroke-width="8"
                                            stroke-linecap="round"
                                            stroke-dasharray="314"
                                            stroke-dashoffset="157"
                                            transform="rotate(-90 60 60)"
                                            style="transition: stroke-dashoffset 1s cubic-bezier(0.34,1.56,0.64,1), stroke 0.5s ease;"/>
                                    </svg>
                                    <div class="absolute text-center">
                                        <p id="prev_ring_score" class="text-2xl font-bold text-amber-400">50</p>
                                        <p class="text-gray-500 text-[10px]">/ 100</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Project badge -->
                            <div class="flex items-center justify-center gap-2 pt-2">
                                <span class="text-xs px-3 py-1 rounded-full" style="background:rgba(245,158,11,0.1); border:1px solid rgba(245,158,11,0.2); color:#f59e0b;">🧠 PARANA Empathy Detector</span>
                            </div>
                        </div>
                    </div>

                    <!-- Empathy Trend Mini Chart -->
                    <div class="glass rounded-2xl p-4">
                        <p class="text-gray-500 text-xs uppercase tracking-widest mb-3">Simulated Trend</p>
                        <canvas id="trendChart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const moodIcons = { Calm:'😌', Anxious:'😰', Joyful:'😊', Melancholic:'😔', Neutral:'😐', Distressed:'😣' };

function getInitials(name) {
    const parts = name.trim().split(' ');
    let init = parts[0] ? parts[0][0].toUpperCase() : '?';
    if (parts[1]) init += parts[1][0].toUpperCase();
    return init;
}

function scoreLabel(s) {
    if (s >= 75) return 'High Empathy';
    if (s >= 40) return 'Moderate Empathy';
    return 'Low Empathy';
}

function scoreColor(s) {
    if (s >= 75) return { bar: 'linear-gradient(90deg,#f59e0b,#fbbf24)', ring: '#f59e0b', text: '#f59e0b' };
    if (s >= 40) return { bar: 'linear-gradient(90deg,#3b82f6,#60a5fa)', ring: '#60a5fa', text: '#60a5fa' };
    return { bar: 'linear-gradient(90deg,#ef4444,#f87171)', ring: '#f87171', text: '#f87171' };
}

function scoreUpdate(val) {
    document.getElementById('scoreVal').textContent = val;
}

function previewUpdate() {
    const name  = document.getElementById('f_name').value;
    const age   = document.getElementById('f_age').value;
    const sex   = document.getElementById('f_sex').value;
    const addr  = document.getElementById('f_address').value;
    const score = parseInt(document.getElementById('f_score').value);
    const mood  = document.getElementById('f_mood').value;
    const colors = scoreColor(score);

    document.getElementById('prev_name').textContent    = name || 'Patient Name';
    document.getElementById('prev_initials').textContent = name ? getInitials(name) : '?';
    document.getElementById('prev_meta').textContent    = (age ? age + ' yrs' : 'Age') + ' · ' + (sex || 'Sex');
    document.getElementById('prev_address').textContent  = addr || '—';
    document.getElementById('prev_mood').textContent    = (moodIcons[mood] || '😐') + ' ' + mood;
    document.getElementById('prev_score').textContent   = score;
    document.getElementById('prev_ring_score').textContent = score;
    document.getElementById('prev_label').textContent   = scoreLabel(score);

    // Colors
    document.getElementById('prev_score').style.color      = colors.text;
    document.getElementById('prev_ring_score').style.color = colors.text;
    document.getElementById('prev_label').style.color      = colors.text;
    document.getElementById('prev_bar').style.background   = colors.bar;
    document.getElementById('prev_bar').style.width        = score + '%';

    // Ring
    const circumference = 314;
    const offset = circumference - (score / 100) * circumference;
    const ring = document.getElementById('prev_ring');
    ring.style.strokeDashoffset = offset;
    ring.style.stroke = colors.ring;
}

// Trend chart
const trendCtx = document.getElementById('trendChart').getContext('2d');
const trendChart = new Chart(trendCtx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            data: [45,52,48,60,58,65,62,70,68,75,72,50],
            borderColor: '#f59e0b',
            backgroundColor: 'rgba(245,158,11,0.1)',
            borderWidth: 1.5,
            pointRadius: 0,
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { display: false },
            y: { display: false, min: 0, max: 100 }
        }
    }
});

// Init
previewUpdate();
</script>
@endpush
