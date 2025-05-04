/**
 * PetsCape Animations
 * Contains animation utilities and effects for the site
 */

// Simple animation utility for creating smooth animations
class Animator {
    constructor(element) {
        this.element = typeof element === 'string' ? document.querySelector(element) : element;
        this.originalStyles = {};
        this._saveOriginalStyles(['opacity', 'transform']);
    }

    _saveOriginalStyles(properties) {
        properties.forEach(prop => {
            this.originalStyles[prop] = this.element.style[prop];
        });
    }

    fadeIn(duration = 500, delay = 0, easing = 'ease') {
        return this._animate({
            opacity: [0, 1]
        }, duration, delay, easing);
    }

    fadeOut(duration = 500, delay = 0, easing = 'ease') {
        return this._animate({
            opacity: [1, 0]
        }, duration, delay, easing);
    }

    slideIn(direction = 'up', distance = '30px', duration = 500, delay = 0, easing = 'ease') {
        let transform;
        
        switch(direction) {
            case 'up':
                transform = [`translateY(${distance})`, 'translateY(0)'];
                break;
            case 'down':
                transform = [`translateY(-${distance})`, 'translateY(0)'];
                break;
            case 'left':
                transform = [`translateX(${distance})`, 'translateX(0)'];
                break;
            case 'right':
                transform = [`translateX(-${distance})`, 'translateX(0)'];
                break;
        }
        
        return this._animate({
            opacity: [0, 1],
            transform
        }, duration, delay, easing);
    }

    slideOut(direction = 'up', distance = '30px', duration = 500, delay = 0, easing = 'ease') {
        let transform;
        
        switch(direction) {
            case 'up':
                transform = ['translateY(0)', `translateY(-${distance})`];
                break;
            case 'down':
                transform = ['translateY(0)', `translateY(${distance})`];
                break;
            case 'left':
                transform = ['translateX(0)', `translateX(-${distance})`];
                break;
            case 'right':
                transform = ['translateX(0)', `translateX(${distance})`];
                break;
        }
        
        return this._animate({
            opacity: [1, 0],
            transform
        }, duration, delay, easing);
    }

    pulse(scale = 1.05, duration = 500, delay = 0, easing = 'ease') {
        return this._animate({
            transform: ['scale(1)', `scale(${scale})`, 'scale(1)']
        }, duration, delay, easing);
    }

    _animate(properties, duration, delay, easing) {
        return new Promise(resolve => {
            this.element.style.transition = '';
            
            // Apply initial state
            Object.entries(properties).forEach(([prop, values]) => {
                if (Array.isArray(values) && values.length > 0) {
                    this.element.style[prop] = values[0];
                }
            });
            
            // Force reflow
            this.element.offsetHeight;
            
            // Start animation
            this.element.style.transition = Object.keys(properties)
                .map(prop => `${prop} ${duration}ms ${easing} ${delay}ms`)
                .join(', ');
                
            // Apply final state
            Object.entries(properties).forEach(([prop, values]) => {
                if (Array.isArray(values) && values.length > 1) {
                    const finalValue = values[values.length - 1];
                    this.element.style[prop] = finalValue;
                }
            });
            
            // Cleanup after animation completes
            setTimeout(() => {
                resolve();
            }, duration + delay);
        });
    }

    reset() {
        this.element.style.transition = '';
        Object.entries(this.originalStyles).forEach(([prop, value]) => {
            this.element.style[prop] = value;
        });
    }
}

// Parallax effect for backgrounds and images
function setupParallax() {
    const elements = document.querySelectorAll('[data-parallax]');
    
    if (elements.length === 0) return;
    
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset;
        
        elements.forEach(el => {
            const speed = parseFloat(el.dataset.parallaxSpeed || 0.2);
            const offset = scrollTop * speed;
            el.style.transform = `translateY(${offset}px)`;
        });
    });
}

// Scroll reveal animation
function setupScrollReveal() {
    const elements = document.querySelectorAll('[data-scroll-reveal]');
    
    if (elements.length === 0) return;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const delay = parseInt(el.dataset.scrollDelay || 0);
                const direction = el.dataset.scrollDirection || 'up';
                
                setTimeout(() => {
                    new Animator(el).slideIn(direction);
                    el.classList.add('revealed');
                }, delay);
                
                // Unobserve after animation
                if (!el.dataset.scrollRepeat) {
                    observer.unobserve(el);
                }
            } else if (el.classList.contains('revealed') && el.dataset.scrollRepeat) {
                el.classList.remove('revealed');
                el.style.opacity = '0';
            }
        });
    }, {
        threshold: 0.1
    });
    
    elements.forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });
}

// Initialize all animations
function initAnimations() {
    setupParallax();
    setupScrollReveal();
    
    // Add additional initialization here
}

// Export functions and classes
export { Animator, initAnimations }; 