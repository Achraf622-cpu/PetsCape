/**
 * PetsCape - Combined JavaScript for animations and functionality
 */

// DOM elements
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');
const navBar = document.querySelector('nav');

// Utility functions
const utils = {
    // Throttle function to limit how often a function can be called
    throttle: function(callback, delay = 200) {
        let isThrottled = false;
        let lastArgs = null;
        let lastThis = null;
        
        function wrapper() {
            if (isThrottled) {
                lastArgs = arguments;
                lastThis = this;
                return;
            }
            
            isThrottled = true;
            callback.apply(this, arguments);
            
            setTimeout(() => {
                isThrottled = false;
                if (lastArgs) {
                    wrapper.apply(lastThis, lastArgs);
                    lastArgs = null;
                    lastThis = null;
                }
            }, delay);
        }
        
        return wrapper;
    },

    // Check if element is in viewport
    isInViewport: function(element, threshold = 0) {
        const rect = element.getBoundingClientRect();
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
        
        return (
            rect.top <= windowHeight * (1 - threshold) &&
            rect.bottom >= windowHeight * threshold
        );
    },

    // Show notification toast
    showNotification: function(message, type = 'success', duration = 3000) {
        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.style.position = 'fixed';
            toastContainer.style.bottom = '20px';
            toastContainer.style.right = '20px';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }
        
        // Create toast element
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.style.minWidth = '250px';
        toast.style.margin = '10px';
        toast.style.padding = '15px 20px';
        toast.style.borderRadius = '8px';
        toast.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
        toast.style.display = 'flex';
        toast.style.alignItems = 'center';
        toast.style.justifyContent = 'space-between';
        toast.style.transform = 'translateY(100px)';
        toast.style.opacity = '0';
        toast.style.transition = 'all 0.3s ease-out';
        
        // Set style based on type
        switch (type) {
            case 'success':
                toast.style.backgroundColor = '#4CAF50';
                toast.style.color = 'white';
                break;
            case 'error':
                toast.style.backgroundColor = '#F44336';
                toast.style.color = 'white';
                break;
            case 'warning':
                toast.style.backgroundColor = '#FF9800';
                toast.style.color = 'white';
                break;
            case 'info':
                toast.style.backgroundColor = '#2196F3';
                toast.style.color = 'white';
                break;
            default:
                toast.style.backgroundColor = '#333';
                toast.style.color = 'white';
        }
        
        // Add content
        toast.innerHTML = `
            <span>${message}</span>
            <button style="background: none; border: none; color: white; cursor: pointer; margin-left: 10px;">×</button>
        `;
        
        // Add to container
        toastContainer.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.style.transform = 'translateY(0)';
            toast.style.opacity = '1';
        }, 10);
        
        // Close button
        const closeButton = toast.querySelector('button');
        closeButton.addEventListener('click', () => {
            closeToast(toast);
        });
        
        // Auto close
        const timeoutId = setTimeout(() => {
            closeToast(toast);
        }, duration);
        
        // Close function
        function closeToast(toastElement) {
            clearTimeout(timeoutId);
            toastElement.style.transform = 'translateY(100px)';
            toastElement.style.opacity = '0';
            
            setTimeout(() => {
                toastContainer.removeChild(toastElement);
                
                // Remove container if empty
                if (toastContainer.children.length === 0) {
                    document.body.removeChild(toastContainer);
                }
            }, 300);
        }
        
        return toast;
    }
};

// Animation utilities
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

// Setup parallax effect
function setupParallax() {
    const elements = document.querySelectorAll('[data-parallax]');
    
    if (elements.length === 0) return;
    
    window.addEventListener('scroll', utils.throttle(() => {
        const scrollTop = window.pageYOffset;
        
        elements.forEach(el => {
            const speed = parseFloat(el.dataset.parallaxSpeed || 0.2);
            const offset = scrollTop * speed;
            el.style.transform = `translateY(${offset}px)`;
        });
    }, 10));
}

// Setup scroll reveal animations
function setupScrollReveal() {
    const elements = document.querySelectorAll('[data-scroll-reveal]');
    
    if (elements.length === 0) return;
    
    // Set initial state for elements
    elements.forEach(el => {
        const direction = el.dataset.scrollDirection || 'up';
        el.style.opacity = '0';
        
        if (direction === 'left') {
            el.style.transform = 'translateX(-30px)';
        } else if (direction === 'right') {
            el.style.transform = 'translateX(30px)';
        } else {
            el.style.transform = 'translateY(30px)';
        }
    });
    
    // Function to check for elements in viewport
    const checkElementsInViewport = utils.throttle(() => {
        elements.forEach(el => {
            if (utils.isInViewport(el, 0.15) && !el.classList.contains('revealed')) {
                const delay = parseInt(el.dataset.scrollDelay || 0);
                
                setTimeout(() => {
                    el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translate(0, 0)';
                    el.classList.add('revealed');
                }, delay);
            }
        });
    }, 100);
    
    // Run on page load and scroll
    checkElementsInViewport();
    window.addEventListener('scroll', checkElementsInViewport);
}

// Floating animations for hero elements
function animateHeroElements() {
    const heroImage = document.querySelector('.hero-image');
    
    if (heroImage) {
        // Add floating animation
        setInterval(() => {
            heroImage.style.transition = 'transform 3s ease-in-out';
            heroImage.style.transform = 'translateY(-15px)';
            
            setTimeout(() => {
                heroImage.style.transform = 'translateY(0)';
            }, 1500);
        }, 3000);
    }
}

// Create animated background elements
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
    for (let i = 0; i < 8; i++) {
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

// Initialize all animations and effects
document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu toggle - disabled for welcome.blade.php to prevent conflicts
    const currentPage = window.location.pathname;
    const isHomePage = currentPage === '/' || currentPage === '/index.php';
    
    // Only handle mobile menu if not on the homepage
    if (mobileMenuButton && mobileMenu && !isHomePage) {
        mobileMenuButton.addEventListener('click', () => {
            if (mobileMenu.classList.contains('hidden')) {
                // Show menu with animation
                mobileMenu.classList.remove('hidden');
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-20px)';
                
                // Animate in
                setTimeout(() => {
                    mobileMenu.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    mobileMenu.style.opacity = '1';
                    mobileMenu.style.transform = 'translateY(0)';
                }, 10);
            } else {
                // Animate out
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-20px)';
                
                // Hide after animation completes
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        });
        
        // Prevent menu from closing when clicking inside it
        mobileMenu.addEventListener('click', (event) => {
            // Only prevent if not clicking on a link
            if (!event.target.closest('a') && !event.target.closest('button')) {
                event.stopPropagation();
            }
        });
        
        // Make links close the menu after navigation
        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Animate out
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-20px)';
                
                // Hide after animation completes
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            // If menu is open and click is outside menu and not on the menu button
            if (!mobileMenu.classList.contains('hidden') && 
                !mobileMenu.contains(event.target) && 
                !mobileMenuButton.contains(event.target)) {
                
                // Animate out
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-20px)';
                
                // Hide after animation completes
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        });
    }
    
    // Confirmation dialogs
    window.confirmLogout = function() {
        if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
            document.getElementById('logout-form').submit();
        }
    };
    
    window.confirmMobileLogout = function() {
        if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
            document.getElementById('mobile-logout-form').submit();
        }
    };
    
    // Scroll effect for navbar
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navBar.classList.add('shadow-md');
            navBar.style.transition = 'box-shadow 0.3s ease';
        } else {
            navBar.classList.remove('shadow-md');
        }
    });
    
    // Setup animations
    setupScrollReveal();
    setupParallax();
    
    // Homepage-specific effects
    if (document.querySelector('.hero-section')) {
        createAnimatedBackground();
        animateHeroElements();
        // Pawprint cursor disabled as requested
    }
    
    // Make utils globally available
    window.PetsCapeUtils = utils;
}); 