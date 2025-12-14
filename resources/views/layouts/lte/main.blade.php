<!doctype html>
<html lang="en">
<!--! — begin::Head — -->
@include('layouts.lte.head')
<!--! — end::Head — -->

<!-- Custom Modern Sidebar Color Palette CSS -->
<style>
    /* ============================================
       MODERN AESTHETIC SIDEBAR DESIGN
       Color Palette: #8AAEE0, #B1C9EF, #628ECB, #D5DEEF, #395886, #F0F3FA
       ============================================ */

    /* Sidebar Background with Modern Gradient */
    .app-sidebar {
        background: linear-gradient(180deg, #2c4a6d 0%, #4a6fa5 50%, #628ECB 100%) !important;
        border-right: none !important;
        box-shadow: 4px 0 20px rgba(57, 88, 134, 0.15) !important;
    }

    /* Modern Sidebar Brand */
    .sidebar-brand {
        background: linear-gradient(135deg, rgba(57, 88, 134, 0.4) 0%, rgba(98, 142, 203, 0.3) 100%) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        backdrop-filter: blur(10px) !important;
        padding: 20px 15px !important;
        margin-bottom: 10px !important;
    }

    .sidebar-brand .brand-link {
        color: #FFFFFF !important;
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        transition: all 0.3s ease !important;
    }

    .sidebar-brand .brand-link:hover {
        transform: translateX(2px) !important;
    }

    .sidebar-brand .brand-text {
        color: #FFFFFF !important;
        font-weight: 700 !important;
        font-size: 20px !important;
        letter-spacing: 0.5px !important;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
    }

    .sidebar-brand .brand-image {
        opacity: 1 !important;
        filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.2)) !important;
        transition: transform 0.3s ease !important;
    }

    .sidebar-brand .brand-link:hover .brand-image {
        transform: scale(1.05) !important;
    }

    /* Modern Nav Header */
    .nav-header {
        color: rgba(255, 255, 255, 0.5) !important;
        font-weight: 700 !important;
        font-size: 10px !important;
        letter-spacing: 1.5px !important;
        padding: 20px 15px 8px !important;
        text-transform: uppercase !important;
        position: relative !important;
    }

    .nav-header::after {
        content: '' !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 15px !important;
        right: 15px !important;
        height: 1px !important;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent) !important;
    }

    /* Modern Nav Items */
    .sidebar-menu .nav-item {
        margin: 3px 10px !important;
    }

    .sidebar-menu .nav-item .nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border-radius: 12px !important;
        padding: 12px 16px !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .sidebar-menu .nav-item .nav-link::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: -100% !important;
        width: 100% !important;
        height: 100% !important;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent) !important;
        transition: left 0.5s ease !important;
    }

    .sidebar-menu .nav-item .nav-link:hover::before {
        left: 100% !important;
    }

    .sidebar-menu .nav-item .nav-link:hover {
        background: rgba(255, 255, 255, 0.12) !important;
        color: #FFFFFF !important;
        transform: translateX(4px) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
    }

    /* Active Nav Link with Modern Gradient */
    .sidebar-menu .nav-item .nav-link.active {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%) !important;
        color: #FFFFFF !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 15px rgba(138, 174, 224, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.1) !important;
        border-radius: 12px !important;
        transform: translateX(0) !important;
    }

    .sidebar-menu .nav-item .nav-link.active::after {
        content: '' !important;
        position: absolute !important;
        right: 12px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 6px !important;
        height: 6px !important;
        background: #FFFFFF !important;
        border-radius: 50% !important;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.6) !important;
    }

    /* Modern Nav Icons */
    .sidebar-menu .nav-icon {
        color: rgba(255, 255, 255, 0.7) !important;
        font-size: 18px !important;
        margin-right: 12px !important;
        transition: all 0.3s ease !important;
    }

    .sidebar-menu .nav-link.active .nav-icon {
        color: #FFFFFF !important;
        transform: scale(1.1) !important;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2)) !important;
    }

    .sidebar-menu .nav-link:hover .nav-icon {
        color: #FFFFFF !important;
        transform: scale(1.05) !important;
    }

    /* Modern Nav Arrow */
    .nav-arrow {
        color: rgba(255, 255, 255, 0.5) !important;
        transition: all 0.3s ease !important;
        font-size: 14px !important;
    }

    .sidebar-menu .nav-link:hover .nav-arrow {
        color: #FFFFFF !important;
        transform: translateX(3px) !important;
    }

    .nav-item.menu-open .nav-arrow {
        transform: rotate(90deg) !important;
        color: #FFFFFF !important;
    }

    /* Modern Menu Open State */
    .nav-item.menu-open > .nav-link {
        background: rgba(255, 255, 255, 0.08) !important;
        color: #FFFFFF !important;
        border-radius: 12px !important;
    }

    /* Modern Treeview Menu */
    .nav-treeview {
        background: rgba(0, 0, 0, 0.15) !important;
        border-radius: 10px !important;
        margin: 5px 0 10px 0 !important;
        padding: 8px 0 !important;
        backdrop-filter: blur(5px) !important;
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
    }

    .nav-treeview .nav-item {
        margin: 2px 8px !important;
    }

    .nav-treeview .nav-item .nav-link {
        color: rgba(255, 255, 255, 0.75) !important;
        padding: 10px 16px 10px 40px !important;
        border-radius: 8px !important;
        position: relative !important;
    }

    .nav-treeview .nav-item .nav-link::before {
        content: '' !important;
        position: absolute !important;
        left: 20px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 4px !important;
        height: 4px !important;
        background: rgba(255, 255, 255, 0.4) !important;
        border-radius: 50% !important;
        transition: all 0.3s ease !important;
    }

    .nav-treeview .nav-item .nav-link:hover {
        background: rgba(255, 255, 255, 0.1) !important;
        color: #FFFFFF !important;
        padding-left: 44px !important;
    }

    .nav-treeview .nav-item .nav-link:hover::before {
        width: 6px !important;
        height: 6px !important;
        background: #FFFFFF !important;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.6) !important;
    }

    .nav-treeview .nav-item .nav-link.active {
        background: linear-gradient(135deg, rgba(138, 174, 224, 0.3) 0%, rgba(98, 142, 203, 0.4) 100%) !important;
        color: #FFFFFF !important;
        font-weight: 600 !important;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.1) !important;
    }

    .nav-treeview .nav-item .nav-link.active::before {
        background: #FFFFFF !important;
        width: 6px !important;
        height: 6px !important;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.8) !important;
    }

    .nav-treeview .nav-icon {
        display: none !important;
    }

    /* Modern Logout Button */
    .sidebar-menu .nav-item .nav-link .text-danger {
        color: #ff6b6b !important;
        transition: all 0.3s ease !important;
    }

    .sidebar-menu .nav-item .nav-link:hover .text-danger {
        color: #ff5252 !important;
        filter: drop-shadow(0 0 8px rgba(255, 82, 82, 0.6)) !important;
    }

    /* Modern Scrollbar */
    .sidebar-wrapper::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-wrapper::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    .sidebar-wrapper::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        transition: background 0.3s ease;
    }

    .sidebar-wrapper::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.35);
    }

    /* Text Styling */
    .sidebar-menu .nav-link p {
        font-size: 14px !important;
        font-weight: 500 !important;
        margin: 0 !important;
        letter-spacing: 0.3px !important;
    }

    .sidebar-menu .nav-link.active p {
        font-weight: 600 !important;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .app-sidebar {
            background: linear-gradient(180deg, #2c4a6d 0%, #4a6fa5 50%, #628ECB 100%) !important;
        }
        
        .sidebar-menu .nav-item {
            margin: 2px 8px !important;
        }
    }

    /* Dark Mode Compatibility */
    [data-bs-theme="dark"] .app-sidebar {
        background: linear-gradient(180deg, #2c4a6d 0%, #4a6fa5 50%, #628ECB 100%) !important;
    }

    /* Animation for menu items */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .sidebar-menu .nav-item {
        animation: slideIn 0.3s ease forwards;
    }

    .sidebar-menu .nav-item:nth-child(1) { animation-delay: 0.05s; }
    .sidebar-menu .nav-item:nth-child(2) { animation-delay: 0.1s; }
    .sidebar-menu .nav-item:nth-child(3) { animation-delay: 0.15s; }
    .sidebar-menu .nav-item:nth-child(4) { animation-delay: 0.2s; }
    .sidebar-menu .nav-item:nth-child(5) { animation-delay: 0.25s; }

    /* Glass morphism effect for brand */
    .sidebar-brand {
        position: relative !important;
    }

    .sidebar-brand::before {
        content: '' !important;
        position: absolute !important;
        inset: 0 !important;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%) !important;
        pointer-events: none !important;
    }
</style>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        <!--! — begin::Navbar — -->
        @include('layouts.lte.navbar')
        <!--! — end::Navbar — -->

        <!--! — begin::Sidebar — -->
        @include('layouts.lte.sidebar')
        <!--! — end::Sidebar — -->

        <!--! — begin::App Main — -->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('page-title')</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!--end::App Content-->
        </main>
        <!--! — end::App Main — -->

        <!--! — begin::Footer — -->
        @include('layouts.lte.footer')
        <!--! — end::Footer — -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

    <script src="{{ asset('assets/js/adminlte.js') }}"></script>

    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };

        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        crossorigin="anonymous"></script>

    @yield('scripts')
</body>
</html>
