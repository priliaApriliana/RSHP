/* ===================================
   ADMIN DASHBOARD JAVASCRIPT
   =================================== */

// Toggle Sidebar Function
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
}

// Chart Configuration
document.addEventListener('DOMContentLoaded', function() {
    // Chart Layanan Bulanan
    const ctxLayanan = document.getElementById('layananChart');
    if (ctxLayanan) {
        new Chart(ctxLayanan.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Jumlah Layanan',
                    data: [12, 19, 15, 25, 22, 30],
                    borderColor: '#5F9EA0',
                    backgroundColor: 'rgba(95, 158, 160, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointRadius: 5,
                    pointBackgroundColor: '#5F9EA0',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(95, 158, 160, 0.9)',
                        padding: 12,
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 13
                        },
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(95, 158, 160, 0.1)'
                        },
                        ticks: {
                            color: '#666',
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#666',
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    }

    // Chart Jenis Hewan (Doughnut)
    const ctxJenis = document.getElementById('jenisHewanChart');
    if (ctxJenis) {
        new Chart(ctxJenis.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Anjing', 'Kucing', 'Lainnya'],
                datasets: [{
                    data: [45, 35, 20],
                    backgroundColor: [
                        '#5F9EA0',
                        '#7FB5B7',
                        '#A0D5D7'
                    ],
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 13
                            },
                            color: '#666',
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(95, 158, 160, 0.9)',
                        padding: 12,
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 13
                        },
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed + '%';
                                return label;
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
    }
});

// Active Menu Highlight
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const menuLinks = document.querySelectorAll('.menu-link');
    
    menuLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            // Remove active class from all links
            menuLinks.forEach(l => l.classList.remove('active'));
            // Add active class to current link
            link.classList.add('active');
        }
    });
});

// Smooth Scroll for Internal Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});