@extends('layouts.parana')
@section('title', 'Patients')

@section('content')
<div class="p-8 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between slide-in">
        <div>
            <h1 class="font-display text-4xl font-bold text-white">Patient <em class="text-amber-400">Registry</em></h1>
            <p class="text-gray-500 text-sm mt-1">{{ $patients->total() }} patients registered in PARANA</p>
        </div>
        <a href="{{ route('patients.create') }}"
            class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:scale-105"
            style="background: linear-gradient(135deg, #f59e0b, #d97706); color: #0a0a0f; box-shadow: 0 4px 20px rgba(245,158,11,0.3);">
            + Register Patient
        </a>
    </div>

    @if(session('success'))
    <div class="p-4 rounded-xl fade-up" style="background:rgba(52,211,153,0.1); border:1px solid rgba(52,211,153,0.3)">
        <p class="text-emerald-400 text-sm">✓ {{ session('success') }}</p>
    </div>
    @endif

    <!-- Table -->
    <div class="glass rounded-2xl overflow-hidden">
        <table class="w-full">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <th class="px-6 py-4 text-left text-gray-500 text-xs uppercase tracking-widest">Patient</th>
                    <th class="px-4 py-4 text-left text-gray-500 text-xs uppercase tracking-widest">Age / Sex</th>
                    <th class="px-4 py-4 text-left text-gray-500 text-xs uppercase tracking-widest">Diagnosis</th>
                    <th class="px-4 py-4 text-left text-gray-500 text-xs uppercase tracking-widest">Mood</th>
                    <th class="px-4 py-4 text-left text-gray-500 text-xs uppercase tracking-widest">Empathy Score</th>
                    <th class="px-4 py-4 text-right text-gray-500 text-xs uppercase tracking-widest">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="divide-color: rgba(255,255,255,0.04)">
                @foreach($patients as $patient)
                <tr class="group hover:bg-white/[0.02] transition-colors duration-200">
                    <!-- Name / Avatar -->
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0"
                                style="background: {{ $patient->empathy_color === 'amber' ? 'rgba(245,158,11,0.15)' : ($patient->empathy_color === 'blue' ? 'rgba(96,165,250,0.15)' : 'rgba(248,113,113,0.15)') }}; border: 1px solid {{ $patient->empathy_color === 'amber' ? 'rgba(245,158,11,0.3)' : ($patient->empathy_color === 'blue' ? 'rgba(96,165,250,0.3)' : 'rgba(248,113,113,0.3)') }};">
                                <span class="{{ $patient->empathy_color === 'amber' ? 'text-amber-400' : ($patient->empathy_color === 'blue' ? 'text-blue-400' : 'text-red-400') }}">{{ $patient->initials }}</span>
                            </div>
                            <div>
                                <a href="{{ route('patients.show', $patient->id) }}" class="text-white text-sm font-medium hover:text-amber-400 transition-colors">{{ $patient->name }}</a>
                                <p class="text-gray-600 text-xs truncate max-w-[160px]">{{ Str::limit($patient->address, 30) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <p class="text-white text-sm">{{ $patient->age }}</p>
                        <p class="text-gray-500 text-xs">{{ $patient->sex }}</p>
                    </td>
                    <td class="px-4 py-4">
                        <p class="text-gray-300 text-xs max-w-[160px] leading-relaxed">{{ $patient->diagnosis ?? '—' }}</p>
                    </td>
                    <td class="px-4 py-4">
                        <span class="text-lg" title="{{ $patient->mood_state }}">{{ $patient->mood_icon }}</span>
                        <p class="text-gray-500 text-xs mt-0.5">{{ $patient->mood_state }}</p>
                    </td>
                    <!-- Empathy Score -->
                    <td class="px-4 py-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <div class="w-24 h-1.5 rounded-full overflow-hidden" style="background:rgba(255,255,255,0.06)">
                                    <div class="h-full rounded-full empathy-bar" data-width="{{ $patient->empathy_score }}"
                                        style="width:0%; background: {{ $patient->empathy_color === 'amber' ? 'linear-gradient(90deg,#f59e0b,#fbbf24)' : ($patient->empathy_color === 'blue' ? 'linear-gradient(90deg,#3b82f6,#60a5fa)' : 'linear-gradient(90deg,#ef4444,#f87171)') }};"></div>
                                </div>
                                <span class="{{ $patient->empathy_color === 'amber' ? 'text-amber-400' : ($patient->empathy_color === 'blue' ? 'text-blue-400' : 'text-red-400') }} text-sm font-semibold">{{ $patient->empathy_score }}</span>
                            </div>
                            <p class="text-gray-600 text-[10px]">{{ $patient->empathy_label }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('patients.show', $patient->id) }}" class="px-3 py-1.5 rounded-lg text-xs text-gray-400 hover:text-white transition-all" style="background:rgba(255,255,255,0.06);">View</a>
                            <a href="{{ route('patients.edit', $patient->id) }}" class="px-3 py-1.5 rounded-lg text-xs text-amber-400 hover:text-amber-300 transition-all" style="background:rgba(245,158,11,0.1);">Edit</a>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs text-red-400 hover:text-red-300 transition-all" style="background:rgba(248,113,113,0.1);" onclick="return confirm('Remove {{ $patient->name }} from the system?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $patients->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.empathy-bar').forEach(bar => {
    setTimeout(() => { bar.style.width = bar.dataset.width + '%'; }, 300);
});
</script>
@endpush
