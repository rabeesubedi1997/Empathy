@extends('layouts.parana')
@section('title', 'Dashboard')

@section('content')
<!-- BREADCRUMB -->
<div class="px-8 py-3" style="border-bottom:1px solid rgba(255,255,255,0.08);">
    <div class="flex items-center gap-2 text-xs text-gray-500 slide-in">
        <span class="text-gray-400">Dashboard</span>
    </div>
</div>

<div class="p-8 space-y-8">

    <!-- Header -->
    <div class="flex items-center justify-between slide-in">
        <div>
            <p class="text-amber-400 text-xs tracking-[0.3em] uppercase mb-1">Good {{ date('H') < 12 ? 'morning' : (date('H') < 18 ? 'afternoon' : 'evening') }}, {{ ucfirst(session('admin_user', 'Doctor')) }}</p>
            <h1 class="font-display text-4xl font-bold text-white">Empathy <em class="text-amber-400">Overview</em></h1>
            <p class="text-gray-500 text-sm mt-1">PARANA Empathy Detector — Real-time patient analysis</p>
        </div>
        <div class="text-right">
            <p class="text-white text-2xl font-bold shimmer-text">{{ $avgScore }}<span class="text-lg">/100</span></p>
            <p class="text-gray-500 text-xs">System Average Empathy Score</p>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">
        <!-- Total -->
        <div class="glass rounded-2xl p-6 card-hover fade-up" style="animation-delay:0.1s">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(255,255,255,0.06)">👥</div>
                <span class="text-gray-600 text-xs">Total</span>
            </div>
            <p class="text-3xl font-bold text-white">{{ $totalPatients }}</p>
            <p class="text-gray-500 text-sm mt-1">Registered Patients</p>
        </div>
        <!-- High Empathy -->
        <div class="glass rounded-2xl p-6 card-hover fade-up" style="animation-delay:0.2s">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(245,158,11,0.12)">💛</div>
                <span class="text-amber-400 text-xs">≥ 75</span>
            </div>
            <p class="text-3xl font-bold text-amber-400">{{ $highEmpathy }}</p>
            <p class="text-gray-500 text-sm mt-1">High Empathy</p>
        </div>
        <!-- Moderate -->
        <div class="glass rounded-2xl p-6 card-hover fade-up" style="animation-delay:0.3s">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(96,165,250,0.12)">💙</div>
                <span class="text-blue-400 text-xs">40–74</span>
            </div>
            <p class="text-3xl font-bold text-blue-400">{{ $moderateEmpathy }}</p>
            <p class="text-gray-500 text-sm mt-1">Moderate Empathy</p>
        </div>
        <!-- Low -->
        <div class="glass rounded-2xl p-6 card-hover fade-up" style="animation-delay:0.4s">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(248,113,113,0.12)">🔴</div>
                <span class="text-red-400 text-xs">&lt; 40</span>
            </div>
            <p class="text-3xl font-bold text-red-400">{{ $lowEmpathy }}</p>
            <p class="text-gray-500 text-sm mt-1">Low Empathy</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Empathy Distribution Chart -->
        <div class="xl:col-span-2 glass rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-white font-semibold">Empathy Distribution</h2>
                    <p class="text-gray-500 text-xs mt-0.5">Score spread across all patients</p>
                </div>
                <span class="text-amber-400 text-xs px-3 py-1 rounded-full" style="background:rgba(245,158,11,0.12)">Live</span>
            </div>
            <canvas id="distributionChart" height="160"></canvas>
        </div>

        <!-- Mood Breakdown -->
        <div class="glass rounded-2xl p-6 card-hover">
            <h2 class="text-white font-semibold mb-1">Mood States</h2>
            <p class="text-gray-500 text-xs mb-6">Current patient mood distribution</p>
            <canvas id="moodChart" height="180"></canvas>
        </div>
    </div>

    <!-- Recent Patients -->
    <div class="glass rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-white font-semibold">Recent Patients</h2>
                <p class="text-gray-500 text-xs mt-0.5">Latest additions to the system</p>
            </div>
            <a href="{{ route('patients.index') }}" class="text-amber-400 text-xs hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach($recentPatients as $patient)
            <a href="{{ route('patients.show', $patient->id) }}" class="glass glass-hover rounded-xl p-4 transition-all duration-300 card-hover block">
                <div class="flex items-center gap-3 mb-3">
                    <!-- Avatar -->
                    <div class="relative w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0"
                        style="background: {{ $patient->empathy_color === 'amber' ? 'linear-gradient(135deg,rgba(245,158,11,0.3),rgba(245,158,11,0.1))' : ($patient->empathy_color === 'blue' ? 'linear-gradient(135deg,rgba(96,165,250,0.3),rgba(96,165,250,0.1))' : 'linear-gradient(135deg,rgba(248,113,113,0.3),rgba(248,113,113,0.1))') }}; border: 1px solid {{ $patient->empathy_color === 'amber' ? 'rgba(245,158,11,0.4)' : ($patient->empathy_color === 'blue' ? 'rgba(96,165,250,0.4)' : 'rgba(248,113,113,0.4)') }};">
                        <span class="{{ $patient->empathy_color === 'amber' ? 'text-amber-400' : ($patient->empathy_color === 'blue' ? 'text-blue-400' : 'text-red-400') }}">{{ $patient->initials }}</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-white text-sm font-medium truncate">{{ $patient->name }}</p>
                        <p class="text-gray-500 text-xs">{{ $patient->age }} yrs · {{ $patient->sex }}</p>
                    </div>
                </div>
                <!-- Empathy bar -->
                <div class="space-y-1">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-500">{{ $patient->empathy_label }}</span>
                        <span class="{{ $patient->empathy_color === 'amber' ? 'text-amber-400' : ($patient->empathy_color === 'blue' ? 'text-blue-400' : 'text-red-400') }} font-medium">{{ $patient->empathy_score }}</span>
                    </div>
                    <div class="h-1.5 rounded-full overflow-hidden" style="background:rgba(255,255,255,0.06)">
                        <div class="h-full rounded-full empathy-bar" data-width="{{ $patient->empathy_score }}"
                            style="width:0%; background: {{ $patient->empathy_color === 'amber' ? 'linear-gradient(90deg,#f59e0b,#fbbf24)' : ($patient->empathy_color === 'blue' ? 'linear-gradient(90deg,#3b82f6,#60a5fa)' : 'linear-gradient(90deg,#ef4444,#f87171)') }};"></div>
                    </div>
                    <p class="text-gray-600 text-xs">{{ $patient->mood_icon }} {{ $patient->mood_state }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate empathy bars
        document.querySelectorAll('.empathy-bar').forEach(bar => {
            setTimeout(() => {
                bar.style.width = bar.dataset.width + '%';
            }, 300);
        });

        // Distribution Chart
        const distCtx = document.getElementById('distributionChart').getContext('2d');
        new Chart(distCtx, {
            type: 'bar',
            data: {
                labels: ['0-9', '10-19', '20-29', '30-39', '40-49', '50-59', '60-69', '70-79', '80-89', '90-100'],
                datasets: [{
                    label: 'Patients',
                    data: [0, 1, 1, 2, 2, 2, 1, 3, 3, 2],
                    backgroundColor: [
                        'rgba(248,113,113,0.5)', 'rgba(248,113,113,0.5)', 'rgba(248,113,113,0.5)', 'rgba(248,113,113,0.5)',
                        'rgba(96,165,250,0.5)', 'rgba(96,165,250,0.5)', 'rgba(96,165,250,0.5)',
                        'rgba(245,158,11,0.5)', 'rgba(245,158,11,0.6)', 'rgba(245,158,11,0.7)'
                    ],
                    borderColor: [
                        '#f87171', '#f87171', '#f87171', '#f87171',
                        '#60a5fa', '#60a5fa', '#60a5fa',
                        '#f59e0b', '#f59e0b', '#f59e0b'
                    ],
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255,255,255,0.04)'
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255,255,255,0.04)'
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 10
                            },
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Mood Chart
        const moodCtx = document.getElementById('moodChart').getContext('2d');
        new Chart(moodCtx, {
            type: 'doughnut',
            data: {
                labels: ['Calm', 'Anxious', 'Joyful', 'Melancholic', 'Neutral', 'Distressed'],
                datasets: [{
                    data: [4, 3, 4, 3, 2, 2],
                    backgroundColor: [
                        'rgba(245,158,11,0.7)', 'rgba(96,165,250,0.7)', 'rgba(52,211,153,0.7)',
                        'rgba(167,139,250,0.7)', 'rgba(156,163,175,0.7)', 'rgba(248,113,113,0.7)'
                    ],
                    borderColor: 'transparent',
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#9ca3af',
                            font: {
                                size: 10
                            },
                            padding: 12,
                            boxWidth: 10
                        }
                    }
                }
            }
        });
    });
</script>
@endpush