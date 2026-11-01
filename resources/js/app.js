import * as bootstrap from 'bootstrap';
import Chart from 'chart.js/auto';

// Expose bootstrap and Chart globally to window
window.bootstrap = bootstrap;
window.Chart = Chart;

// Dispatch ready event for any listeners
document.dispatchEvent(new CustomEvent('app:ready', { detail: { bootstrap, Chart } }));
