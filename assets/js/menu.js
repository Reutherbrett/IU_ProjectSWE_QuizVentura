/**
 * Menu Navigation and Functionality
 * Handles menu toggling, navigation, and content switching
 */

const MenuManager = {
    /**
     * Toggle the mobile menu visibility
     */
    toggle() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.querySelector('.menu-backdrop');
        
        if (sidebar) {
            sidebar.classList.toggle('active');
        }
        
        if (backdrop) {
            backdrop.classList.toggle('active');
        }
    },

    /**
     * Close the mobile menu
     */
    close() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.querySelector('.menu-backdrop');
        
        if (sidebar) {
            sidebar.classList.remove('active');
        }
        
        if (backdrop) {
            backdrop.classList.remove('active');
        }
    },

    /**
     * Handle menu item clicks - changes theme and shows content
     * @param {string} color - Theme color for the menu item
     * @param {string} content - Content identifier to show
     */
    handleItemClick(color, content) {
        // Change theme color
        if (window.ThemeManager) {
            window.ThemeManager.changeColor(color);
        }
        
        // Switch content in secondary sidebar
        this.switchContent(content);
        
        // Close mobile menu if open
        this.close();
    },

    /**
     * Switch content in the secondary sidebar
     * @param {string} contentId - Content identifier
     */
    switchContent(contentId) {
        // Hide all sidebar contents
        document.querySelectorAll('.sidebar-content').forEach(el => {
            el.style.display = 'none';
        });
        
        // Show selected content
        const selectedContent = document.getElementById('content-' + contentId);
        if (selectedContent) {
            selectedContent.style.display = 'block';
        }
        
        // Force refresh secondary sidebar styling to ensure correct colors
        if (window.ThemeManager) {
            // Small delay to ensure content has switched before refreshing
            setTimeout(() => {
                window.ThemeManager.refreshSecondarySidebar();
            }, 50);
        }
    },

    /**
     * Initialize menu event listeners
     */
    initializeNavigation() {
        // Main navigation items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.removeEventListener('click', this.handleNavClick);
            item.addEventListener('click', this.handleNavClick.bind(this));
        });

        // Profile cards in secondary menu
        document.querySelectorAll('.profile-card').forEach(card => {
            card.style.cursor = 'pointer';
            card.removeEventListener('click', this.handleCardClick);
            card.addEventListener('click', this.handleCardClick.bind(this));
        });

        // Menu toggle and backdrop
        const backdrop = document.querySelector('.menu-backdrop');
        if (backdrop) {
            backdrop.addEventListener('click', this.toggle.bind(this));
        }

        const menuToggle = document.querySelector('.menu-toggle');
        if (menuToggle) {
            menuToggle.addEventListener('click', this.toggle.bind(this));
        }
    },

    /**
     * Handle navigation item clicks
     * @param {Event} e - Click event
     */
    handleNavClick(e) {
        e.preventDefault();
        e.stopPropagation();

        const color = e.currentTarget.getAttribute('data-color');
        const content = e.currentTarget.getAttribute('data-content');
        
        if (color && content) {
            this.handleItemClick(color, content);
        }
    },

    /**
     * Handle profile card clicks
     * @param {Event} e - Click event
     */
    handleCardClick(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const pageUrl = e.currentTarget.dataset.page;
        if (pageUrl && window.AjaxManager) {
            window.AjaxManager.loadPage(pageUrl, true);
        }
    },

    /**
     * Set initial menu state
     * @param {string} defaultColor - Default theme color
     * @param {string} defaultContent - Default content to show
     */
    init(defaultColor = '#F26419', defaultContent = 'about') {
        this.initializeNavigation();
        this.handleItemClick(defaultColor, defaultContent);
    }
};

// Export for global access
window.MenuManager = MenuManager;