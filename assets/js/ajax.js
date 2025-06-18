/**
 * AJAX and Page Loading Management
 * Optimized version without history management for better performance
 */

const AjaxManager = {
    // Cache for loaded content (optional - can be disabled)
    contentCache: new Map(),
    maxCacheSize: 5, // Limit cache size to prevent memory bloat
    
    // Track active requests to prevent duplicate calls
    activeRequests: new Set(),

    /**
     * Create XMLHttpRequest object with Safari compatibility
     * @returns {XMLHttpRequest|null}
     */
    createXHR() {
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
    },

    /**
     * Enhanced fetch with Safari compatibility and performance optimization
     * @param {string} url - URL to fetch
     * @param {Object} options - Fetch options
     * @returns {Promise}
     */
    safeFetch(url, options = {}) {
        // Check if request is already in progress
        if (this.activeRequests.has(url)) {
            return Promise.reject(new Error('Request already in progress'));
        }

        // Check cache first (if enabled)
        if (this.contentCache.has(url)) {
            return Promise.resolve(this.contentCache.get(url));
        }

        this.activeRequests.add(url);

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
        
        const cleanup = () => {
            this.activeRequests.delete(url);
        };

        if (typeof fetch !== 'undefined') {
            return fetch(url, finalOptions)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.text();
                })
                .then(html => {
                    this.addToCache(url, html);
                    return html;
                })
                .finally(cleanup);
        } else {
            return new Promise((resolve, reject) => {
                const xhr = this.createXHR();
                if (!xhr) {
                    cleanup();
                    reject(new Error('XMLHttpRequest not supported'));
                    return;
                }
                
                xhr.open(finalOptions.method, url, true);
                
                if (finalOptions.headers) {
                    Object.keys(finalOptions.headers).forEach(key => {
                        xhr.setRequestHeader(key, finalOptions.headers[key]);
                    });
                }
                
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            AjaxManager.addToCache(url, xhr.responseText);
                            resolve(xhr.responseText);
                        } else {
                            reject(new Error(`HTTP ${xhr.status}: ${xhr.statusText}`));
                        }
                        cleanup();
                    }
                };
                
                xhr.onerror = function() {
                    cleanup();
                    reject(new Error('Network error'));
                };
                
                xhr.send(finalOptions.body || null);
            });
        }
    },

    /**
     * Add content to cache with size management
     * @param {string} url - URL key
     * @param {string} content - HTML content
     */
    addToCache(url, content) {
        // Manage cache size
        if (this.contentCache.size >= this.maxCacheSize) {
            const firstKey = this.contentCache.keys().next().value;
            this.contentCache.delete(firstKey);
        }
        
        this.contentCache.set(url, content);
    },

    /**
     * Clear cache to free memory
     */
    clearCache() {
        this.contentCache.clear();
    },

    /**
     * Load page via AJAX with performance optimization
     * @param {string} url - Page URL to load
     */
    loadPage(url) {
        const mainContent = document.getElementById('main-content');
        if (!mainContent) {
            console.error('Main content element not found');
            return;
        }
        
        // Clean up previous content to prevent memory leaks
        this.cleanupContent(mainContent);
        
        // Show loading state
        this.showLoadingState(mainContent);
        
        // Simple URL without timestamp (rely on cache headers instead)
        this.safeFetch(url)
            .then(html => {
                this.updateContent(mainContent, html);
                this.initializeNewContent();
            })
            .catch(error => {
                this.showErrorState(mainContent, error);
            });
    },

    /**
     * Clean up content to prevent memory leaks
     * @param {HTMLElement} element - Content element
     */
    cleanupContent(element) {
        // Remove all event listeners from child elements
        const elementsWithListeners = element.querySelectorAll('[data-has-listeners]');
        elementsWithListeners.forEach(el => {
            el.removeAttribute('data-has-listeners');
            // Clone and replace to remove all event listeners
            const newEl = el.cloneNode(true);
            el.parentNode.replaceChild(newEl, el);
        });

        // Clear any timers or intervals that might be running
        if (element._timers) {
            element._timers.forEach(timer => clearTimeout(timer));
            delete element._timers;
        }

        if (element._intervals) {
            element._intervals.forEach(interval => clearInterval(interval));
            delete element._intervals;
        }
    },

    /**
     * Show loading state
     * @param {HTMLElement} element - Content element
     */
    showLoadingState(element) {
        element.style.opacity = '0.5';
        element.setAttribute('aria-busy', 'true');
    },

    /**
     * Update content and restore normal state
     * @param {HTMLElement} element - Content element
     * @param {string} html - New HTML content
     */
    updateContent(element, html) {
        element.innerHTML = html;
        element.style.opacity = '1';
        element.removeAttribute('aria-busy');
    },

    /**
     * Show error state
     * @param {HTMLElement} element - Content element
     * @param {Error} error - Error object
     */
    showErrorState(element, error) {
        console.error('Error loading page:', error);
        element.innerHTML = '<div class="error">Fehler beim Laden der Seite.</div>';
        element.style.opacity = '1';
        element.removeAttribute('aria-busy');
    },

    /**
     * Initialize JavaScript for dynamically loaded content
     */
    initializeNewContent() {
        // Only initialize new profile cards that haven't been initialized yet
        if (window.MenuManager) {
            const uninitializedCards = document.querySelectorAll('.profile-card:not([data-card-initialized])');
            if (uninitializedCards.length > 0) {
                window.MenuManager.initializeNavigation();
            }
        }
    },

    /**
     * Initialize AJAX manager (simplified - no history)
     */
    init() {
        // Optional: Clear cache periodically to prevent memory bloat
        setInterval(() => {
            if (this.contentCache.size > 0) {
                console.log('Clearing AJAX cache to free memory');
                this.clearCache();
            }
        }, 300000); // Clear every 5 minutes

        // Handle page visibility changes (Safari optimization)
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                // Page became visible - clear cache if it's getting large
                if (this.contentCache.size >= this.maxCacheSize) {
                    this.clearCache();
                }
            }
        });
    }
};

// Export for global access
window.AjaxManager = AjaxManager;