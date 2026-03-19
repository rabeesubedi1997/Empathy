// PARANA Empathy Detector - Main Application JavaScript

// Import axios for API calls
import axios from 'axios';

// Set up axios defaults
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Global app functionality
window.ParanaApp = {
    init: function() {
        console.log('PARANA Empathy Detector initialized');
    },
    
    // Helper for making API calls
    api: {
        get: function(url) {
            return axios.get(url);
        },
        
        post: function(url, data) {
            return axios.post(url, data);
        }
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    ParanaApp.init();
});
