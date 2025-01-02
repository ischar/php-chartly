import './bootstrap';
import { loadStockData } from './data.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
loadStockData();