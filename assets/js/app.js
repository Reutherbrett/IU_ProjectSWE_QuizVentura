/**
 * Main Application Controller
 * Coordinates all modules and handles application initialization
 */

const App = {
    // Configuration
    config: {
        defaultColor: '#F26419',
        defaultContent: 'dashboard'
    },

    /**
     * Initialize the entire application
     */
    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                this.startup();
            });
        } else {
            this.startup();
        }
    },

    /**
     * Main startup sequence
     */
    startup() {
        console.log('🚀 QuizVentura App starting...');

        // Initialize all managers in order
        this.initializeManagers();
        
        // Set up global event listeners
        this.setupGlobalEvents();
        
        // Expose global functions for backward compatibility
        this.exposeGlobalFunctions();

        console.log('✅ QuizVentura App initialized successfully');
    },

    /**
     * Initialize all manager modules
     */
    initializeManagers() {
        // Initialize AJAX manager first (for history handling)
        if (window.AjaxManager) {
            window.AjaxManager.init();
        }

        // Initialize theme manager
        if (window.ThemeManager) {
            window.ThemeManager.init(this.config.defaultColor);
        }

        // Initialize menu manager (depends on theme and ajax)
        if (window.MenuManager) {
            window.MenuManager.init(this.config.defaultColor, this.config.defaultContent);
        }
    },

    /**
     * Set up global event listeners
     */
    setupGlobalEvents() {
        // Handle window resize for responsive adjustments
        window.addEventListener('resize', this.debounce(() => {
            this.handleResize();
        }, 250));

        // Handle orientation change on mobile
        window.addEventListener('orientationchange', () => {
            setTimeout(() => {
                this.handleResize();
            }, 100);
        });

        // Prevent default behavior on certain elements
        this.preventDefaults();
    },

    /**
     * Handle window resize events
     */
    handleResize() {
        // Close mobile menu on resize to larger screen
        if (window.innerWidth > 1024 && window.MenuManager) {
            window.MenuManager.close();
        }
    },

    /**
     * Prevent default behaviors where needed
     */
    preventDefaults() {
        // Prevent zoom on double-tap for better mobile UX
        let lastTouchEnd = 0;
        document.addEventListener('touchend', (event) => {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, false);
    },

    /**
     * Expose functions globally for backward compatibility
     */
    exposeGlobalFunctions() {
        // Legacy function names
        window.toggleMenu = () => {
            if (window.MenuManager) {
                window.MenuManager.toggle();
            }
        };

        window.changeThemeColor = (color) => {
            if (window.ThemeManager) {
                window.ThemeManager.changeColor(color);
            }
        };

        window.loadPage = (url, updateHistory = true) => {
            if (window.AjaxManager) {
                window.AjaxManager.loadPage(url, updateHistory);
            }
        };

        // New function for menu item handling
        window.handleMenuClick = (color, content) => {
            if (window.MenuManager) {
                window.MenuManager.handleItemClick(color, content);
            }
        };
    },

    /**
     * Utility: Debounce function calls
     * @param {Function} func - Function to debounce
     * @param {number} wait - Wait time in milliseconds
     * @returns {Function} - Debounced function
     */
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    /**
     * Utility: Check if device is mobile
     * @returns {boolean}
     */
    isMobile() {
        return window.innerWidth <= 768;
    },

    /**
     * Utility: Check if device is tablet
     * @returns {boolean}
     */
    isTablet() {
        return window.innerWidth <= 1024 && window.innerWidth > 768;
    },

    /**
     * Get current app state
     * @returns {Object}
     */
    getState() {
        return {
            isMobile: this.isMobile(),
            isTablet: this.isTablet(),
            currentTheme: getComputedStyle(document.documentElement)
                .getPropertyValue('--primary-color').trim()
        };
    }
};

// Start the application
App.init();

// Export for debugging and external access
window.App = App;