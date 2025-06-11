/**
 * AJAX and Page Loading Management
 * Handles all AJAX requests and dynamic page loading with Safari optimization
 */

const AjaxManager = {
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
     * Enhanced fetch with Safari compatibility
     * @param {string} url - URL to fetch
     * @param {Object} options - Fetch options
     * @returns {Promise}
     */
    safeFetch(url, options = {}) {
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
                const xhr = this.createXHR();
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
    },

    /**
     * Load page via AJAX with Safari optimization
     * @param {string} url - Page URL to load
     * @param {boolean} updateHistory - Whether to update browser history
     */
    loadPage(url, updateHistory = true) {
        const mainContent = document.getElementById('main-content');
        if (!mainContent) {
            console.error('Main content element not found');
            return;
        }
        
        // Show loading state
        this.showLoadingState(mainContent);
        
        // Add timestamp to prevent Safari caching issues
        const separator = url.includes('?') ? '&' : '?';
        const urlWithTimestamp = `${url}${separator}_t=${Date.now()}`;
        
        this.safeFetch(urlWithTimestamp)
            .then(html => {
                this.updateContent(mainContent, html);
                
                if (updateHistory) {
                    this.updateHistory(url);
                }
                
                this.initializeNewContent();
            })
            .catch(error => {
                this.showErrorState(mainContent, error);
            });
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
     * Update browser history
     * @param {string} url - Page URL
     */
    updateHistory(url) {
        if (window.history && window.history.pushState) {
            try {
                const cleanUrl = 'index.php?page=' + url.replace('pages/', '').replace('.php', '');
                window.history.pushState({page: url}, '', cleanUrl);
            } catch (e) {
                console.warn('History API not fully supported:', e);
            }
        }
    },

    /**
     * Initialize JavaScript for dynamically loaded content
     */
    initializeNewContent() {
        // Re-initialize any form handlers, event listeners, etc.
        // This is where you'd add code to handle newly loaded content
        
        // Example: Re-initialize tooltips, form validation, etc.
        if (window.MenuManager) {
            window.MenuManager.initializeNavigation();
        }
    },

    /**
     * Initialize AJAX manager
     */
    init() {
        // Handle browser back/forward buttons
        if (window.history && window.history.pushState) {
            window.addEventListener('popstate', (e) => {
                if (e.state && e.state.page) {
                    this.loadPage(e.state.page, false);
                }
            });
        }

        // Handle page visibility changes (Safari optimization)
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                // Page became visible, refresh any dynamic content if needed
                // This helps with Safari's aggressive caching
            }
        });
    }
};

// Export for global access
window.AjaxManager = AjaxManager;