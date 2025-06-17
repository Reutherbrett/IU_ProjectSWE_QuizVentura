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

// Add event listeners for main menu items
function initializeNavItems() {
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            const color = item.getAttribute('data-color');
            const content = item.getAttribute('data-content');

            if (color && content) {
                handleMenuClick(color, content);

                // Update the URL for deep linking
                const newUrl = `index2.php?page=${content}`;
                history.pushState({ page: `pages/${content}.php` }, '', newUrl);

                // Close mobile menu if open
                const sidebar = document.getElementById('sidebar');
                const backdrop = document.querySelector('.menu-backdrop');
                if (sidebar && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    backdrop.classList.remove('active');
                }
            }
        });
    });
}

// Function to handle menu clicks
// Update the existing handleMenuClick function to work with AJAX
function handleMenuClick(color, content) {
    // Hide all sidebar contents
    document.querySelectorAll('.sidebar-content').forEach(el => {
        el.style.display = 'none';
    });

    // Show selected content
    const selectedContent = document.getElementById('content-' + content);
    if (selectedContent) {
        selectedContent.style.display = 'block';
    }

    // Update secondary sidebar color
    const secondarySidebar = document.getElementById('secondary-sidebar');
    if (secondarySidebar) {
        secondarySidebar.style.backgroundColor = color;
    }

    // Update theme color
    changeThemeColor(color);
}

// Function to show specific content
function showSidebarContent(contentId) {
    document.querySelectorAll('.sidebar-content').forEach(content => {
        content.style.display = 'none';
    });

    const selectedContent = document.getElementById(`content-${contentId}`);
    if (selectedContent) {
        selectedContent.style.display = 'block';
    }
}

// Load page via AJAX
function loadPage(url, updateHistory = true) {
    const mainContent = document.getElementById('main-content');
    mainContent.style.opacity = '0.5';

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Page not found');
            return response.text();
        })
        .then(html => {
            mainContent.innerHTML = html;
            mainContent.style.opacity = '1';

            if (updateHistory) {
                const cleanUrl = 'index2.php?page=' + url.replace('pages/', '').replace('.php', '');
                history.pushState({ page: url }, '', cleanUrl);
            }

            initializeNewContent();
        })
        .catch(error => {
            console.error('Error loading page:', error);
            mainContent.innerHTML = '<div class="error">Fehler beim Laden der Seite.</div>';
            mainContent.style.opacity = '1';
        });
}

// Reinitialize dynamic content
function initializeNewContent() {
    // Add anything needed for dynamic pages
}

function initializeProfileCards() {
    const profileCards = document.querySelectorAll('.profile-card');

    profileCards.forEach(card => {
        card.style.cursor = 'pointer';

        card.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const pageUrl = this.dataset.page;

            if (pageUrl) {
                loadPage(pageUrl, true);
            }
        });
    });
}

// Unified DOMContentLoaded block
document.addEventListener('DOMContentLoaded', function () {
    initializeProfileCards();
    initializeNavItems();

    const backdrop = document.querySelector('.menu-backdrop');
    if (backdrop) backdrop.addEventListener('click', toggleMenu);

    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) menuToggle.addEventListener('click', toggleMenu);

    // Stelle den Menüzustand bei Reload her
    const urlParams = new URLSearchParams(window.location.search);
    const pageParam = urlParams.get('page');

    if (pageParam) {
        const contentKey = pageParam.split('/')[0];
        const activeItem = document.querySelector(`.nav-item[data-content="${contentKey}"]`);
        if (activeItem) {
            const color = activeItem.getAttribute('data-color');
            handleMenuClick(color, contentKey);
        }
    } else {
        // Fallback
        showSidebarContent('home');
    }

    // Handle back/forward browser navigation
    window.addEventListener('popstate', function (e) {
        if (e.state && e.state.page) {
            loadPage(e.state.page, false);
        }
    });
});