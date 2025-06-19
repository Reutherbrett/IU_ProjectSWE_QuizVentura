/**
 * Simple QuizVentura Navigation
 * Handles menu, themes, and page loading
 */

// Theme colors
const THEME_COLORS = {
    '#F26419': '#D14F0F', // Orange
    '#6200EA': '#4A00B4', // Purple  
    '#00BCD4': '#00ACC1', // Cyan
    '#FF5252': '#E53935', // Red
    '#FFEB3B': '#FDD835'  // Yellow
};

// Simple state
let isMenuOpen = false;

// === THEME FUNCTIONS ===
function changeTheme(color) {
    const hoverColor = THEME_COLORS[color] || color;
    const rgba = hexToRgba(color, 0.9);
    
    document.documentElement.style.setProperty('--primary-color', color);
    document.documentElement.style.setProperty('--primary-hover', hoverColor);
    document.documentElement.style.setProperty('--secondary-menu-bg', rgba);
}

function hexToRgba(hex, opacity) {
    const r = parseInt(hex.slice(1, 3), 16);
    const g = parseInt(hex.slice(3, 5), 16);
    const b = parseInt(hex.slice(5, 7), 16);
    return `rgba(${r}, ${g}, ${b}, ${opacity})`;
}

// === MENU FUNCTIONS ===
function toggleMenu() {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.querySelector('.menu-backdrop');
    
    isMenuOpen = !isMenuOpen;
    
    if (sidebar) {
        sidebar.classList.toggle('active', isMenuOpen);
    }
    if (backdrop) {
        backdrop.classList.toggle('active', isMenuOpen);
    }
}

function closeMenu() {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.querySelector('.menu-backdrop');
    
    isMenuOpen = false;
    
    if (sidebar) sidebar.classList.remove('active');
    if (backdrop) backdrop.classList.remove('active');
}

function switchContent(contentId) {
    // Hide all content
    document.querySelectorAll('.sidebar-content').forEach(el => {
        el.style.display = 'none';
    });
    
    // Show selected content
    const target = document.getElementById('content-' + contentId);
    if (target) {
        target.style.display = 'block';
    }
}

function handleMenuClick(color, content) {
    changeTheme(color);
    switchContent(content);
    closeMenu();
}

// === SIMPLE PAGE LOADING ===
function loadPage(url) {
    const mainContent = document.getElementById('main-content');
    if (!mainContent) return;
    
    // Show loading
    mainContent.style.opacity = '0.6';
    
    // Simple fetch - no caching, no complexity
    fetch(url + '?t=' + Date.now(), {
        method: 'GET',
        cache: 'no-cache'
    })
    .then(response => {
        if (!response.ok) throw new Error('Network error');
        return response.text();
    })
    .then(html => {
        mainContent.innerHTML = html;
        mainContent.style.opacity = '1';
    })
    .catch(error => {
        console.error('Load error:', error);
        mainContent.innerHTML = '<div class="error">Fehler beim Laden der Seite.</div>';
        mainContent.style.opacity = '1';
    });
}

// === TOUCH SUPPORT ===
function addTouchSupport(element, handler) {
    // Add both click and touch events
    element.addEventListener('click', handler);
    element.addEventListener('touchend', (e) => {
        e.preventDefault(); // Prevent double-firing
        handler(e);
    });
}

// === INITIALIZATION ===
function init() {
    // Set default theme and content
    changeTheme('#F26419');
    switchContent('dashboard');
    
    // Load default page
    loadPage('pages/dashboard/meinDashboard.php');
    
    // Setup menu toggle with touch support
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        addTouchSupport(menuToggle, (e) => {
            e.preventDefault();
            e.stopPropagation();
            toggleMenu();
        });
    }
    
    // Setup backdrop with touch support
    const backdrop = document.querySelector('.menu-backdrop');
    if (backdrop) {
        addTouchSupport(backdrop, (e) => {
            e.preventDefault();
            e.stopPropagation();
            closeMenu();
        });
    }
    
    // Setup navigation items with touch support
    document.querySelectorAll('.nav-item').forEach(item => {
        addTouchSupport(item, (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            const color = e.currentTarget.dataset.color;
            const content = e.currentTarget.dataset.content;
            if (color && content) {
                handleMenuClick(color, content);
            }
        });
    });
    
    // Setup profile cards with touch support
    document.querySelectorAll('.profile-card').forEach(card => {
        addTouchSupport(card, (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            const pageUrl = e.currentTarget.dataset.page;
            if (pageUrl) {
                loadPage(pageUrl);
                closeMenu();
            }
        });
    });
    
    // Close menu on window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) {
            closeMenu();
        }
    });
    
    // Prevent zoom on double-tap (mobile optimization)
    let lastTouchEnd = 0;
    document.addEventListener('touchend', (e) => {
        const now = Date.now();
        if (now - lastTouchEnd <= 300) {
            e.preventDefault();
        }
        lastTouchEnd = now;
    }, { passive: false });
}

// Start when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

// Global functions for legacy support
window.toggleMenu = toggleMenu;
window.loadPage = loadPage;
window.changeThemeColor = changeTheme;