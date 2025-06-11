// Function to change the theme color
function changeThemeColor(color) {
    document.documentElement.style.setProperty('--primary-color', color);

    // Adjust hover color based on primary color
   const hoverColors = {
        '#6200EA': '#4A00B4',
        '#00BCD4': '#00ACC1',
        '#FFEB3B': '#FDD835',
        '#FF5252': '#E53935',
        '#F26419': '#D14F0F'
    };
    
    if (hoverColors[color]) {
        document.documentElement.style.setProperty('--primary-hover', hoverColors[color]);
    }
    
    // Conver hex color to rgba with 90% opacity
    const hex = color.replace('#', '');
    const r = parseInt(hex.substr(0, 2), 16);
    const g = parseInt(hex.substr(2, 2), 16);
    const b = parseInt(hex.substr(4, 2), 16);
    
    document.documentElement.style.setProperty('--secondary-menu-bg', `rgba(${r}, ${g}, ${b}, 0.9)`);

    // Update mobile header color immediately
    const mobileHeader = document.querySelector('.mobile-header');
    if (mobileHeader) {
        mobileHeader.style.backgroundColor = color;
    }
    
    // Update both sidebars
    const sidebar = document.getElementById('sidebar');
    const secondarySidebar = document.getElementById('secondary-sidebar');
    
    if (sidebar) {
        sidebar.style.backgroundColor = color;
    }
    
    if (secondarySidebar) {
        secondarySidebar.style.backgroundColor = `rgba(${r}, ${g}, ${b}, 0.9)`;
    }
}

// MENU

// Function to toggle the main menu
function toggleMenu() {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.querySelector('.menu-backdrop');
    
    if (sidebar) {
        sidebar.classList.toggle('active');
    }
    
    if (backdrop) {
        backdrop.classList.toggle('active');
    }
}

// Handle menu clicks and color changes
function handleMenuClick(color, content) {
    // Change theme color
    changeThemeColor(color);
    
    // Hide all sidebar contents
    document.querySelectorAll('.sidebar-content').forEach(el => {
        el.style.display = 'none';
    });
    
    // Show selected content
    const selectedContent = document.getElementById('content-' + content);
    if (selectedContent) {
        selectedContent.style.display = 'block';
    }
}

// AJAX Functions optimized for Safari
function createXHR() {
    // Safari-specific XHR creation with better error handling
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        try {
            return new ActiveXObject('Msxml2.XMLHTTP');
        } catch (e) {
            try {
                return new ActiveXObject('Microsoft.XMLHTTP');
            } catch (e2) {
                return null;
            }
        }
    }
    return null;
}

// Enhanced fetch with Safari compatibility
function safeFetch(url, options = {}) {
    // Safari-specific headers and options
    const defaultOptions = {
        method: 'GET',
        headers: {
            'Content-Type': 'text/html; charset=utf-8',
            'Cache-Control': 'no-cache, no-store, must-revalidate',
            'Pragma': 'no-cache',
            'Expires': '0'
        },
        cache: 'no-cache',
        credentials: 'same-origin'
    };
    
    const finalOptions = { ...defaultOptions, ...options };
    
    // Use fetch if available, fallback to XHR for older Safari
    if (typeof fetch !== 'undefined') {
        return fetch(url, finalOptions)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.text();
            });
    } else {
        // Fallback XHR for older Safari versions
        return new Promise((resolve, reject) => {
            const xhr = createXHR();
            if (!xhr) {
                reject(new Error('XMLHttpRequest not supported'));
                return;
            }
            
            xhr.open(finalOptions.method, url, true);
            
            // Set headers
            if (finalOptions.headers) {
                Object.keys(finalOptions.headers).forEach(key => {
                    xhr.setRequestHeader(key, finalOptions.headers[key]);
                });
            }
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        resolve(xhr.responseText);
                    } else {
                        reject(new Error(`HTTP ${xhr.status}: ${xhr.statusText}`));
                    }
                }
            };
            
            xhr.onerror = function() {
                reject(new Error('Network error'));
            };
            
            xhr.send(finalOptions.body || null);
        });
    }
}

// Load page via AJAX with Safari optimization
function loadPage(url, updateHistory = true) {
    const mainContent = document.getElementById('main-content');
    if (!mainContent) {
        console.error('Main content element not found');
        return;
    }
    
    // Show loading state
    mainContent.style.opacity = '0.5';
    
    // Add timestamp to prevent Safari caching issues
    const separator = url.includes('?') ? '&' : '?';
    const urlWithTimestamp = `${url}${separator}_t=${Date.now()}`;
    
    safeFetch(urlWithTimestamp)
        .then(html => {
            // Update main content area
            mainContent.innerHTML = html;
            mainContent.style.opacity = '1';
            
            // Update URL without reload
            if (updateHistory && window.history && window.history.pushState) {
                try {
                    const cleanUrl = 'index.php?page=' + url.replace('pages/', '').replace('.php', '');
                    window.history.pushState({page: url}, '', cleanUrl);
                } catch (e) {
                    console.warn('History API not fully supported:', e);
                }
            }
            
            // Re-initialize any JavaScript that needs to run on new content
            initializeNewContent();
        })
        .catch(error => {
            console.error('Error loading page:', error);
            mainContent.innerHTML = '<div class="error">Fehler beim Laden der Seite.</div>';
            mainContent.style.opacity = '1';
        });
}

// Initialize JavaScript for dynamically loaded content
function initializeNewContent() {
    // Re-initialize any form handlers, event listeners, etc.
    // This is where you'd add code to handle newly loaded content
}

function initializeProfileCards() {
    const profileCards = document.querySelectorAll('.profile-card');
    
    profileCards.forEach(card => {
        card.style.cursor = 'pointer';
        
        // Remove existing listeners to prevent duplicates
        card.removeEventListener('click', handleCardClick);
        card.addEventListener('click', handleCardClick);
    });
}

function handleCardClick(e) {
    e.preventDefault();
    e.stopPropagation();
    
    const pageUrl = this.dataset.page;
    if (pageUrl) {
        loadPage(pageUrl, true);
    }
}

// Initialize navigation items
function initializeNavItems() {
    document.querySelectorAll('.nav-item').forEach(item => {
        // Remove existing listeners to prevent duplicates
        item.removeEventListener('click', handleNavClick);
        item.addEventListener('click', handleNavClick);
    });
}

function handleNavClick(e) {
    e.preventDefault();
    e.stopPropagation();

    const color = this.getAttribute('data-color');
    const content = this.getAttribute('data-content');
    
    if (color && content) {
        handleMenuClick(color, content);
        
        // Close mobile menu if open
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.querySelector('.menu-backdrop');
        if (sidebar && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
            if (backdrop) {
                backdrop.classList.remove('active');
            }
        }
    }
}

// Main initialization
document.addEventListener('DOMContentLoaded', function() {
    initializeProfileCards();
    initializeNavItems();
    
    // Initialize backdrop and toggle button
    const backdrop = document.querySelector('.menu-backdrop');
    if (backdrop) {
        backdrop.addEventListener('click', toggleMenu);
    }

    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }
    
    // Handle browser back/forward buttons
    if (window.history && window.history.pushState) {
        window.addEventListener('popstate', function(e) {
            if (e.state && e.state.page) {
                loadPage(e.state.page, false);
            }
        });
    }
    
    // Initialize with default content (dashboard) and color
    handleMenuClick('#F26419', 'dashboard');
});

// Handle page visibility changes (Safari optimization)
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        // Page became visible, refresh any dynamic content if needed
        // This helps with Safari's aggressive caching
    }
});

// Export functions for global access
window.toggleMenu = toggleMenu;
window.changeThemeColor = changeThemeColor;
window.loadPage = loadPage;

// Close menu on item click (mobile)
// document.addEventListener('DOMContentLoaded', function() {
//     // Add event listeners for menu items
//     document.querySelectorAll('.nav-item').forEach(item => {
//         item.addEventListener('click', (e) => {
//             e.preventDefault(); // Prevent default navigation

//             const color = item.getAttribute('data-color');
//             const content = item.getAttribute('data-content');
            
//             if (color && content) {
//                 handleMenuClick(color, content);
//             }
//         });
//     });

//     // Ensure the backdrop works
//     const backdrop = document.querySelector('.menu-backdrop');
//     if (backdrop) {
//         backdrop.addEventListener('click', toggleMenu);
//     }

//     // Ensure the toggle button works
//     const menuToggle = document.querySelector('.menu-toggle');
//     if (menuToggle) {
//         menuToggle.addEventListener('click', toggleMenu);
//     }

//     // Initialize with the first item (Home)
//     showSidebarContent('home');
// });