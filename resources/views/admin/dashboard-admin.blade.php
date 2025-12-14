@extends('layouts.lte.main')

@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

<style>
/* ===============================
   DASHBOARD THEME – COLOR PALLET
================================ */
.app-content {
    background-color: #F0F3FA;
}

.small-box {
    border-radius: 18px;
    border: 1px solid #D5DEEE;
}

.text-bg-primary {
    background: linear-gradient(135deg, #395886, #628ECB) !important;
    color: #fff !important;
}

.text-bg-success {
    background: linear-gradient(135deg, #628ECB, #8AAEE0) !important;
    color: #fff !important;
}

.text-bg-warning {
    background: linear-gradient(135deg, #8AAEE0, #D5DEEE) !important;
    color: #395886 !important;
}

.text-bg-danger {
    background: linear-gradient(135deg, #395886, #8AAEE0) !important;
    color: #fff !important;
}

.small-box-footer {
    color: #F0F3FA !important;
}

.card {
    border-radius: 16px;
    border: 1px solid #D5DEEE;
}

.card-title {
    font-weight: 600;
    color: #395886;
}

.badge.text-bg-success {
    background-color: #628ECB !important;
}

.badge.text-bg-warning {
    background-color: #8AAEE0 !important;
    color: #395886 !important;
}

.badge.text-bg-info {
    background-color: #D5DEEE !important;
    color: #395886 !important;
}

.badge.text-bg-danger {
    background-color: #395886 !important;
}

.timeline .time-label span {
    background-color: #395886 !important;
}

.timeline i.bg-primary {
    background-color: #628ECB !important;
}

.timeline i.bg-success {
    background-color: #8AAEE0 !important;
}

.timeline i.bg-secondary {
    background-color: #D5DEEE !important;
    color: #395886;
}
</style>

<div class="app-content">
<div class="container-fluid">

{{-- ===================== STAT CARDS ===================== --}}
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3>150</h3>
                <p>New Orders</p>
            </div>
            <i class="bi bi-cart small-box-icon"></i>
            <a href="#" class="small-box-footer">
                More info <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3>53<sup class="fs-5">%</sup></h3>
                <p>Bounce Rate</p>
            </div>
            <i class="bi bi-graph-up small-box-icon"></i>
            <a href="#" class="small-box-footer">
                More info <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>User Registrations</p>
            </div>
            <i class="bi bi-person-plus small-box-icon"></i>
            <a href="#" class="small-box-footer">
                More info <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
            </div>
            <i class="bi bi-people small-box-icon"></i>
            <a href="#" class="small-box-footer">
                More info <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>
</div>

{{-- ===================== CHART & ORDERS ===================== --}}
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header border-0 d-flex justify-content-between">
                <h3 class="card-title">Sales</h3>
                <a href="#" class="link-primary">View Report</a>
            </div>
            <div class="card-body">
                <canvas id="sales-chart" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header border-0">
                <h3 class="card-title">Recent Orders</h3>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        Order #12345 <span class="badge text-bg-success">Complete</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Order #12346 <span class="badge text-bg-warning">Pending</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Order #12347 <span class="badge text-bg-info">Processing</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Order #12348 <span class="badge text-bg-danger">Cancelled</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- ===================== USERS & ACTIVITY ===================== --}}
<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Latest Users</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Name</th><th>Email</th><th>Status</th><th>Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td><span class="badge text-bg-success">Active</span></td>
                            <td>2 hours ago</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td><span class="badge text-bg-warning">Pending</span></td>
                            <td>5 hours ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Recent Activity</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="time-label">
                        <span>Today</span>
                    </div>
                    <div>
                        <i class="bi bi-envelope-fill bg-primary"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="bi bi-clock-fill"></i> 12:05</span>
                            <h3 class="timeline-header">New order received</h3>
                        </div>
                    </div>
                    <div>
                        <i class="bi bi-person-fill bg-success"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="bi bi-clock-fill"></i> 10:30</span>
                            <h3 class="timeline-header">New user registration</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

{{-- ===================== CHART JS ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('sales-chart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [
                {
                    label: 'This Year',
                    data: [28,48,40,19,86,27,90,45,65,78,92,105],
                    borderColor: '#395886',
                    backgroundColor: 'rgba(57,88,134,0.15)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Last Year',
                    data: [15,35,30,25,45,35,55,40,50,60,70,80],
                    borderColor: '#8AAEE0',
                    backgroundColor: 'rgba(138,174,224,0.2)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
});
</script>

@endsection
