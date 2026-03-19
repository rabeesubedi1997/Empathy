<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class ParanaController extends Controller
{
    public function dashboard()
    {
        $totalPatients   = Patient::count();
        $highEmpathy     = Patient::where('empathy_score', '>=', 75)->count();
        $moderateEmpathy = Patient::whereBetween('empathy_score', [40, 74])->count();
        $lowEmpathy      = Patient::where('empathy_score', '<', 40)->count();
        $avgScore        = round(Patient::avg('empathy_score') ?? 0, 1);
        $recentPatients  = Patient::orderBy('created_at', 'desc')->take(6)->get();

        return view('parana.dashboard', compact(
            'totalPatients',
            'highEmpathy',
            'moderateEmpathy',
            'lowEmpathy',
            'avgScore',
            'recentPatients'
        ));
    }

    public function patients()
    {
        $patients = Patient::orderBy('created_at', 'desc')->paginate(10);
        return view('parana.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('parana.patients.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'age'            => 'required|integer|min:1|max:120',
            'sex'            => 'required|in:Male,Female,Non-binary,Prefer not to say',
            'address'        => 'required|string|max:500',
            'email'          => 'nullable|email|max:255',
            'phone'          => 'nullable|string|max:30',
            'diagnosis'      => 'nullable|string|max:500',
            'empathy_score'  => 'nullable|integer|min:0|max:100',
            'mood_state'     => 'nullable|in:Calm,Anxious,Joyful,Melancholic,Neutral,Distressed',
            'notes'          => 'nullable|string',
        ]);

        $validated['empathy_score'] = $validated['empathy_score'] ?? rand(30, 95);
        $validated['empathy_trend'] = json_encode($this->generateTrend());

        Patient::create($validated);
        return redirect()->route('patients.index')->with('success', 'Patient registered successfully.');
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('parana.patients.show', compact('patient'));
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('parana.patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'age'            => 'required|integer|min:1|max:120',
            'sex'            => 'required|in:Male,Female,Non-binary,Prefer not to say',
            'address'        => 'required|string|max:500',
            'email'          => 'nullable|email|max:255',
            'phone'          => 'nullable|string|max:30',
            'diagnosis'      => 'nullable|string|max:500',
            'empathy_score'  => 'nullable|integer|min:0|max:100',
            'mood_state'     => 'nullable|in:Calm,Anxious,Joyful,Melancholic,Neutral,Distressed',
            'notes'          => 'nullable|string',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update($validated);
        return redirect()->route('patients.show', $id)->with('success', 'Patient updated successfully.');
    }

    public function destroy($id)
    {
        Patient::findOrFail($id)->delete();
        return redirect()->route('patients.index')->with('success', 'Patient removed from system.');
    }

    public function empathyData($id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json([
            'score'  => $patient->empathy_score,
            'trend'  => json_decode($patient->empathy_trend ?? '[]'),
            'mood'   => $patient->mood_state,
            'label'  => $this->scoreLabel($patient->empathy_score),
            'color'  => $this->scoreColor($patient->empathy_score),
        ]);
    }

    public function stats()
    {
        return response()->json([
            'total'    => Patient::count(),
            'high'     => Patient::where('empathy_score', '>=', 75)->count(),
            'moderate' => Patient::whereBetween('empathy_score', [40, 74])->count(),
            'low'      => Patient::where('empathy_score', '<', 40)->count(),
            'average'  => round(Patient::avg('empathy_score') ?? 0, 1),
        ]);
    }

    private function generateTrend(): array
    {
        $trend = [];
        $base  = rand(40, 80);
        for ($i = 0; $i < 12; $i++) {
            $base     += rand(-8, 10);
            $base      = max(10, min(100, $base));
            $trend[]   = $base;
        }
        return $trend;
    }

    private function scoreLabel(int $score): string
    {
        if ($score >= 75) return 'High Empathy';
        if ($score >= 40) return 'Moderate Empathy';
        return 'Low Empathy';
    }

    private function scoreColor(int $score): string
    {
        if ($score >= 75) return '#f59e0b';
        if ($score >= 40) return '#60a5fa';
        return '#f87171';
    }

    public function realtimeMetrics($id)
    {
        $patient = Patient::findOrFail($id);

        // Generate realistic heart rate wave data (simulate between 60-100 bpm)
        $heartRateWave = [];
        for ($i = 0; $i < 50; $i++) {
            $heartRateWave[] = 70 + sin($i * 0.3) * 15 + rand(-5, 5);
        }

        // Data transfer simulation (receive/send in MB)
        $dataTransfer = [
            'received' => rand(50, 500),
            'sent' => rand(30, 300),
            'nodes' => [
                ['name' => 'Cortex A', 'value' => rand(20, 100), 'color' => '#f59e0b'],
                ['name' => 'Cortex B', 'value' => rand(15, 80), 'color' => '#60a5fa'],
                ['name' => 'Thalamus', 'value' => rand(25, 90), 'color' => '#ec4899'],
                ['name' => 'Amygdala', 'value' => rand(30, 100), 'color' => '#8b5cf6'],
            ]
        ];

        // Real-time indicators
        $indicators = [
            ['label' => 'Empathy Wave', 'value' => $patient->empathy_score, 'unit' => '%', 'status' => $patient->empathy_score >= 75 ? 'high' : ($patient->empathy_score >= 40 ? 'moderate' : 'low')],
            ['label' => 'Neural Activity', 'value' => rand(60, 95), 'unit' => '%', 'status' => 'active'],
            ['label' => 'Cognitive Load', 'value' => rand(40, 80), 'unit' => '%', 'status' => 'processing'],
            ['label' => 'Emotional Stability', 'value' => rand(50, 95), 'unit' => '%', 'status' => 'stable'],
        ];

        // Timeline data (12 months of empathy trends)
        $timeline = [];
        $base = $patient->empathy_score;
        for ($i = 0; $i < 12; $i++) {
            $base += rand(-10, 15);
            $base = max(20, min(100, $base));
            $timeline[] = [
                'month' => date('M', strtotime("-" . (11 - $i) . " months")),
                'score' => $base,
                'patients' => rand(5, 25)
            ];
        }

        return response()->json([
            'patient' => [
                'id' => $patient->id,
                'name' => $patient->name,
                'age' => $patient->age,
                'sex' => $patient->sex,
                'address' => $patient->address,
                'mood' => $patient->mood_state,
                'empathy_score' => $patient->empathy_score,
                'diagnosis' => $patient->diagnosis,
            ],
            'heartRateWave' => $heartRateWave,
            'dataTransfer' => $dataTransfer,
            'indicators' => $indicators,
            'timeline' => $timeline,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
