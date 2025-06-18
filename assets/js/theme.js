/**
 * Theme and Color Management
 * Handles all theme-related functionality including color changes
 */

const ThemeManager = {
    // Color mappings
    hoverColors: {
        '#6200EA': '#4A00B4',
        '#00BCD4': '#00ACC1',
        '#FFEB3B': '#FDD835',
        '#FF5252': '#E53935',
        '#F26419': '#D14F0F'
    },

    /**
     * Change the theme color across all elements
     * @param {string} color - Hex color code
     */
    changeColor(color) {
        // Set CSS custom properties
        document.documentElement.style.setProperty('--primary-color', color);
        
        // Set hover color
        if (this.hoverColors[color]) {
            document.documentElement.style.setProperty('--primary-hover', this.hoverColors[color]);
        }
        
        // Convert hex to rgba for secondary menu
        const rgba = this.hexToRgba(color, 0.9);
        document.documentElement.style.setProperty('--secondary-menu-bg', rgba);
        
        // Update elements directly for immediate effect
        this.updateElements(color, rgba);
    },

    /**
     * Convert hex color to rgba
     * @param {string} hex - Hex color code
     * @param {number} opacity - Opacity value (0-1)
     * @returns {string} - rgba string
     */
    hexToRgba(hex, opacity = 1) {
        const cleanHex = hex.replace('#', '');
        const r = parseInt(cleanHex.substr(0, 2), 16);
        const g = parseInt(cleanHex.substr(2, 2), 16);
        const b = parseInt(cleanHex.substr(4, 2), 16);
        
        return `rgba(${r}, ${g}, ${b}, ${opacity})`;
    },

    /**
     * Update DOM elements directly for immediate visual feedback
     * @param {string} color - Primary color
     * @param {string} rgba - RGBA color for secondary elements
     */
    updateElements(color, rgba) {
        // Update mobile header
        const mobileHeader = document.querySelector('.mobile-header');
        if (mobileHeader) {
            mobileHeader.style.backgroundColor = color;
        }
        
        // Update main sidebar
        const sidebar = document.getElementById('sidebar');
        if (sidebar) {
            sidebar.style.backgroundColor = color;
        }
        
        // Update secondary sidebar
        const secondarySidebar = document.getElementById('secondary-sidebar');
        if (secondarySidebar) {
            secondarySidebar.style.backgroundColor = rgba;
        }
    },

    /**
     * Get available theme colors
     * @returns {Object} - Available colors with names
     */
    getAvailableColors() {
        return {
            'Orange (Pantone)': '#F26419',
            'Electric Indigo': '#6200EA',
            'Moonstone': '#00BCD4',
            'Aureolin': '#FFEB3B',
            'Bittersweet': '#FF5252'
        };
    },

    /**
     * Initialize theme with default color
     * @param {string} defaultColor - Default color to apply
     */
    init(defaultColor = '#F26419') {
        this.changeColor(defaultColor);
    }
};

// Export for global access
window.ThemeManager = ThemeManager;