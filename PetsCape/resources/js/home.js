/**
 * PetsCape Homepage Effects
 * Special animations and interactions for the homepage
 */

import { Animator } from './animations';

// Animated pet pawprints that follow cursor
function initPawprintCursor() {
    const pawprintInterval = 400; // ms between pawprints
    let lastPawTime = 0;
    
    // Create pawprint container if it doesn't exist
    let pawContainer = document.getElementById('paw-container');
    if (!pawContainer) {
        pawContainer = document.createElement('div');
        pawContainer.id = 'paw-container';
        pawContainer.style.position = 'fixed';
        pawContainer.style.top = '0';
        pawContainer.style.left = '0';
        pawContainer.style.width = '100%';
        pawContainer.style.height = '100%';
        pawContainer.style.pointerEvents = 'none';
        pawContainer.style.zIndex = '999';
        pawContainer.style.overflow = 'hidden';
        document.body.appendChild(pawContainer);
    }
    
    // Listen for mouse movement
    document.addEventListener('mousemove', (e) => {
        const currentTime = Date.now();
        
        // Throttle pawprint creation
        if (currentTime - lastPawTime > pawprintInterval) {
            createPawprint(e.clientX, e.clientY, pawContainer);
            lastPawTime = currentTime;
        }
    });
}

// Create a single pawprint at the given position
function createPawprint(x, y, container) {
    // Randomize whether it's left or right paw
    const isLeft = Math.random() > 0.5;
    
    // Create pawprint element
    const paw = document.createElement('div');
    paw.className = 'pawprint';
    paw.style.position = 'absolute';
    paw.style.top = `${y - 15}px`;
    paw.style.left = `${x - 15}px`;
    paw.style.width = '30px';
    paw.style.height = '30px';
    paw.style.backgroundSize = 'contain';
    paw.style.backgroundRepeat = 'no-repeat';
    paw.style.backgroundPosition = 'center';
    paw.style.opacity = '0.8';
    paw.style.transform = `rotate(${Math.random() * 60 - 30}deg)`;
    
    // Set image based on left/right paw
    paw.style.backgroundImage = `url('/images/pawprint-${isLeft ? 'left' : 'right'}.svg')`;
    
    // Add to container
    container.appendChild(paw);
    
    // Animate and remove
    new Animator(paw).fadeIn(200).then(() => {
        setTimeout(() => {
            new Animator(paw).fadeOut(800).then(() => {
                container.removeChild(paw);
            });
        }, 1000);
    });
}

// Floating animations for hero elements
function animateHeroElements() {
    const heroTitle = document.querySelector('.hero-title');
    const heroImage = document.querySelector('.hero-image');
    const heroButtons = document.querySelectorAll('.hero-button');
    
    if (heroTitle) {
        new Animator(heroTitle).slideIn('left', '50px', 800);
    }
    
    if (heroImage) {
        // Add floating animation
        let floating = true;
        const floatAnimation = () => {
            if (!floating) return;
            
            new Animator(heroImage)._animate({
                transform: ['translateY(0px)', 'translateY(-15px)', 'translateY(0px)']
            }, 3000, 0, 'ease-in-out').then(() => {
                if (floating) floatAnimation();
            });
        };
        
        // Start with slide in, then float
        new Animator(heroImage).slideIn('right', '50px', 800).then(() => {
            setTimeout(floatAnimation, 500);
        });
        
        // Stop floating animation when page is not visible
        document.addEventListener('visibilitychange', () => {
            floating = !document.hidden;
            if (floating) floatAnimation();
        });
    }
    
    // Animate buttons with delay between each
    if (heroButtons.length > 0) {
        heroButtons.forEach((button, index) => {
            setTimeout(() => {
                new Animator(button).slideIn('up', '30px', 500);
            }, 1000 + (index * 200));
        });
    }
}

// Animated background bubbles/shapes
function createAnimatedBackground() {
    const container = document.querySelector('.hero-section');
    if (!container) return;
    
    // Create background element
    const background = document.createElement('div');
    background.className = 'animated-background';
    background.style.position = 'absolute';
    background.style.top = '0';
    background.style.left = '0';
    background.style.width = '100%';
    background.style.height = '100%';
    background.style.overflow = 'hidden';
    background.style.pointerEvents = 'none';
    background.style.zIndex = '0';
    
    // Add to container before other elements
    if (container.firstChild) {
        container.insertBefore(background, container.firstChild);
    } else {
        container.appendChild(background);
    }
    
    // Create bubbles/shapes
    for (let i = 0; i < 15; i++) {
        createFloatingShape(background);
    }
}

// Create a single floating shape
function createFloatingShape(container) {
    const shape = document.createElement('div');
    
    // Random properties
    const size = Math.random() * 60 + 40;
    const posX = Math.random() * 100;
    const posY = Math.random() * 100;
    const duration = Math.random() * 20000 + 15000;
    const delay = Math.random() * 5000;
    
    // Apply styles
    shape.className = 'floating-shape';
    shape.style.position = 'absolute';
    shape.style.width = `${size}px`;
    shape.style.height = `${size}px`;
    shape.style.borderRadius = '30% 70% 70% 30% / 30% 30% 70% 70%'; // Blob shape
    shape.style.backgroundColor = Math.random() > 0.5 ? 'rgba(255, 107, 107, 0.15)' : 'rgba(255, 227, 227, 0.2)';
    shape.style.top = `${posY}%`;
    shape.style.left = `${posX}%`;
    shape.style.opacity = '0';
    
    // Add to container
    container.appendChild(shape);
    
    // Animation function
    const animateShape = () => {
        // Random movement
        const newPosX = Math.random() * 100;
        const newPosY = Math.random() * 100;
        
        shape.style.transition = `top ${duration}ms ease-in-out, left ${duration}ms ease-in-out, transform ${duration}ms ease-in-out`;
        shape.style.top = `${newPosY}%`;
        shape.style.left = `${newPosX}%`;
        shape.style.transform = `rotate(${Math.random() * 360}deg)`;
        
        // Continue animation
        setTimeout(animateShape, duration);
    };
    
    // Start with fade in, then move
    setTimeout(() => {
        shape.style.transition = 'opacity 1s ease-in-out';
        shape.style.opacity = '1';
        
        setTimeout(animateShape, 1000);
    }, delay);
}

// Pet card hover effects
function initPetCardEffects() {
    const petCards = document.querySelectorAll('.pet-card');
    
    petCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            new Animator(card)._animate({
                transform: ['translateY(0)', 'translateY(-8px)']
            }, 300, 0, 'ease-out');
        });
        
        card.addEventListener('mouseleave', () => {
            new Animator(card)._animate({
                transform: ['translateY(-8px)', 'translateY(0)']
            }, 300, 0, 'ease-in');
        });
    });
}

// Initialize all homepage effects
function initHomeEffects() {
    // Add classes to elements for selecting them in JS
    const heroSection = document.querySelector('.pt-32.pb-20');
    if (heroSection) {
        heroSection.classList.add('hero-section');
        
        const heroTitle = heroSection.querySelector('h2');
        if (heroTitle) heroTitle.classList.add('hero-title');
        
        const heroImage = heroSection.querySelector('img, .relative');
        if (heroImage) heroImage.classList.add('hero-image');
        
        const heroButtons = heroSection.querySelectorAll('button');
        heroButtons.forEach(button => button.classList.add('hero-button'));
    }
    
    const petCards = document.querySelectorAll('.grid.grid-cols-1.md\\:grid-cols-3 > div');
    petCards.forEach(card => card.classList.add('pet-card'));
    
    // Initialize effects
    document.addEventListener('DOMContentLoaded', () => {
        createAnimatedBackground();
        animateHeroElements();
        initPetCardEffects();
        
        // Only enable pawprint cursor on larger screens
        if (window.innerWidth > 768) {
            initPawprintCursor();
        }
    });
}

export { initHomeEffects }; 