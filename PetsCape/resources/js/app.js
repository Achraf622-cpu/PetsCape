import './bootstrap';
import { initAnimations } from './animations';
import { initHomeEffects } from './home';
import * as utils from './utils';
import './main';

// Make utils globally available
window.PetsCapeUtils = utils;

// Initialize animations on all pages
initAnimations();

// Initialize homepage effects if we're on the homepage
if (document.querySelector('.hero-section, .pt-32.pb-20')) {
    initHomeEffects();
}

// Add CSRF token meta tag if it doesn't exist (for AJAX requests)
if (!document.querySelector('meta[name="csrf-token"]')) {
    const meta = document.createElement('meta');
    meta.name = 'csrf-token';
    meta.content = document.querySelector('input[name="_token"]')?.value || '';
    document.head.appendChild(meta);
}
