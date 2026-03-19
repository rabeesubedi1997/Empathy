@extends('layouts.parana')
@section('title', $patient->name)

@section('content')
<div class="p-8 space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between slide-in">
        <div>
            <a href="{{ route('patients.index') }}" class="text-gray-500 text-sm hover:text-amber-400 transition-colors">← Patients</a>
            <h1 class="font-display text-4xl font-bold text-white mt-2">{{ $patient->name }}</h1>
            <p class="text-gray-500 text-sm mt-1">Patient Profile · PARANA Empathy Detector</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('patients.edit', $patient->id) }}" class="px-4 py-2 rounded-xl text-xs font-medium transition-all hover:scale-105" style="background:rgba(245,158,11,0.12); color:#f59e0b; border:1px solid rgba(245,158,11,0.2);">Edit Patient</a>
            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-xl text-xs font-medium transition-all hover:scale-105" style="background:rgba(248,113,113,0.12); color:#f87171; border:1px solid rgba(248,113,113,0.2);" onclick="return confirm('Remove {{ $patient->name }} from PARANA?')">Remove</button>
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="p-4 rounded-xl" style="background:rgba(52,211,153,0.1); border:1px solid rgba(52,211,153,0.3)">
        <p class="text-emerald-400 text-sm">✓ {{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Patient Identity Card -->
        <div class="xl:col-span-1 space-y-4">
            <!-- Avatar + Identity -->
            <div class="glass rounded-2xl p-6 text-center fade-up">
                <div class="relative inline-flex items-center justify-center w-20 h-20 rounded-full mx-auto mb-4 breathe"
                    style="background: {{ $patient->empathy_color === 'amber' ? 'radial-gradient(circle, rgba(245,158,11,0.25), rgba(245,158,11,0.05))' : ($patient->empathy_color === 'blue' ? 'radial-gradient(circle, rgba(96,165,250,0.25), rgba(96,165,250,0.05))' : 'radial-gradient(circle, rgba(248,113,113,0.25), rgba(248,113,113,0.05))') }}; border: 2px solid {{ $patient->empathy_color === 'amber' ? 'rgba(245,158,11,0.5)' : ($patient->empathy_color === 'blue' ? 'rgba(96,165,250,0.5)' : 'rgba(248,113,113,0.5)') }};">
                    <span class="text-3xl font-bold {{ $patient->empathy_color === 'amber' ? 'text-amber-400' : ($patient->empathy_color === 'blue' ? 'text-blue-400' : 'text-red-400') }}">{{ $patient->initials }}</span>
                    <div class="pulse-ring absolute {{ $patient->empathy_color === 'amber' ? 'text-amber-400' : ($patient->empathy_color === 'blue' ? 'text-blue-400' : 'text-red-400') }}"></div>
                </div>
                <h2 class="text-white text-xl font-semibold">{{ $patient->name }}</h2>
                <p class="text-gray-500 text-sm mt-1">{{ $patient->age }} years · {{ $patient->sex }}</p>
                <p class="text-2xl mt-2" title="{{ $patient->mood_state }}">{{ $patient->mood_icon }}</p>
                <p class="text-gray-400 text-xs">{{ $patient->mood_state }}</p>

                <div class="mt-4 pt-4" style="border-top:1px solid rgba(255,255,255,0.06)">
                    <span class="text-xs px-3 py-1 rounded-full" style="background:rgba(245,158,11,0.1); color:#f59e0b; border:1px solid rgba(245,158,11,0.2);">🧠 PARANA Project</span>
                </div>
            </div>

            <!-- Contact -->
            <div class="glass rounded-2xl p-5 space-y-3 fade-up">
                <p class="text-gray-500 text-xs uppercase tracking-widest">Contact & Location</p>
                <div>
                    <p class="text-gray-600 text-xs">Address</p>
                    <p class="text-gray-300 text-sm leading-relaxed">{{ $patient->address }}</p>
                </div>
                @if($patient->email)
                <div>
                    <p class="text-gray-600 text-xs">Email</p>
                    <p class="text-gray-300 text-sm">{{ $patient->email }}</p>
                </div>
                @endif
                @if($patient->phone)
                <div>
                    <p class="text-gray-600 text-xs">Phone</p>
                    <p class="text-gray-300 text-sm">{{ $patient->phone }}</p>
                </div>
                @endif
            </div>

            <!-- Diagnosis -->
            @if($patient->diagnosis)
            <div class="glass rounded-2xl p-5 fade-up">
                <p class="text-gray-500 text-xs uppercase tracking-widest mb-2">Diagnosis</p>
                <p class="text-gray-300 text-sm leading-relaxed">{{ $patient->diagnosis }}</p>
            </div>
            @endif
        </div>

        <!-- Empathy Analysis -->
        <div class="xl:col-span-2 space-y-4">

            <!-- Score Visualization -->
            <div class="glass rounded-2xl p-6 fade-up">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-white font-semibold">Empathy Analysis</h3>
                        <p class="text-gray-500 text-xs mt-0.5">Real-time empathy assessment</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold"
                        style="background: {{ $patient->empathy_color === 'amber' ? 'rgba(245,158,11,0.15)' : ($patient->empathy_color === 'blue' ? 'rgba(96,165,250,0.15)' : 'rgba(248,113,113,0.15)') }}; color: {{ $patient->empathy_color === 'amber' ? '#f59e0b' : ($patient->empathy_color === 'blue' ? '#60a5fa' : '#f87171') }};">
                        {{ $patient->empathy_label }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-6 items-center">
                    <!-- Radial ring -->
                    <div class="flex justify-center">
                        <div class="relative">
                            <svg width="160" height="160" viewBox="0 0 160 160">
                                <circle cx="80" cy="80" r="65" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="12"/>
                                <circle cx="80" cy="80" r="65" fill="none"
                                    stroke="{{ $patient->empathy_color === 'amber' ? '#f59e0b' : ($patient->empathy_color === 'blue' ? '#60a5fa' : '#f87171') }}"
                                    stroke-width="12" stroke-linecap="round"
                                    stroke-dasharray="408"
                                    stroke-dashoffset="{{ 408 - (($patient->empathy_score / 100) * 408) }}"
                                    transform="rotate(-90 80 80)"
                                    style="filter: drop-shadow(0 0 8px {{ $patient->empathy_color === 'amber' ? 'rgba(245,158,11,0.6)' : ($patient->empathy_color === 'blue' ? 'rgba(96,165,250,0.6)' : 'rgba(248,113,113,0.6)') }})"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <p class="text-4xl font-bold {{ $patient->empathy_color === 'amber' ? 'text-amber-400' : ($patient->empathy_color === 'blue' ? 'text-blue-400' : 'text-red-400') }}">{{ $patient->empathy_score }}</p>
                                <p class="text-gray-500 text-xs">out of 100</p>
                            </div>
                        </div>
                    </div>

                    <!-- Score bar breakdown -->
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-500">Empathy Index</span>
                                <span class="{{ $patient->empathy_color === 'amber' ? 'text-amber-400' : ($patient->empathy_color === 'blue' ? 'text-blue-400' : 'text-red-400') }}">{{ $patient->empathy_score }}%</span>
                            </div>
                            <div class="h-2 rounded-full overflow-hidden" style="background:rgba(255,255,255,0.06)">
                                <div class="h-full rounded-full empathy-bar" data-width="{{ $patient->empathy_score }}"
                                    style="width:0%; background: {{ $patient->empathy_color === 'amber' ? 'linear-gradient(90deg,#f59e0b,#fbbf24)' : ($patient->empathy_color === 'blue' ? 'linear-gradient(90deg,#3b82f6,#60a5fa)' : 'linear-gradient(90deg,#ef4444,#f87171)') }}; box-shadow: 0 0 12px {{ $patient->empathy_color === 'amber' ? 'rgba(245,158,11,0.4)' : ($patient->empathy_color === 'blue' ? 'rgba(96,165,250,0.4)' : 'rgba(248,113,113,0.4)') }}"></div>
                            </div>
                        </div>
                        @php
                            $emotional = min(100, $patient->empathy_score + rand(-10,10));
                            $cognitive = min(100, $patient->empathy_score + rand(-15,15));
                            $affective = min(100, $patient->empathy_score + rand(-8,8));
                        @endphp
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-500">Emotional</span>
                                <span class="text-gray-400">{{ $emotional }}%</span>
                            </div>
                            <div class="h-1.5 rounded-full overflow-hidden" style="background:rgba(255,255,255,0.06)">
                                <div class="h-full rounded-full empathy-bar" data-width="{{ $emotional }}" style="width:0%; background: rgba(167,139,250,0.8);"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-500">Cognitive</span>
                                <span class="text-gray-400">{{ $cognitive }}%</span>
                            </div>
                            <div class="h-1.5 rounded-full overflow-hidden" style="background:rgba(255,255,255,0.06)">
                                <div class="h-full rounded-full empathy-bar" data-width="{{ $cognitive }}" style="width:0%; background: rgba(52,211,153,0.8);"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-500">Affective</span>
                                <span class="text-gray-400">{{ $affective }}%</span>
                            </div>
                            <div class="h-1.5 rounded-full overflow-hidden" style="background:rgba(255,255,255,0.06)">
                                <div class="h-full rounded-full empathy-bar" data-width="{{ $affective }}" style="width:0%; background: rgba(251,146,60,0.8);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empathy Trend Chart -->
            <div class="glass rounded-2xl p-6 fade-up">
                <h3 class="text-white font-semibold mb-1">Empathy Trend</h3>
                <p class="text-gray-500 text-xs mb-4">12-month empathy score trajectory</p>
                <canvas id="trendChart" height="120"></canvas>
            </div>

            <!-- Notes -->
            @if($patient->notes)
            <div class="glass rounded-2xl p-5 fade-up">
                <p class="text-gray-500 text-xs uppercase tracking-widest mb-3">Clinical Notes</p>
                <p class="text-gray-300 text-sm leading-relaxed">{{ $patient->notes }}</p>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Animate bars
    document.querySelectorAll('.empathy-bar').forEach(bar => {
        setTimeout(() => { bar.style.width = bar.dataset.width + '%'; }, 400);
    });

    // Trend chart
    const trend = @json(json_decode($patient->empathy_trend ?? '[]'));
    const labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    const color = '{{ $patient->empathy_color }}';
    const lineColor = color === 'amber' ? '#f59e0b' : (color === 'blue' ? '#60a5fa' : '#f87171');
    const fillColor = color === 'amber' ? 'rgba(245,158,11,0.1)' : (color === 'blue' ? 'rgba(96,165,250,0.1)' : 'rgba(248,113,113,0.1)');

    new Chart(document.getElementById('trendChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: labels.slice(0, trend.length),
            datasets: [{
                label: 'Empathy Score',
                data: trend,
                borderColor: lineColor,
                backgroundColor: fillColor,
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: lineColor,
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: ctx => 'Score: ' + ctx.raw } }
            },
            scales: {
                x: { grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: '#6b7280', font: { size: 10 } } },
                y: { min: 0, max: 100, grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: '#6b7280', font: { size: 10 } } }
            }
        }
    });
});
</script>
@endpush
