<style>
    .dashboard-container {
        min-height: 80vh;
        padding: 40px 20px;
        background-color: #f5f5f5;
    }
    
    .dashboard-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        gap: 30px;
    }
    
    /* Sidebar Styles */
    .dashboard-sidebar {
        width: 280px;
        background: white;
        border-radius: 16px;
        padding: 30px 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        height: fit-content;
        position: sticky;
        top: 20px;
    }
    
    .sidebar-header {
        padding: 0 30px 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
    }
    
    .sidebar-title {
        color: #6B46C1;
        font-size: 22px;
        font-weight: 600;
        margin: 0;
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-menu li {
        margin: 0;
    }
    
    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 30px;
        color: #333;
        text-decoration: none;
        font-size: 15px;
        transition: all 0.3s;
        border-left: 3px solid transparent;
    }
    
    .sidebar-menu a:hover {
        background-color: #f9f9f9;
        color: #6B46C1;
        border-left-color: #6B46C1;
    }
    
    .sidebar-menu a.active {
        background-color: #f0f0ff;
        color: #6B46C1;
        border-left-color: #6B46C1;
        font-weight: 500;
    }
    
    .sidebar-menu a i {
        width: 20px;
        text-align: center;
        font-size: 18px;
    }
    
    /* Main Content Styles */
    .dashboard-content {
        flex: 1;
        background: white;
        border-radius: 16px;
        padding: 40px;
        padding-bottom: 60px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        min-height: auto;
    }
    
    .dashboard-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .dashboard-title {
        color: #333;
        font-size: 28px;
        font-weight: 600;
        margin: 0 0 10px 0;
    }
    
    .dashboard-subtitle {
        color: #666;
        font-size: 14px;
        margin: 0;
    }
    
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 25px;
        color: white;
    }
    
    .stat-card.primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .stat-card.success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    .stat-card.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .stat-card.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 5px 0;
    }
    
    .stat-label {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state-icon {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .empty-state-title {
        font-size: 20px;
        color: #666;
        margin-bottom: 10px;
    }
    
    .empty-state-text {
        font-size: 14px;
        color: #999;
    }
    
    /* Fix footer positioning for guest dashboard pages - simple approach */
    body.guest-dashboard-page {
        position: relative;
    }
    
    body.guest-dashboard-page .wrapper {
        position: relative;
        min-height: 100vh;
    }
    
    /* Dashboard container - normal flow */
    body.guest-dashboard-page .dashboard-container {
        position: relative;
        margin-bottom: 40px;
        padding-bottom: 40px;
    }
    
    /* Footer - normal document flow, no floating */
    body.guest-dashboard-page #footer {
        position: relative !important;
        clear: both !important;
        margin-top: 40px !important;
        margin-bottom: 0 !important;
        float: none !important;
        z-index: 1 !important;
    }
    
    /* Footer sections */
    body.guest-dashboard-page #footer-top,
    body.guest-dashboard-page #footer-bottom {
        position: relative !important;
        float: none !important;
        clear: both !important;
    }
    
    /* Prevent mobile sidebar drawer from appearing on guest dashboard pages */
    body.guest-dashboard-page #sidebar {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        transform: translateX(100%) !important;
        left: -290px !important;
        right: -290px !important;
        pointer-events: none !important;
    }
    
    body.guest-dashboard-page #sidebar.active {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        left: -290px !important;
        right: -290px !important;
        pointer-events: none !important;
    }
    
    body.guest-dashboard-page .overlay {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
    
    body.guest-dashboard-page .overlay.active {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
    
    body.guest-dashboard-page #sidebarCollapse {
        pointer-events: none !important;
        opacity: 0.5 !important;
    }
    
    /* Ensure entire wrapper (and thus left menu) is above the booking cart drawer
       so clicks on sidebar links hit the menu, not the cart overlay. */
    body.guest-dashboard-page .wrapper {
        position: relative;
        z-index: 10001 !important;
    }
    /* Ensure dashboard content has its own stacking context */
    body.guest-dashboard-page .dashboard-container {
        position: relative;
        z-index: 1;
    }
    
    /* Ensure dashboard sidebar links work normally */
    body.guest-dashboard-page .dashboard-sidebar a {
        pointer-events: auto;
        cursor: pointer;
    }
    
    /* Ensure booking cart drawer never captures clicks from dashboard area */
    body.guest-dashboard-page .booking-cart-drawer:not(.active) {
        pointer-events: none !important;
    }
    body.guest-dashboard-page .global-floating-cart-btn {
        pointer-events: auto; /* keep button itself clickable */
    }
    
    /* Hide main site navigation and search bars on dashboard pages */
    body.guest-dashboard-page .mobile-header-erapper,
    body.guest-dashboard-page .mb-search-bar,
    body.guest-dashboard-page .search-button-sidebar,
    body.guest-dashboard-page .top-bar-area,
    body.guest-dashboard-page .booking-search-wrapper,
    body.guest-dashboard-page .sticky-top-search,
    body.guest-dashboard-page section.mobile-header-erapper,
    body.guest-dashboard-page section.mb-search-bar,
    body.guest-dashboard-page section.top-bar-area {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        height: 0 !important;
        max-height: 0 !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
    }
    
    /* Create clean dashboard header */
    body.guest-dashboard-page .dashboard-header-bar {
        background: white;
        border-bottom: 1px solid #eee;
        padding: 15px 0;
        margin-bottom: 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    body.guest-dashboard-page .dashboard-header-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    body.guest-dashboard-page .dashboard-header-logo {
        display: flex;
        align-items: center;
    }
    
    body.guest-dashboard-page .dashboard-header-logo a {
        display: flex;
        align-items: center;
        text-decoration: none;
    }
    
    body.guest-dashboard-page .dashboard-header-logo img {
        height: 40px;
        width: auto;
    }
    
    body.guest-dashboard-page .dashboard-header-user {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    body.guest-dashboard-page .dashboard-header-user span {
        color: #666;
        font-size: 14px;
    }
    
    body.guest-dashboard-page .dashboard-header-user a {
        color: #333;
        text-decoration: none;
        font-size: 14px;
        padding: 8px 15px;
        border-radius: 6px;
        transition: all 0.3s;
    }
    
    body.guest-dashboard-page .dashboard-header-user a:hover {
        color: #6B46C1;
        background-color: #f0f0ff;
    }
    
    body.guest-dashboard-page .dashboard-container {
        padding-top: 20px;
        margin-bottom: 60px !important;
        padding-bottom: 60px !important;
    }
    
    /* Adjust wrapper padding for dashboard */
    body.guest-dashboard-page .wrapper {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        display: flex !important;
        flex-direction: column !important;
    }
    
    /* Ensure proper spacing between dashboard and footer */
    body.guest-dashboard-page .dashboard-container + section#footer,
    body.guest-dashboard-page section#footer {
        margin-top: 60px !important;
        margin-bottom: 0 !important;
        position: relative !important;
        clear: both !important;
    }
    
    /* Ensure sections are hidden */
    body.guest-dashboard-page section.mobile-header-erapper,
    body.guest-dashboard-page section.mb-search-bar,
    body.guest-dashboard-page section.top-bar-area {
        display: none !important;
    }
    
    @@media (max-width: 768px) {
        .dashboard-wrapper {
            flex-direction: column;
        }
        
        .dashboard-sidebar {
            width: 100%;
            position: relative;
            top: 0;
        }
        
        .dashboard-stats {
            grid-template-columns: 1fr;
        }
        
        .dashboard-container {
            min-height: calc(100vh - 350px);
            padding: 20px 15px;
            padding-bottom: 100px;
            margin-bottom: 40px;
        }
        
        body.guest-dashboard-page .dashboard-container {
            margin-bottom: 60px;
            padding-bottom: 100px;
        }
        
        body.guest-dashboard-page .dashboard-header-bar {
            padding: 10px 0;
        }
        
        body.guest-dashboard-page .dashboard-header-content {
            padding: 0 15px;
            flex-wrap: wrap;
        }
        
        body.guest-dashboard-page .dashboard-header-logo img {
            height: 35px;
        }
        
        body.guest-dashboard-page .dashboard-header-user {
            font-size: 12px;
            gap: 10px;
        }
        
        body.guest-dashboard-page .dashboard-header-user span {
            display: none;
        }
    }
</style>

<script>
    // Add class to body for guest dashboard pages immediately
    (function() {
        document.body.classList.add('guest-dashboard-page');
        
        // Immediately prevent sidebar from opening
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.overlay');
            if (sidebar) {
                sidebar.classList.remove('active');
                sidebar.style.display = 'none';
                sidebar.style.visibility = 'hidden';
            }
            if (overlay) {
                overlay.classList.remove('active');
                overlay.style.display = 'none';
            }
        }
        
        // Close sidebar immediately
        closeSidebar();
        
        // Also prevent sidebar from opening on any click
        document.addEventListener('click', function(event) {
            // If clicking anywhere in dashboard area, ensure sidebar stays closed
            if (document.body.classList.contains('guest-dashboard-page')) {
                const target = event.target;
                // If clicking on dashboard sidebar links or any link in dashboard
                if (target.closest('.dashboard-sidebar') || 
                    target.closest('.dashboard-container') ||
                    target.tagName === 'A') {
                    closeSidebar();
                }
            }
        }, true); // Use capture phase
        
        // Hide main navigation sections immediately
        function hideMainNavigation() {
            const sectionsToHide = [
                '.mobile-header-erapper',
                'section.mobile-header-erapper',
                '.mb-search-bar',
                'section.mb-search-bar',
                '.search-button-sidebar',
                '.top-bar-area',
                'section.top-bar-area',
                '.booking-search-wrapper',
                '.sticky-top-search',
                '#stickyBar',
                '#searchBar'
            ];
            
            sectionsToHide.forEach(function(selector) {
                const elements = document.querySelectorAll(selector);
                elements.forEach(function(el) {
                    if (el) {
                        el.style.display = 'none';
                        el.style.visibility = 'hidden';
                        el.style.opacity = '0';
                        el.style.height = '0';
                        el.style.maxHeight = '0';
                        el.style.overflow = 'hidden';
                        el.style.margin = '0';
                        el.style.padding = '0';
                        el.style.border = 'none';
                    }
                });
            });
        }
        
        // Hide navigation immediately (before DOM loads)
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', hideMainNavigation);
        } else {
            hideMainNavigation();
        }
        
        // Also hide immediately
        hideMainNavigation();
        
        // Hide again after a short delay to catch any late-loading elements
        setTimeout(hideMainNavigation, 100);
        setTimeout(hideMainNavigation, 500);
        
        // Ensure footer is properly positioned after page load
        document.addEventListener('DOMContentLoaded', function() {
            // Hide navigation again after DOM loads
            hideMainNavigation();
            
            const footer = document.getElementById('footer');
            if (footer) {
                // Force footer to be relative positioned
                footer.style.position = 'relative';
                footer.style.bottom = 'auto';
                footer.style.top = 'auto';
                footer.style.left = 'auto';
                footer.style.right = 'auto';
                footer.style.zIndex = '1';
                
            // Ensure wrapper is flex and footer is at bottom
            const wrapper = document.querySelector('.wrapper');
            if (wrapper) {
                wrapper.style.display = 'flex';
                wrapper.style.flexDirection = 'column';
                wrapper.style.minHeight = '100vh';
            }
            
            // Ensure footer is properly positioned - simple approach
            const footer = document.getElementById('footer');
            if (footer) {
                footer.style.position = 'relative';
                footer.style.clear = 'both';
                footer.style.float = 'none';
                footer.style.marginTop = '40px';
            }
            
            const footerTop = document.getElementById('footer-top');
            const footerBottom = document.getElementById('footer-bottom');
            if (footerTop) {
                footerTop.style.position = 'relative';
                footerTop.style.float = 'none';
            }
            if (footerBottom) {
                footerBottom.style.position = 'relative';
                footerBottom.style.float = 'none';
            }
            }
            
            // Prevent sidebar drawer from opening when clicking dashboard navigation links
            const dashboardSidebar = document.querySelector('.dashboard-sidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.overlay');
            
            // Ensure sidebar stays closed on guest dashboard pages
            closeSidebar();
            
            // Function to prevent sidebar from opening
            function preventSidebarOpen(event) {
                if (event) {
                    event.stopPropagation();
                    event.stopImmediatePropagation();
                }
                closeSidebar();
            }
            
            if (dashboardSidebar) {
                // Prevent sidebar drawer from opening when clicking dashboard sidebar links
                const dashboardLinks = dashboardSidebar.querySelectorAll('a');
                dashboardLinks.forEach(function(link) {
                    // Remove ALL existing event listeners by cloning the node
                    const newLink = link.cloneNode(true);
                    link.parentNode.replaceChild(newLink, link);
                    
                    // Add our own handler that prevents sidebar opening
                    newLink.addEventListener('click', function(event) {
                        // Ensure sidebar stays closed
                        closeSidebar();
                        // Stop event propagation to prevent any parent handlers
                        event.stopPropagation();
                        event.stopImmediatePropagation();
                        // Allow normal navigation to proceed
                    }, true); // Use capture phase to run before other handlers
                    
                    // Also prevent on mousedown and touchstart
                    newLink.addEventListener('mousedown', preventSidebarOpen, true);
                    newLink.addEventListener('touchstart', preventSidebarOpen, true);
                });
            }
            
            // Prevent sidebar toggle button from working on guest dashboard pages
            const sidebarCollapse = document.getElementById('sidebarCollapse');
            if (sidebarCollapse) {
                // Clone and replace to remove all handlers
                const newButton = sidebarCollapse.cloneNode(true);
                sidebarCollapse.parentNode.replaceChild(newButton, sidebarCollapse);
                
                // Add handler that prevents sidebar opening
                newButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    event.stopImmediatePropagation();
                    closeSidebar();
                    return false;
                }, true); // Use capture phase
            }
            
            // Prevent sidebar from opening on any click in dashboard area
            const dashboardContainer = document.querySelector('.dashboard-container');
            if (dashboardContainer) {
                dashboardContainer.addEventListener('click', function(event) {
                    // If clicking on a link, ensure sidebar stays closed
                    if (event.target.tagName === 'A' || event.target.closest('a')) {
                        closeSidebar();
                    }
                }, true);
            }
            
            // Also handle jQuery events if jQuery is available
            if (typeof jQuery !== 'undefined') {
                jQuery(document).ready(function($) {
                    // Remove ALL handlers and prevent sidebar opening
                    $('#sidebarCollapse').off('click mousedown touchstart').on('click mousedown touchstart', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        e.stopImmediatePropagation();
                        closeSidebar();
                        return false;
                    });
                    
                    // Prevent sidebar from opening when clicking dashboard sidebar links
                    $('.dashboard-sidebar a').off('click mousedown touchstart').on('click mousedown touchstart', function(e) {
                        closeSidebar();
                        // Stop propagation but allow navigation
                        if (e.type !== 'click') {
                            e.stopPropagation();
                        }
                    });
                    
                    // Override the dismiss/overlay click handler
                    $('#dismiss, .overlay').off('click').on('click', function(e) {
                        closeSidebar();
                    });
                    
                    // Prevent sidebar from opening on document click
                    $(document).off('click.guest-dashboard').on('click.guest-dashboard', function(e) {
                        if ($(e.target).closest('.dashboard-sidebar').length || 
                            $(e.target).closest('.dashboard-container').length) {
                            closeSidebar();
                        }
                    });
                    
                    // Ensure sidebar stays closed
                    closeSidebar();
                });
            }
        });
    })();
</script>

