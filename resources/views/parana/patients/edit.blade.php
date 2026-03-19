@extends('layouts.parana')
@section('title', 'Edit Patient')

@section('content')
<div class="p-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 slide-in">
            <a href="{{ route('patients.show', $patient->id) }}" class="text-gray-500 text-sm hover:text-amber-400 transition-colors">← Back to {{ $patient->name }}</a>
            <h1 class="font-display text-4xl font-bold text-white mt-3">Edit <em class="text-amber-400">Patient</em></h1>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl" style="background:rgba(52,211,153,0.1); border:1px solid rgba(52,211,153,0.3)">
            <p class="text-emerald-400 text-sm">✓ {{ session('success') }}</p>
        </div>
        @endif

        <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="glass rounded-2xl p-6">
                <h3 class="text-white text-sm font-semibold mb-4">👤 Personal Information</h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', $patient->name) }}"
                            class="w-full px-4 py-3 rounded-xl text-white outline-none transition-all"
                            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);" required>
                        @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Age *</label>
                            <input type="number" name="age" value="{{ old('age', $patient->age) }}" min="1" max="120"
                                class="w-full px-4 py-3 rounded-xl text-white outline-none transition-all"
                                style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);" required>
                        </div>
                        <div>
                            <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Sex *</label>
                            <select name="sex" class="w-full px-4 py-3 rounded-xl text-white outline-none"
                                style="background:rgba(30,30,40,0.9); border:1px solid rgba(255,255,255,0.08);" required>
                                @foreach(['Male','Female','Non-binary','Prefer not to say'] as $opt)
                                <option value="{{ $opt }}" {{ old('sex',$patient->sex)==$opt?'selected':'' }} class="bg-gray-900">{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Address *</label>
                        <textarea name="address" rows="2"
                            class="w-full px-4 py-3 rounded-xl text-white outline-none resize-none transition-all"
                            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);" required>{{ old('address', $patient->address) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="glass rounded-2xl p-6">
                <h3 class="text-white text-sm font-semibold mb-4">📞 Contact</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $patient->email) }}"
                            class="w-full px-4 py-3 rounded-xl text-white outline-none transition-all"
                            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">
                    </div>
                    <div>
                        <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $patient->phone) }}"
                            class="w-full px-4 py-3 rounded-xl text-white outline-none transition-all"
                            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">
                    </div>
                </div>
            </div>

            <div class="glass rounded-2xl p-6">
                <h3 class="text-white text-sm font-semibold mb-4">🧠 Clinical Assessment</h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Diagnosis</label>
                        <input type="text" name="diagnosis" value="{{ old('diagnosis', $patient->diagnosis) }}"
                            class="w-full px-4 py-3 rounded-xl text-white outline-none transition-all"
                            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Empathy Score <span class="text-amber-400" id="editScoreVal">{{ old('empathy_score', $patient->empathy_score) }}</span></label>
                            <input type="range" name="empathy_score" min="0" max="100" value="{{ old('empathy_score', $patient->empathy_score) }}"
                                class="w-full accent-amber-400" oninput="document.getElementById('editScoreVal').textContent=this.value">
                        </div>
                        <div>
                            <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Mood State</label>
                            <select name="mood_state" class="w-full px-4 py-3 rounded-xl text-white outline-none"
                                style="background:rgba(30,30,40,0.9); border:1px solid rgba(255,255,255,0.08);">
                                @foreach(['Neutral','Calm','Anxious','Joyful','Melancholic','Distressed'] as $mood)
                                <option value="{{ $mood }}" {{ old('mood_state',$patient->mood_state)==$mood?'selected':'' }} class="bg-gray-900">{{ $mood }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="text-gray-400 text-xs uppercase tracking-widest block mb-2">Clinical Notes</label>
                        <textarea name="notes" rows="3"
                            class="w-full px-4 py-3 rounded-xl text-white outline-none resize-none transition-all"
                            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">{{ old('notes', $patient->notes) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('patients.show', $patient->id) }}" class="flex-1 py-4 rounded-xl text-center text-sm text-gray-400 hover:text-white transition-all" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">Cancel</a>
                <button type="submit" class="flex-1 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-[1.02]" style="background:linear-gradient(135deg,#f59e0b,#d97706); color:#0a0a0f;">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
