/**
 * PARANA — Real-time Patient Monitoring Dashboard
 * Cinematic visualizations with live data streaming
 */

export class PatientMonitor {
  constructor(patientId) {
    this.patientId = patientId;
    this.charts = {};
    this.updateInterval = null;
    this.init();
  }

  init() {
    this.setupEventListeners();
    this.fetchRealtimeData();
    this.startPeriodicUpdates();
  }

  setupEventListeners() {
    // Listen for visibility changes to optimize performance
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        this.pause();
      } else {
        this.resume();
      }
    });
  }

  async fetchRealtimeData() {
    try {
      const response = await fetch(`/api/patients/${this.patientId}/realtime`);
      const data = await response.json();
      this.updateVisualizations(data);
      this.updateMetricsDisplay(data);
    } catch (error) {
      console.error('Failed to fetch realtime data:', error);
    }
  }

  updateVisualizations(data) {
    // Update heart rate visualization
    this.updateHeartRateWave(data.heartRateWave);

    // Update data transfer visualization
    this.updateDataTransfer(data.dataTransfer);

    // Update indicators
    this.updateIndicators(data.indicators);

    // Update timeline
    this.updateTimeline(data.timeline);
  }

  updateHeartRateWave(waveData) {
    // Find and update waveform if chart exists
    if (this.charts.heartRate) {
      this.charts.heartRate.data.datasets[0].data = waveData;
      this.charts.heartRate.update('none');
    }
  }

  updateDataTransfer(dataTransfer) {
    // Update transfer bars with new values
    const txBar = document.querySelector('[data-transfer="tx"] .transfer-fill');
    const rxBar = document.querySelector('[data-transfer="rx"] .transfer-fill');

    if (txBar) {
      txBar.style.width = dataTransfer.sent + '%';
    }
    if (rxBar) {
      rxBar.style.width = dataTransfer.received + '%';
    }

    // Update node visualization
    dataTransfer.nodes.forEach((node, idx) => {
      const nodeEl = document.querySelector(`[data-node="${idx}"] .node-value`);
      if (nodeEl) {
        nodeEl.textContent = node.value;
      }
    });
  }

  updateIndicators(indicators) {
    indicators.forEach((indicator, idx) => {
      const indicatorEl = document.querySelector(`[data-indicator="${idx}"]`);
      if (indicatorEl) {
        const fill = indicatorEl.querySelector('.indicator-fill');
        const value = indicatorEl.querySelector('.indicator-value');

        if (fill) fill.style.width = indicator.value + '%';
        if (value) value.textContent = indicator.value;
      }
    });
  }

  updateTimeline(timeline) {
    if (this.charts.timeline) {
      this.charts.timeline.data.datasets[0].data = timeline.map(d => d.score);
      this.charts.timeline.update('none');
    }
  }

  updateMetricsDisplay(data) {
    // Update BPM display with variation
    const bpmDisplay = document.getElementById('bpm-display');
    if (bpmDisplay) {
      const bpm = Math.floor(70 + Math.sin(Date.now() / 1000) * 15);
      bpmDisplay.textContent = bpm + ' BPM';
    }

    // Update data rate
    const rateDisplay = document.getElementById('data-rate');
    if (rateDisplay) {
      const rate = (1.8 + Math.random() * 2.4).toFixed(1);
      rateDisplay.textContent = rate + ' GB/s';
    }

    // Update main score if changed
    const mainScore = document.getElementById('main-score');
    if (mainScore && data.patient.empathy_score) {
      mainScore.textContent = data.patient.empathy_score;
    }
  }

  startPeriodicUpdates() {
    // Update every 3 seconds
    this.updateInterval = setInterval(() => {
      this.fetchRealtimeData();
    }, 3000);
  }

  pause() {
    if (this.updateInterval) {
      clearInterval(this.updateInterval);
    }
  }

  resume() {
    this.startPeriodicUpdates();
  }

  destroy() {
    this.pause();
    Object.values(this.charts).forEach(chart => {
      if (chart) chart.destroy();
    });
  }
}

// Initialize on DOM ready
export function initRealtimeMonitoring(patientId) {
  return new PatientMonitor(patientId);
}
