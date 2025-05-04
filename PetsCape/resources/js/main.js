/**
 * PetsCape Main JavaScript
 * Handles DOM manipulation, animations and UI interactions
 */

// DOM Elements
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');
const navBar = document.querySelector('nav');

// Mobile menu toggle with animation
if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
        // Toggle visibility
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
}

// Scroll effect for navbar
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navBar.classList.add('shadow-md');
        navBar.style.transition = 'box-shadow 0.3s ease';
    } else {
        navBar.classList.remove('shadow-md');
    }
});

// Confirmation dialogs with custom styling
window.confirmLogout = function() {
    return showConfirmDialog('Êtes-vous sûr de vouloir vous déconnecter ?', () => {
        document.getElementById('logout-form').submit();
    });
};

window.confirmMobileLogout = function() {
    return showConfirmDialog('Êtes-vous sûr de vouloir vous déconnecter ?', () => {
        document.getElementById('mobile-logout-form').submit();
    });
};

// Custom dialog function
function showConfirmDialog(message, confirmCallback) {
    // Create overlay
    const overlay = document.createElement('div');
    overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center';
    
    // Create dialog
    const dialog = document.createElement('div');
    dialog.className = 'bg-white rounded-xl p-6 max-w-sm mx-auto shadow-xl transform transition-all';
    dialog.innerHTML = `
        <h3 class="text-lg font-medium text-[#2F2E41] mb-4">${message}</h3>
        <div class="flex justify-end gap-3 mt-6">
            <button id="dialog-cancel" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                Annuler
            </button>
            <button id="dialog-confirm" class="px-4 py-2 bg-[#FF6B6B] text-white rounded-lg hover:bg-[#FF8787] transition-colors">
                Confirmer
            </button>
        </div>
    `;
    
    // Add dialog to overlay
    overlay.appendChild(dialog);
    
    // Add to document
    document.body.appendChild(overlay);
    
    // Animation
    dialog.style.opacity = '0';
    dialog.style.transform = 'scale(0.9)';
    setTimeout(() => {
        dialog.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
        dialog.style.opacity = '1';
        dialog.style.transform = 'scale(1)';
    }, 10);
    
    // Handle buttons
    return new Promise((resolve) => {
        document.getElementById('dialog-confirm').addEventListener('click', () => {
            closeDialog(overlay, dialog);
            if (confirmCallback) confirmCallback();
            resolve(true);
        });
        
        document.getElementById('dialog-cancel').addEventListener('click', () => {
            closeDialog(overlay, dialog);
            resolve(false);
        });
        
        // Close when clicking outside
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                closeDialog(overlay, dialog);
                resolve(false);
            }
        });
    });
}

// Close dialog with animation
function closeDialog(overlay, dialog) {
    dialog.style.opacity = '0';
    dialog.style.transform = 'scale(0.9)';
    
    setTimeout(() => {
        document.body.removeChild(overlay);
    }, 200);
}

// Export functions for use in other modules
export { showConfirmDialog }; 