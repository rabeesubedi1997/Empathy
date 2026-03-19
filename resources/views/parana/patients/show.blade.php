@extends('layouts.parana')
@section('title', $patient->name)

@section('content')

<style>
  /* ============================================
   SCI-FI PATIENT MONITOR — CINEMATIC ENGINE
   ============================================ */

  @keyframes ecg-scroll {
    0% {
      stroke-dashoffset: 1200;
    }

    100% {
      stroke-dashoffset: 0;
    }
  }

  @keyframes ecg-loop {
    0% {
      transform: translateX(0);
    }

    100% {
      transform: translateX(-50%);
    }
  }

  @keyframes pulse-beat {

    0%,
    100% {
      transform: scale(1);
      opacity: 1;
    }

    15% {
      transform: scale(1.18);
      opacity: 1;
    }

    30% {
      transform: scale(0.95);
      opacity: 0.8;
    }

    45% {
      transform: scale(1.08);
      opacity: 1;
    }
  }

  @keyframes scanline {
    0% {
      top: -4px;
    }

    100% {
      top: 100%;
    }
  }

  @keyframes data-flow {
    0% {
      transform: translateY(-100%);
      opacity: 0;
    }

    20% {
      opacity: 1;
    }

    80% {
      opacity: 1;
    }

    100% {
      transform: translateY(100vh);
      opacity: 0;
    }
  }

  @keyframes blink-cursor {

    0%,
    100% {
      opacity: 1;
    }

    50% {
      opacity: 0;
    }
  }

  @keyframes glow-pulse {

    0%,
    100% {
      box-shadow: 0 0 8px currentColor, 0 0 20px currentColor, 0 0 40px currentColor;
    }

    50% {
      box-shadow: 0 0 16px currentColor, 0 0 40px currentColor, 0 0 80px currentColor;
    }
  }

  @keyframes ring-rotate {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  @keyframes ring-counter {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(-360deg);
    }
  }

  @keyframes neural-dash {
    to {
      stroke-dashoffset: -20;
    }
  }

  @keyframes float-y {

    0%,
    100% {
      transform: translateY(0px);
    }

    50% {
      transform: translateY(-6px);
    }
  }

  @keyframes radar-sweep {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  @keyframes signal-wave {
    0% {
      transform: scaleY(0.3);
      opacity: 0.3;
    }

    50% {
      transform: scaleY(1);
      opacity: 1;
    }

    100% {
      transform: scaleY(0.3);
      opacity: 0.3;
    }
  }

  @keyframes matrix-fall {
    0% {
      top: -20px;
      opacity: 0.8;
    }

    100% {
      top: 100%;
      opacity: 0;
    }
  }

  @keyframes holo-flicker {

    0%,
    98%,
    100% {
      opacity: 1;
    }

    99% {
      opacity: 0.6;
    }
  }

  @keyframes counter-up {
    from {
      opacity: 0;
      transform: translateY(10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes arc-fill {
    from {
      stroke-dashoffset: var(--arc-total);
    }

    to {
      stroke-dashoffset: var(--arc-offset);
    }
  }

  .scanline-overlay::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(251, 191, 36, 0.15), transparent);
    animation: scanline 4s linear infinite;
    pointer-events: none;
    z-index: 10;
  }

  .holo-flicker {
    animation: holo-flicker 8s ease-in-out infinite;
  }

  .float-y {
    animation: float-y 5s ease-in-out infinite;
  }

  .ecg-line {
    stroke-dasharray: 1200;
    stroke-dashoffset: 1200;
    animation: ecg-scroll 3s linear infinite;
  }

  .glow-green {
    color: #00ff9f;
    animation: glow-pulse 2s ease-in-out infinite;
  }

  .glow-amber {
    color: #f59e0b;
    animation: glow-pulse 2s ease-in-out infinite;
  }

  .glow-blue {
    color: #38bdf8;
    animation: glow-pulse 2.5s ease-in-out infinite;
  }

  .glow-red {
    color: #f87171;
    animation: glow-pulse 1.8s ease-in-out infinite;
  }

  .panel {
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.07);
    border-radius: 16px;
    position: relative;
    overflow: hidden;
  }

  .panel-amber {
    border-color: rgba(245, 158, 11, 0.35);
  }

  .panel-green {
    border-color: rgba(0, 255, 159, 0.25);
  }

  .panel-blue {
    border-color: rgba(56, 189, 248, 0.25);
  }

  .panel-red {
    border-color: rgba(248, 113, 113, 0.25);
  }

  .panel-header {
    font-size: 9px;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    font-weight: 600;
  }

  /* Signal bars */
  .sig-bar {
    display: inline-block;
    width: 3px;
    border-radius: 2px;
    animation: signal-wave var(--dur, 1s) ease-in-out infinite;
    animation-delay: var(--delay, 0s);
  }

  /* Data stream */
  .data-stream-col {
    position: absolute;
    top: 0;
    font-size: 10px;
    font-family: 'Courier New', monospace;
    color: rgba(0, 255, 159, 0.5);
    line-height: 1.4;
    animation: data-flow var(--spd, 6s) linear infinite;
    animation-delay: var(--dl, 0s);
    white-space: nowrap;
  }

  /* Neural network lines */
  .neural-line {
    stroke-dasharray: 6 4;
    animation: neural-dash 1s linear infinite;
  }

  /* Radar */
  .radar-sweep {
    transform-origin: 60px 60px;
    animation: radar-sweep 3s linear infinite;
  }

  /* Matrix rain */
  .matrix-char {
    position: absolute;
    font-family: 'Courier New', monospace;
    font-size: 10px;
    animation: matrix-fall var(--spd, 3s) linear infinite;
    animation-delay: var(--dl, 0s);
    color: rgba(0, 255, 159, 0.6);
    pointer-events: none;
  }

  /* ECG running track */
  .ecg-track-wrap {
    overflow: hidden;
    position: relative;
  }

  .ecg-track {
    display: flex;
    animation: ecg-loop 4s linear infinite;
    width: 200%;
  }

  /* Blinking cursor */
  .blink {
    animation: blink-cursor 1s step-end infinite;
  }

  /* Ring spinner */
  .ring-outer {
    animation: ring-rotate 6s linear infinite;
    transform-origin: center;
  }

  .ring-inner {
    animation: ring-counter 4s linear infinite;
    transform-origin: center;
  }

  .btn-sci {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 18px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
    outline: none;
  }

  .btn-sci:hover {
    transform: scale(1.04);
  }
</style>

<!-- ============================================================
     MAIN SHELL
     ============================================================ -->
<div class="min-h-screen" style="background: radial-gradient(ellipse at 20% 10%, rgba(0,80,40,0.18) 0%, transparent 50%), radial-gradient(ellipse at 80% 90%, rgba(30,58,138,0.18) 0%, transparent 50%), #050508;">

  <!-- BREADCRUMB -->
  <div class="px-6 py-2" style="background:rgba(0,0,0,0.5); border-bottom:1px solid rgba(255,255,255,0.08);">
    <div class="flex items-center gap-2 text-xs text-gray-500">
      <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-amber-400 transition-colors">Dashboard</a>
      <span class="text-gray-600">/</span>
      <a href="{{ route('patients.index') }}" class="text-gray-500 hover:text-amber-400 transition-colors">Patients</a>
      <span class="text-gray-600">/</span>
      <span class="text-gray-400">{{ $patient->name }}</span>
    </div>
  </div>

  <!-- TOP BAR -->
  <div class="px-6 py-3 flex items-center justify-between" style="background:rgba(0,0,0,0.7); border-bottom:1px solid rgba(0,255,159,0.12);">
    <div class="flex items-center gap-4">
      <a href="{{ route('patients.index') }}" class="text-gray-600 hover:text-green-400 transition-colors text-xs tracking-widest">← REGISTRY</a>
      <span class="text-gray-700">|</span>
      <span class="text-green-400 text-xs tracking-widest">PARANA // PATIENT MONITOR</span>
      <span class="text-gray-700">|</span>
      <span class="text-gray-500 text-xs" id="live-clock"></span>
    </div>
    <div class="flex items-center gap-3">
      <!-- Live indicator -->
      <div class="flex items-center gap-2">
        <div class="w-2 h-2 rounded-full bg-green-400 glow-green" style="animation: glow-pulse 1s ease-in-out infinite;"></div>
        <span class="text-green-400 text-[10px] tracking-widest">LIVE MONITORING</span>
      </div>
      <a href="{{ route('patients.edit', $patient->id) }}" class="btn-sci" style="background:rgba(245,158,11,0.12); color:#f59e0b; border:1px solid rgba(245,158,11,0.3);">✎ EDIT</a>
      <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="inline">
        @csrf @method('DELETE')
        <button class="btn-sci" style="background:rgba(248,113,113,0.1); color:#f87171; border:1px solid rgba(248,113,113,0.25);" onclick="return confirm('Remove {{ addslashes($patient->name) }} from PARANA?')">✕ REMOVE</button>
      </form>
    </div>
  </div>

  <!-- PATIENT HEADER STRIP -->
  <div class="px-6 py-4 flex items-center gap-6" style="background:rgba(0,0,0,0.4); border-bottom:1px solid rgba(255,255,255,0.04);">
    <!-- Avatar -->
    <div class="relative flex-shrink-0">
      <div class="w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold float-y"
        style="background: radial-gradient(circle, rgba(0,255,159,0.18), rgba(0,255,159,0.03)); border:2px solid rgba(0,255,159,0.5); box-shadow:0 0 20px rgba(0,255,159,0.3), inset 0 0 20px rgba(0,255,159,0.05); color:#00ff9f;">
        {{ $patient->initials }}
      </div>
      <!-- Rotating ring -->
      <svg class="absolute -inset-2" width="80" height="80" viewBox="0 0 80 80" style="pointer-events:none">
        <circle class="ring-outer" cx="40" cy="40" r="37" fill="none" stroke="rgba(0,255,159,0.25)" stroke-width="1" stroke-dasharray="4 8" />
        <circle class="ring-inner" cx="40" cy="40" r="32" fill="none" stroke="rgba(245,158,11,0.2)" stroke-width="1" stroke-dasharray="2 12" />
      </svg>
    </div>

    <!-- Identity -->
    <div class="flex-1">
      <div class="flex items-baseline gap-3">
        <h1 class="text-white text-2xl font-bold tracking-wide">{{ strtoupper($patient->name) }}</h1>
        <span class="text-green-400 text-[10px] tracking-widest border border-green-400/30 px-2 py-0.5 rounded">ACTIVE</span>
        <span class="text-[10px] tracking-widest px-2 py-0.5 rounded"
          style="@if($patient->empathy_score >= 75) background:rgba(245,158,11,0.15); color:#f59e0b; border:1px solid rgba(245,158,11,0.3); @elseif($patient->empathy_score >= 40) background:rgba(56,189,248,0.15); color:#38bdf8; border:1px solid rgba(56,189,248,0.3); @else background:rgba(248,113,113,0.15); color:#f87171; border:1px solid rgba(248,113,113,0.3); @endif">
          {{ strtoupper($patient->empathy_label) }}
        </span>
      </div>
      <div class="flex items-center gap-6 mt-1">
        <span class="text-gray-500 text-xs">ID #{{ str_pad($patient->id, 6, '0', STR_PAD_LEFT) }}</span>
        <span class="text-gray-500 text-xs">{{ $patient->age }}Y / {{ strtoupper($patient->sex) }}</span>
        <span class="text-gray-500 text-xs">{{ $patient->mood_icon }} {{ strtoupper($patient->mood_state ?? 'NEUTRAL') }}</span>
        @if($patient->diagnosis)
        <span class="text-gray-500 text-xs truncate max-w-xs">DX: {{ $patient->diagnosis }}</span>
        @endif
      </div>
      <div class="flex items-center gap-6 mt-1">
        <span class="text-gray-600 text-[10px]">📍 {{ Str::limit($patient->address, 50) }}</span>
        @if($patient->email)<span class="text-gray-600 text-[10px]">✉ {{ $patient->email }}</span>@endif
      </div>
    </div>

    <!-- Big Score -->
    <div class="text-right flex-shrink-0">
      <div class="text-6xl font-bold @if($patient->empathy_score >= 75) text-amber-400 @elseif($patient->empathy_score >= 40) text-sky-400 @else text-red-400 @endif" id="main-score" style="font-variant-numeric: tabular-nums; text-shadow:0 0 30px currentColor;">{{ $patient->empathy_score }}</div>
      <div class="text-gray-500 text-[10px] tracking-widest">EMPATHY INDEX</div>
    </div>
  </div>

  <!-- ============================================================
       MAIN GRID
       ============================================================ -->
  <div class="p-4 grid grid-cols-12 gap-3" style="min-height: calc(100vh - 160px);">

    <!-- ── COL 1-8: LEFT AREA ── -->
    <div class="col-span-12 xl:col-span-8 grid grid-rows-auto gap-3">

      <!-- ===== HEART / ECG MONITOR ===== -->
      <div class="panel panel-green scanline-overlay holo-flicker" style="height:180px;">
        <div class="absolute top-3 left-4 flex items-center gap-3">
          <span class="panel-header text-green-400">❤ Cardiac Empathy Wave</span>
          <div class="flex items-center gap-1">
            @for($i=0;$i<5;$i++)
              <div class="sig-bar bg-green-400" style="height:{{ 6+$i*3 }}px; --dur:{{ 0.6+$i*0.15 }}s; --delay:{{ $i*0.12 }}s;">
          </div>
          @endfor
        </div>
        <span class="text-green-400 text-[10px]" id="bpm-display">72 BPM</span>
      </div>
      <div class="absolute top-3 right-4 flex items-center gap-4">
        <span class="text-gray-600 text-[10px] tracking-widest">LEAD II</span>
        <div class="w-2 h-2 rounded-full bg-green-400" style="box-shadow:0 0 8px #00ff9f; animation: glow-pulse 0.8s ease-in-out infinite;"></div>
      </div>

      <!-- ECG SVG ANIMATION -->
      <div class="ecg-track-wrap absolute inset-0 top-8" style="">
        <div class="ecg-track h-full items-center">
          <!-- First copy -->
          <svg viewBox="0 0 800 100" preserveAspectRatio="none" style="width:800px; height:100%; flex-shrink:0;" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <filter id="glow-ecg">
                <feGaussianBlur stdDeviation="2" result="blur" />
                <feMerge>
                  <feMergeNode in="blur" />
                  <feMergeNode in="SourceGraphic" />
                </feMerge>
              </filter>
            </defs>
            <!-- Grid lines -->
            @for($g=0;$g
            <8;$g++)
              <line x1="{{ $g*100 }}" y1="0" x2="{{ $g*100 }}" y2="100" stroke="rgba(0,255,159,0.06)" stroke-width="0.5" />
            @endfor
            @for($g=0;$g
            <5;$g++)
              <line x1="0" y1="{{ $g*25 }}" x2="800" y2="{{ $g*25 }}" stroke="rgba(0,255,159,0.06)" stroke-width="0.5" />
            @endfor
            <!-- ECG trace — realistic PQRST complex repeated -->
            <polyline filter="url(#glow-ecg)"
              points="
                  0,50 20,50 25,48 30,52 35,30 40,80 45,20 50,85 55,50 65,50
                  70,48 75,52 80,30 85,80 90,20 95,85 100,50 115,50
                  120,48 125,52 130,30 135,80 140,20 145,85 150,50 165,50
                  170,48 175,52 180,30 185,80 190,20 195,85 200,50 215,50
                  220,48 225,52 230,30 235,80 240,20 245,85 250,50 265,50
                  270,48 275,52 280,30 285,80 290,20 295,85 300,50 315,50
                  320,48 325,52 330,30 335,80 340,20 345,85 350,50 365,50
                  370,48 375,52 380,30 385,80 390,20 395,85 400,50 415,50
                  420,48 425,52 430,30 435,80 440,20 445,85 450,50 465,50
                  470,48 475,52 480,30 485,80 490,20 495,85 500,50 515,50
                  520,48 525,52 530,30 535,80 540,20 545,85 550,50 565,50
                  570,48 575,52 580,30 585,80 590,20 595,85 600,50 615,50
                  620,48 625,52 630,30 635,80 640,20 645,85 650,50 665,50
                  670,48 675,52 680,30 685,80 690,20 695,85 700,50 715,50
                  720,48 725,52 730,30 735,80 740,20 745,85 750,50 765,50
                  770,48 775,52 780,30 785,80 790,20 795,85 800,50"
              fill="none" stroke="#00ff9f" stroke-width="1.5"
              style="opacity:0.85;" />
            <!-- Bright head glow dot -->
            <circle r="3" fill="#00ff9f" style="filter:drop-shadow(0 0 6px #00ff9f)">
              <animateMotion dur="4s" repeatCount="indefinite"
                path="M0,50 L20,50 L25,48 L30,52 L35,30 L40,80 L45,20 L50,85 L55,50 L65,50 L70,48 L75,52 L80,30 L85,80 L90,20 L95,85 L100,50 L115,50 L120,48 L125,52 L130,30 L135,80 L140,20 L145,85 L150,50 L165,50 L170,48 L175,52 L180,30 L185,80 L190,20 L195,85 L200,50 L215,50 L220,48 L225,52 L230,30 L235,80 L240,20 L245,85 L250,50 L265,50 L270,48 L275,52 L280,30 L285,80 L290,20 L295,85 L300,50 L315,50 L320,48 L325,52 L330,30 L335,80 L340,20 L345,85 L350,50 L365,50 L370,48 L375,52 L380,30 L385,80 L390,20 L395,85 L400,50" />
            </circle>
          </svg>
          <!-- Second copy (seamless loop) -->
          <svg viewBox="0 0 800 100" preserveAspectRatio="none" style="width:800px; height:100%; flex-shrink:0;" xmlns="http://www.w3.org/2000/svg">
            <polyline
              points="
                  0,50 20,50 25,48 30,52 35,30 40,80 45,20 50,85 55,50 65,50
                  70,48 75,52 80,30 85,80 90,20 95,85 100,50 115,50
                  120,48 125,52 130,30 135,80 140,20 145,85 150,50 165,50
                  170,48 175,52 180,30 185,80 190,20 195,85 200,50 215,50
                  220,48 225,52 230,30 235,80 240,20 245,85 250,50 265,50
                  270,48 275,52 280,30 285,80 290,20 295,85 300,50 315,50
                  320,48 325,52 330,30 335,80 340,20 345,85 350,50 365,50
                  370,48 375,52 380,30 385,80 390,20 395,85 400,50 415,50
                  420,48 425,52 430,30 435,80 440,20 445,85 450,50 465,50
                  470,48 475,52 480,30 485,80 490,20 495,85 500,50 515,50
                  520,48 525,52 530,30 535,80 540,20 545,85 550,50 565,50
                  570,48 575,52 580,30 585,80 590,20 595,85 600,50 615,50
                  620,48 625,52 630,30 635,80 640,20 645,85 650,50 665,50
                  670,48 675,52 680,30 685,80 690,20 695,85 700,50 715,50
                  720,48 725,52 730,30 735,80 740,20 745,85 750,50 765,50
                  770,48 775,52 780,30 785,80 790,20 795,85 800,50"
              fill="none" stroke="#00ff9f" stroke-width="1.5" style="opacity:0.85;" />
          </svg>
        </div>
      </div>

      <!-- Bottom status -->
      <div class="absolute bottom-3 left-4 right-4 flex justify-between">
        <span class="text-green-400 text-[10px] tracking-widest">SINUS RHYTHM NORMAL<span class="blink ml-1">_</span></span>
        <span class="text-gray-600 text-[10px]">EMPATHY COHERENCE: {{ $patient->empathy_score }}%</span>
        <span class="text-green-400 text-[10px]" id="ecg-timer">00:00:00</span>
      </div>
    </div>

    <!-- ===== ROW 2: VITALS STRIP ===== -->
    <div class="grid grid-cols-4 gap-3">

      @php
      $score = $patient->empathy_score;
      $vitals = [
      ['label'=>'EMPATHY','val'=>$score,'unit'=>'/ 100','color'=>'#f59e0b','glow'=>'rgba(245,158,11,0.5)','icon'=>'◈'],
      ['label'=>'NEURAL SYNC','val'=>min(100,round($score*0.92+rand(-5,5))),'unit'=>'%','color'=>'#00ff9f','glow'=>'rgba(0,255,159,0.5)','icon'=>'⬡'],
      ['label'=>'AFFECT LOAD','val'=>min(100,round($score*1.05+rand(-8,8))),'unit'=>'%','color'=>'#38bdf8','glow'=>'rgba(56,189,248,0.5)','icon'=>'≋'],
      ['label'=>'MOOD INDEX','val'=>min(100,round($score*0.88+rand(-6,6))),'unit'=>'%','color'=>'#a78bfa','glow'=>'rgba(167,139,250,0.5)','icon'=>'◉'],
      ];
      @endphp

      @foreach($vitals as $v)
      <div class="panel" style="padding:14px; border-color:rgba(255,255,255,0.07);">
        <div class="flex justify-between items-start mb-2">
          <span class="panel-header text-gray-500">{{ $v['icon'] }} {{ $v['label'] }}</span>
          <div class="w-1.5 h-1.5 rounded-full" style="background:{{ $v['color'] }}; box-shadow:0 0 6px {{ $v['glow'] }}; animation: glow-pulse 2s ease-in-out infinite;"></div>
        </div>
        <div class="text-3xl font-bold" style="color:{{ $v['color'] }}; text-shadow:0 0 20px {{ $v['glow'] }}; font-variant-numeric:tabular-nums;" data-target="{{ $v['val'] }}" data-counter>0</div>
        <div class="text-gray-600 text-[10px] mt-0.5">{{ $v['unit'] }}</div>
        <!-- mini bar -->
        <div class="h-0.5 rounded-full mt-3 overflow-hidden" style="background:rgba(255,255,255,0.05)">
          <div class="h-full rounded-full" style="width:{{ $v['val'] }}%; background:{{ $v['color'] }}; box-shadow:0 0 6px {{ $v['glow'] }}; transition:width 2s cubic-bezier(0.34,1.56,0.64,1);"></div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- ===== ROW 3: DATA TRANSFER + NEURAL GRAPH ===== -->
    <div class="grid grid-cols-2 gap-3">

      <!-- DATA TRANSFER PANEL -->
      <div class="panel panel-blue scanline-overlay" style="height:220px; overflow:hidden;">
        <div class="absolute top-3 left-4 right-4 flex justify-between items-center z-10">
          <span class="panel-header text-sky-400">⇅ Neural Data Transfer</span>
          <div class="flex items-center gap-2">
            <span class="text-sky-400 text-[10px]" id="data-rate">2.4 GB/s</span>
            <div class="flex gap-0.5 items-end h-5">
              @for($i=0;$i<8;$i++)
                <div class="sig-bar bg-sky-400" style="height:{{ rand(4,18) }}px; --dur:{{ 0.4+$i*0.1 }}s; --delay:{{ $i*0.08 }}s; width:2px;">
            </div>
            @endfor
          </div>
        </div>
      </div>

      <!-- Scrolling matrix rain columns -->
      <div class="absolute inset-0 top-10 overflow-hidden" id="matrix-container">
        @for($col=0;$col<12;$col++)
          <div class="data-stream-col" style="left:{{ $col*8.5 }}%; --spd:{{ 4+rand(0,5) }}s; --dl:{{ rand(0,40)/10 }}s; color:rgba(56,189,248,{{ 0.3+rand(0,4)/10 }})">
          @for($r=0;$r<20;$r++)
            {{ chr(rand(65,90)) }}{{ chr(rand(48,57)) }}<br>
            @endfor
      </div>
      @endfor
    </div>

    <!-- Transfer bars overlay -->
    <div class="absolute bottom-4 left-4 right-4 space-y-2 z-10">
      @php $xfers = [['TX','Transmit',rand(60,95),'#00ff9f'],['RX','Receive',rand(40,80),'#38bdf8'],['SY','Sync',rand(70,99),'#a78bfa']]; @endphp
      @foreach($xfers as [$abbr,$lbl,$pct,$col])
      <div class="flex items-center gap-2">
        <span class="text-[9px] font-mono" style="color:{{ $col }}; width:18px;">{{ $abbr }}</span>
        <div class="flex-1 h-1 rounded-full" style="background:rgba(255,255,255,0.05)">
          <div class="h-full rounded-full" style="width:{{ $pct }}%; background:{{ $col }}; box-shadow:0 0 6px {{ $col }}; transition:width 2s ease;"></div>
        </div>
        <span class="text-[9px] font-mono text-gray-600">{{ $pct }}%</span>
      </div>
      @endforeach
    </div>
  </div>

  <!-- EMPATHY WAVEFORM -->
  <div class="panel panel-amber" style="height:220px;">
    <div class="absolute top-3 left-4 right-4 flex justify-between">
      <span class="panel-header text-amber-400">∿ Empathy Waveform</span>
      <span class="text-amber-400 text-[10px]">{{ $patient->empathy_label }}</span>
    </div>
    <canvas id="waveformChart" style="position:absolute; inset:0; top:32px; width:100%; height:calc(100% - 32px);"></canvas>
  </div>
</div>

<!-- ===== ROW 4: TREND + DIMENSIONAL ===== -->
<div class="grid grid-cols-3 gap-3">

  <!-- 12-month trend -->
  <div class="col-span-2 panel panel-green" style="height:200px;">
    <div class="absolute top-3 left-4 right-4 flex justify-between">
      <span class="panel-header text-green-400">📈 12-Month Empathy Trajectory</span>
      <span class="text-gray-600 text-[10px]">LONGITUDINAL ANALYSIS</span>
    </div>
    <canvas id="trendChart" style="position:absolute; inset:0; top:32px; width:100%; height:calc(100% - 32px);"></canvas>
  </div>

  <!-- Dimensional radar -->
  <div class="panel" style="height:200px; border-color:rgba(167,139,250,0.25);">
    <div class="absolute top-3 left-4">
      <span class="panel-header text-purple-400">◉ Dimension Map</span>
    </div>
    <canvas id="radarChart" style="position:absolute; inset:0; top:28px; width:100%; height:calc(100% - 28px);"></canvas>
  </div>
</div>
</div>

<!-- ── COL 9-12: RIGHT SIDEBAR ── -->
<div class="col-span-12 xl:col-span-4 flex flex-col gap-3">

  <!-- SCORE RING -->
  <div class="panel panel-amber" style="padding:20px;">
    <div class="panel-header text-amber-400 mb-4">◈ Empathy Score Ring</div>
    <div class="flex justify-center">
      <div class="relative">
        <svg width="160" height="160" viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
          <!-- Outer decorative ring -->
          <circle cx="80" cy="80" r="75" fill="none" stroke="rgba(245,158,11,0.08)" stroke-width="1" stroke-dasharray="3 6" />
          <!-- Track -->
          <circle cx="80" cy="80" r="60" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="10" />
          <!-- Score arc -->
          @php
          $circumference = 2 * M_PI * 60; // ~376.99
          $offset = $circumference - ($patient->empathy_score / 100) * $circumference;
          $scoreColor = $patient->empathy_score >= 75 ? '#f59e0b' : ($patient->empathy_score >= 40 ? '#38bdf8' : '#f87171');
          $glowColor = $patient->empathy_score >= 75 ? 'rgba(245,158,11,0.7)' : ($patient->empathy_score >= 40 ? 'rgba(56,189,248,0.7)' : 'rgba(248,113,113,0.7)');
          @endphp
          <circle cx="80" cy="80" r="60"
            fill="none"
            stroke="{{ $scoreColor }}"
            stroke-width="10"
            stroke-linecap="round"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $circumference }}"
            transform="rotate(-90 80 80)"
            id="score-arc"
            style="transition: stroke-dashoffset 2s cubic-bezier(0.34,1.56,0.64,1); filter:drop-shadow(0 0 8px {{ $glowColor }});" />
          <!-- Inner ring rotating -->
          <circle class="ring-outer" cx="80" cy="80" r="45" fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="1" stroke-dasharray="2 8" />
          <!-- Center value -->
          <text x="80" y="72" text-anchor="middle" fill="{{ $scoreColor }}" font-size="32" font-weight="bold" style="filter:drop-shadow(0 0 12px {{ $glowColor }});">{{ $patient->empathy_score }}</text>
          <text x="80" y="88" text-anchor="middle" fill="rgba(156,163,175,0.8)" font-size="9">OUT OF 100</text>
          <text x="80" y="100" text-anchor="middle" fill="{{ $scoreColor }}" font-size="7" letter-spacing="2">{{ strtoupper($patient->empathy_label) }}</text>
        </svg>
        <!-- Animate arc on load -->
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
              document.getElementById('score-arc').style.strokeDashoffset = '{{ $offset }}';
            }, 300);
          });
        </script>
      </div>
    </div>
    <!-- sub gauges -->
    @php
    $dims = [
    ['Emotional', min(100,$patient->empathy_score+rand(-8,12)), '#f59e0b'],
    ['Cognitive', min(100,$patient->empathy_score+rand(-12,8)), '#00ff9f'],
    ['Affective', min(100,$patient->empathy_score+rand(-6,10)), '#38bdf8'],
    ];
    @endphp
    <div class="mt-4 space-y-2">
      @foreach($dims as [$lbl,$val,$col])
      <div class="flex items-center gap-2">
        <span class="text-gray-500 text-[10px] w-20">{{ $lbl }}</span>
        <div class="flex-1 h-1.5 rounded-full" style="background:rgba(255,255,255,0.05)">
          <div class="h-full rounded-full" style="width:{{ $val }}%; background:{{ $col }}; box-shadow:0 0 6px {{ $col }}; transition:width 2s ease;"></div>
        </div>
        <span class="text-[10px] font-mono" style="color:{{ $col }}; width:28px;">{{ $val }}</span>
      </div>
      @endforeach
    </div>
  </div>

  <!-- RADAR / SIGNAL -->
  <div class="panel" style="padding:16px; border-color:rgba(0,255,159,0.2);">
    <div class="panel-header text-green-400 mb-3">⬡ Neural Radar</div>
    <div class="flex justify-center">
      <div class="relative" style="width:120px; height:120px;">
        <svg width="120" height="120" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
          <!-- Concentric circles -->
          @for($r=1;$r
          <=4;$r++)
            <circle cx="60" cy="60" r="{{ $r*14 }}" fill="none" stroke="rgba(0,255,159,0.1)" stroke-width="0.5" />
          @endfor
          <!-- Axes -->
          @for($a=0;$a
          <6;$a++)
            @php $angle=$a * 60 * M_PI / 180; @endphp
            <line x1="60" y1="60" x2="{{ 60+56*cos($angle) }}" y2="{{ 60+56*sin($angle) }}" stroke="rgba(0,255,159,0.1)" stroke-width="0.5" />
          @endfor
          <!-- Sweep -->
          <line class="radar-sweep" x1="60" y1="60" x2="60" y2="4" stroke="rgba(0,255,159,0.6)" stroke-width="1"
            style="filter:drop-shadow(0 0 4px #00ff9f); transform-origin:60px 60px;" />
          <!-- Data polygon -->
          @php
          $angles6 = [0,60,120,180,240,300];
          $vals6 = [$patient->empathy_score, min(100,$patient->empathy_score+rand(-10,10)), min(100,$patient->empathy_score+rand(-15,5)), min(100,$patient->empathy_score+rand(-5,15)), min(100,$patient->empathy_score+rand(-12,8)), min(100,$patient->empathy_score+rand(-8,12))];
          $polyPts = [];
          foreach($angles6 as $i=>$ang) {
          $rad = $ang * M_PI / 180;
          $r_v = ($vals6[$i]/100) * 52;
          $polyPts[] = (60+$r_v*cos($rad-M_PI/2)).','.( 60+$r_v*sin($rad-M_PI/2));
          }
          @endphp
          <polygon points="{{ implode(' ',$polyPts) }}" fill="rgba(0,255,159,0.12)" stroke="#00ff9f" stroke-width="1"
            style="filter:drop-shadow(0 0 4px rgba(0,255,159,0.5));" />
          <circle cx="60" cy="60" r="3" fill="#00ff9f" style="filter:drop-shadow(0 0 6px #00ff9f);" />
        </svg>
      </div>
    </div>
    <div class="grid grid-cols-3 gap-1 mt-3">
      @foreach(['Empathy','Reaction','Warmth','Insight','Mirror','Connect'] as $k=>$lbl)
      <div class="text-center">
        <div class="text-green-400 text-[9px]">{{ $lbl }}</div>
        <div class="text-white text-[10px] font-bold">{{ $vals6[$k] }}</div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- PATIENT INTEL -->
  <div class="panel" style="padding:16px; border-color:rgba(245,158,11,0.2); flex:1;">
    <div class="panel-header text-amber-400 mb-4">◈ Patient Intel</div>
    <div class="space-y-3">
      @foreach([
      ['ID', '#'.str_pad($patient->id,6,'0',STR_PAD_LEFT)],
      ['NAME', $patient->name],
      ['AGE', $patient->age.' years'],
      ['SEX', $patient->sex],
      ['MOOD', $patient->mood_icon.' '.$patient->mood_state],
      ['DIAGNOSIS', $patient->diagnosis ?? 'Unspecified'],
      ['REGISTERED', $patient->created_at->format('Y-m-d')],
      ] as [$k,$v])
      <div class="flex justify-between items-start gap-2" style="border-bottom:1px solid rgba(255,255,255,0.04); padding-bottom:8px;">
        <span class="text-gray-600 text-[9px] tracking-widest flex-shrink-0">{{ $k }}</span>
        <span class="text-gray-300 text-[10px] text-right">{{ $v }}</span>
      </div>
      @endforeach
      @if($patient->address)
      <div style="border-bottom:1px solid rgba(255,255,255,0.04); padding-bottom:8px;">
        <span class="text-gray-600 text-[9px] tracking-widest">ADDRESS</span>
        <p class="text-gray-300 text-[10px] mt-1 leading-relaxed">{{ $patient->address }}</p>
      </div>
      @endif
    </div>

    @if($patient->notes)
    <div class="mt-4">
      <div class="panel-header text-gray-500 mb-2">CLINICAL NOTES</div>
      <p class="text-gray-500 text-[10px] leading-relaxed">{{ $patient->notes }}</p>
    </div>
    @endif

    <!-- PARANA badge -->
    <div class="mt-4 flex items-center justify-center gap-2 py-2 rounded-lg" style="background:rgba(245,158,11,0.06); border:1px solid rgba(245,158,11,0.15);">
      <span class="text-base">🧠</span>
      <span class="text-amber-400 text-[9px] tracking-widest">PARANA EMPATHY DETECTOR</span>
    </div>
  </div>
</div>
</div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {

    // ─── LIVE CLOCK ───
    function updateClock() {
      const now = new Date();
      document.getElementById('live-clock').textContent =
        now.toLocaleDateString('en-GB') + '  ' +
        now.toTimeString().slice(0, 8) + ' UTC';
    }
    setInterval(updateClock, 1000);
    updateClock();

    // ─── ECG TIMER ───
    let secs = 0;
    setInterval(() => {
      secs++;
      const h = String(Math.floor(secs / 3600)).padStart(2, '0');
      const m = String(Math.floor((secs % 3600) / 60)).padStart(2, '0');
      const s = String(secs % 60).padStart(2, '0');
      document.getElementById('ecg-timer').textContent = h + ':' + m + ':' + s;
    }, 1000);

    // ─── ANIMATED BPM ───
    let bpmBase = 68;
    setInterval(() => {
      bpmBase += Math.floor(Math.random() * 7) - 3;
      bpmBase = Math.max(58, Math.min(88, bpmBase));
      document.getElementById('bpm-display').textContent = bpmBase + ' BPM';
    }, 2000);

    // ─── ANIMATED DATA RATE ───
    setInterval(() => {
      const rate = (1.8 + Math.random() * 2.4).toFixed(1);
      document.getElementById('data-rate').textContent = rate + ' GB/s';
    }, 1500);

    // ─── COUNTER UP ANIMATION ───
    document.querySelectorAll('[data-counter]').forEach(el => {
      const target = parseInt(el.dataset.target);
      let current = 0;
      const step = Math.ceil(target / 60);
      const interval = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = current;
        if (current >= target) clearInterval(interval);
      }, 20);
    });

    // ─── EMPATHY WAVEFORM CHART ───
    @php
    $score = $patient->empathy_score;
    $waveData = [];
    for ($i = 0; $i < 40; $i++) {
      $base = $score + rand(-12, 12);
      $waveData[] = max(0, min(100, $base));
    }
    @endphp
    const waveLabels = Array.from({
      length: 40
    }, (_, i) => i);
    const waveData = @json($waveData);
    const scoreColor = '{{ $patient->empathy_score >= 75 ? "#f59e0b" : ($patient->empathy_score >= 40 ? "#38bdf8" : "#f87171") }}';

    const wfCtx = document.getElementById('waveformChart').getContext('2d');
    const wfChart = new Chart(wfCtx, {
      type: 'line',
      data: {
        labels: waveLabels,
        datasets: [{
          data: waveData,
          borderColor: scoreColor,
          backgroundColor: scoreColor.replace(')', ',0.08)').replace('rgb', 'rgba'),
          borderWidth: 1.5,
          pointRadius: 0,
          fill: true,
          tension: 0.4,
        }]
      },
      options: {
        responsive: false,
        animation: {
          duration: 0
        },
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            display: false
          },
          y: {
            display: false,
            min: 0,
            max: 100
          }
        }
      }
    });

    // Live waveform update
    setInterval(() => {
      const baseScore = {{ $patient->empathy_score }};
      const newVal = Math.max(0, Math.min(100, baseScore + Math.floor(Math.random() * 24) - 12));
      wfChart.data.datasets[0].data.push(newVal);
      wfChart.data.datasets[0].data.shift();
      wfChart.data.labels.push(wfChart.data.labels.length);
      wfChart.data.labels.shift();
      wfChart.update();
    }, 600);

    // ─── 12-MONTH TREND CHART ───
    @php
    $trend = json_decode($patient->empathy_trend ?? '[]', true);
    if (empty($trend)) {
      $trend = [];
      $b = $patient->empathy_score;
      for ($i = 0; $i < 12; $i++) {
        $b += rand(-8, 10);
        $b = max(10, min(100, $b));
        $trend[] = $b;
      }
    }
    @endphp
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    new Chart(trendCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          data: @json($trend),
          borderColor: '#00ff9f',
          backgroundColor: 'rgba(0,255,159,0.07)',
          borderWidth: 1.5,
          pointRadius: 3,
          pointBackgroundColor: '#00ff9f',
          pointBorderColor: 'transparent',
          fill: true,
          tension: 0.4,
        }]
      },
      options: {
        responsive: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            grid: {
              color: 'rgba(0,255,159,0.05)'
            },
            ticks: {
              color: '#4b5563',
              font: {
                size: 9
              }
            }
          },
          y: {
            min: 0,
            max: 100,
            grid: {
              color: 'rgba(0,255,159,0.05)'
            },
            ticks: {
              color: '#4b5563',
              font: {
                size: 9
              }
            }
          }
        }
      }
    });

    // ─── RADAR / DIMENSIONAL CHART ───
    @php
    $s = $patient->empathy_score;
    $radarVals = [
      min(100, max(0, $s + rand(-10, 10))),
      min(100, max(0, $s + rand(-15, 5))),
      min(100, max(0, $s + rand(-5, 15))),
      min(100, max(0, $s + rand(-12, 8))),
      min(100, max(0, $s + rand(-8, 12))),
    ];
    @endphp
    const radarCtx = document.getElementById('radarChart').getContext('2d');
    new Chart(radarCtx, {
      type: 'radar',
      data: {
        labels: ['Emotional', 'Cognitive', 'Affective', 'Social', 'Mirror'],
        datasets: [{
          data: @json($radarVals),
          borderColor: '#a78bfa',
          backgroundColor: 'rgba(167,139,250,0.12)',
          borderWidth: 1.5,
          pointRadius: 3,
          pointBackgroundColor: '#a78bfa',
        }]
      },
      options: {
        responsive: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          r: {
            min: 0,
            max: 100,
            grid: {
              color: 'rgba(167,139,250,0.1)'
            },
            angleLines: {
              color: 'rgba(167,139,250,0.1)'
            },
            ticks: {
              display: false
            },
            pointLabels: {
              color: '#6b7280',
              font: {
                size: 8
              }
            }
          }
        }
      }
    });

    // ─── LIVE WAVEFORM NOISE for ECG color oscillation ───
    setInterval(() => {
      const s = document.getElementById('main-score');
      if (s) {
        const jitter = Math.floor(Math.random() * 3) - 1;
        // Just flicker opacity slightly for sci-fi effect
        s.style.opacity = (0.85 + Math.random() * 0.15).toFixed(2);
      }
    }, 800);

  });
</script>
@endpush