<style>
    /* Modern Footer Styling */
    .app-footer {
        background: linear-gradient(135deg, #F0F3FA 0%, #FFFFFF 100%) !important;
        border-top: 1px solid #D5DEEF !important;
        box-shadow: 0 -2px 15px rgba(57, 88, 134, 0.08) !important;
        padding: 20px 30px !important;
        color: #395886 !important;
        font-size: 14px !important;
        font-weight: 500 !important;
    }

    .app-footer strong {
        color: #395886 !important;
        font-weight: 700 !important;
    }

    .app-footer a {
        color: #628ECB !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        position: relative !important;
        padding-bottom: 2px !important;
    }

    .app-footer a::after {
        content: '' !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 0 !important;
        height: 2px !important;
        background: linear-gradient(90deg, #8AAEE0, #628ECB) !important;
        transition: width 0.3s ease !important;
    }

    .app-footer a:hover {
        color: #395886 !important;
    }

    .app-footer a:hover::after {
        width: 100% !important;
    }

    .app-footer .float-end {
        color: #8AAEE0 !important;
        font-weight: 600 !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .app-footer .float-end::before {
        content: '' !important;
        display: inline-block !important;
        width: 8px !important;
        height: 8px !important;
        background: linear-gradient(135deg, #8AAEE0, #628ECB) !important;
        border-radius: 50% !important;
        animation: pulse-dot 2s infinite !important;
    }

    @keyframes pulse-dot {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.2);
            opacity: 0.7;
        }
    }

    /* Footer Icons */
    .footer-icon {
        color: #628ECB !important;
        margin-right: 6px !important;
        font-size: 16px !important;
    }

    /* Responsive Footer */
    @media (max-width: 768px) {
        .app-footer {
            padding: 16px 20px !important;
            font-size: 13px !important;
            text-align: center !important;
        }

        .app-footer .float-end {
            float: none !important;
            display: block !important;
            margin-top: 8px !important;
            justify-content: center !important;
        }
    }

    /* Modern Footer Divider */
    .app-footer::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 5% !important;
        right: 5% !important;
        height: 2px !important;
        background: linear-gradient(90deg, transparent, #D5DEEF, transparent) !important;
    }
</style>

<footer class="app-footer">
    <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">
        <i class="bi bi-building footer-icon"></i>
        D4 Teknik Informatika
    </div>
    <!--end::To the end-->
    
    <!--begin::Copyright-->
    <strong>
        <i class="bi bi-c-circle footer-icon"></i>
        Copyright &copy; {{ date('Y') }}&nbsp;
        <a href="https://rshp.unair.ac.id" target="_blank">RSHP Universitas Airlangga</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer>