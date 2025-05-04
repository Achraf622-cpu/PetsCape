/**
 * PetsCape Utilities
 * Common utility functions used across the site
 */

// Throttle function to limit how often a function can be called
function throttle(callback, delay = 200) {
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
}

// Debounce function to delay execution until after a quiet period
function debounce(callback, delay = 300) {
    let timeout;
    
    return function() {
        clearTimeout(timeout);
        timeout = setTimeout(() => callback.apply(this, arguments), delay);
    };
}

// Check if element is in viewport
function isInViewport(element, threshold = 0) {
    const rect = element.getBoundingClientRect();
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    
    return (
        rect.top <= windowHeight * (1 - threshold) &&
        rect.bottom >= windowHeight * threshold
    );
}

// Load image and return a promise
function preloadImage(src) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.onload = () => resolve(img);
        img.onerror = reject;
        img.src = src;
    });
}

// Format date to locale string
function formatDate(date, options = { dateStyle: 'medium' }) {
    if (typeof date === 'string') {
        date = new Date(date);
    }
    
    return date.toLocaleDateString('fr-FR', options);
}

// Get CSRF token from meta tag
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
}

// Make fetch request with CSRF token
async function fetchWithCsrf(url, options = {}) {
    const csrfToken = getCsrfToken();
    
    const defaultOptions = {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'same-origin'
    };
    
    return fetch(url, {
        ...defaultOptions,
        ...options,
        headers: {
            ...defaultOptions.headers,
            ...options.headers
        }
    });
}

// Show notification toast
function showNotification(message, type = 'success', duration = 3000) {
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

// Export utility functions
export {
    throttle,
    debounce,
    isInViewport,
    preloadImage,
    formatDate,
    getCsrfToken,
    fetchWithCsrf,
    showNotification
}; 