<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - TrackIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #dc2626;
            --dark-red: #991b1b;
            --light-red: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(220, 38, 38, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-red) !important;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-red) !important;
        }

        .top-nav {
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 0;
            border-bottom: 3px solid rgba(220, 38, 38, 0.1);
        }

        .top-nav .nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            flex-wrap: wrap;
        }

        .top-nav .nav-link {
            color: #6b7280;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 2px solid transparent;
        }

        .top-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary-red);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .top-nav .nav-link:hover::before,
        .top-nav .nav-link.active::before {
            transform: scaleX(1);
        }

        .top-nav .nav-link:hover,
        .top-nav .nav-link.active {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
            color: var(--primary-red) !important;
            border-color: rgba(220, 38, 38, 0.2);
            transform: translateY(-2px);
        }

        .top-nav .nav-link i {
            font-size: 1.1rem;
        }

        .main-content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .content-wrapper {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.9rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: #6b7280;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-red) 0%, #ef4444 100%);
            transform: scaleX(0);
            transition: transform 0.4s;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(220, 38, 38, 0.15);
            border-color: rgba(220, 38, 38, 0.2);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
            transition: all 0.3s;
            position: relative;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-icon.red {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.15) 0%, rgba(239, 68, 68, 0.1) 100%);
            color: var(--primary-red);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.2);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.1) 100%);
            color: #3b82f6;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(74, 222, 128, 0.1) 100%);
            color: #22c55e;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.2);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(251, 146, 60, 0.1) 100%);
            color: #f97316;
            box-shadow: 0 4px 15px rgba(249, 115, 22, 0.2);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #1f2937;
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .stat-trend {
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .stat-trend.up {
            color: #22c55e;
        }

        .stat-trend.down {
            color: #ef4444;
        }

        .card-custom {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.05);
            overflow: hidden;
            transition: all 0.3s;
        }

        .card-custom:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .card-custom .card-header {
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            border-bottom: 2px solid rgba(220, 38, 38, 0.1);
            padding: 1.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            color: #1f2937;
            position: relative;
        }

        .card-custom .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-red) 0%, transparent 100%);
        }

        .table-custom {
            margin-bottom: 0;
        }

        .table-custom thead {
            background: #f8f9fa;
        }

        .table-custom th {
            border-bottom: 2px solid #e5e7eb;
            color: #6b7280;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            padding: 1rem;
        }

        .table-custom td {
            padding: 1rem;
            vertical-align: middle;
            color: #374151;
        }

        .table-custom tbody tr {
            cursor: pointer;
            transition: all 0.3s;
        }

        .table-custom tbody tr:hover {
            background-color: #f3f4f6;
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .badge-status {
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            border: 1px solid;
            transition: all 0.3s;
        }

        .badge-status:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .badge-delivered {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(34, 197, 94, 0.05) 100%);
            color: #16a34a;
            border-color: rgba(34, 197, 94, 0.3);
        }

        .badge-in-transit {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.05) 100%);
            color: #2563eb;
            border-color: rgba(59, 130, 246, 0.3);
        }

        .badge-pending {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(249, 115, 22, 0.05) 100%);
            color: #ea580c;
            border-color: rgba(249, 115, 22, 0.3);
        }

        .badge-delayed {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.05) 100%);
            color: #dc2626;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .btn-action {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.85rem;
            margin: 0 0.2rem;
        }

        .btn-primary {
            background: var(--primary-red);
            border: none;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--dark-red);
            transform: translateY(-2px);
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            display: inline-block;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-red) 0%, #ef4444 100%);
            border-radius: 2px;
        }

        .page-subtitle {
            color: #6b7280;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary-red);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        .activity-item {
            cursor: pointer;
            transition: all 0.3s;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .activity-item:hover {
            background-color: #f3f4f6;
            transform: translateX(5px);
        }

        .quick-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .quick-action-btn {
            flex: 1;
            padding: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            border: 2px solid transparent;
            border-radius: 16px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.9rem;
            color: #333;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .quick-action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(220, 38, 38, 0.1), transparent);
            transition: left 0.5s;
        }

        .quick-action-btn:hover::before {
            left: 100%;
        }

        .quick-action-btn:hover {
            border-color: var(--primary-red);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(220, 38, 38, 0.2);
            background: linear-gradient(135deg, #fff 0%, #fef2f2 100%);
        }

        .quick-action-btn i {
            font-size: 1.5rem;
            color: var(--primary-red);
            display: block;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .top-nav .nav {
                justify-content: flex-start;
                overflow-x: auto;
                flex-wrap: nowrap;
            }
            
            .top-nav .nav-link {
                white-space: nowrap;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="#"><i class="fas fa-shipping-fast"></i> TrackIt Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-bell"></i> <span class="badge bg-danger">5</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar me-2">AD</div>
                            Admin User
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                    @csrf
                                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Horizontal Navigation Menu -->
    <div class="top-nav">
        <nav class="nav">
            <a class="nav-link active" href="#" onclick="showSection('dashboard')">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#shipmentsModal">
                <i class="fas fa-box"></i> Shipments
            </a>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#customersModal">
                <i class="fas fa-users"></i> Customers
            </a>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#carriersModal">
                <i class="fas fa-truck"></i> Carriers
            </a>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#statusUpdatesModal">
                <i class="fas fa-sync-alt"></i> Status Updates
            </a>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#deliveryConfirmationsModal">
                <i class="fas fa-clipboard-check"></i> Deliveries
            </a>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#reportsModal">
                <i class="fas fa-file-alt"></i> Reports
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-cog"></i> Settings
            </a>
        </nav>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Main Content - Full Width -->
            <div class="col-12">
                <div class="main-content">
                    <!-- Page Header with Breadcrumb -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="page-header">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-2">
                                    <li class="breadcrumb-item"><a href="#" style="color: var(--primary-red); text-decoration: none;">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                            <h1 class="page-title">{{ __('Dashboard Overview') }}</h1>
                            <p class="page-subtitle">{{ __('Welcome back, Admin! Here\'s what\'s happening today.') }}</p>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary me-2" onclick="window.print()">
                                <i class="fas fa-print me-2"></i>Print
                            </button>
                            <button class="btn btn-primary" onclick="exportData()">
                                <i class="fas fa-download me-2"></i>Export
                            </button>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="quick-actions">
                        <button type="button" class="quick-action-btn" data-bs-toggle="modal" data-bs-target="#addShipmentModal">
                            <i class="fas fa-plus-circle"></i>
                            <div>Add Shipment</div>
                        </button>
                        <button type="button" class="quick-action-btn" onclick="exportData()">
                            <i class="fas fa-file-export"></i>
                            <div>Export Data</div>
                        </button>
                        <button type="button" class="quick-action-btn" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                            <i class="fas fa-user-plus"></i>
                            <div>Add Customer</div>
                        </button>
                        <button type="button" class="quick-action-btn" data-bs-toggle="modal" data-bs-target="#sendAlertModal">
                            <i class="fas fa-bell"></i>
                            <div>Send Alert</div>
                        </button>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon red">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="stat-number">1,234</div>
                                <div class="stat-label">Total Shipments</div>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i> 12% from last month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon blue">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="stat-number">567</div>
                                <div class="stat-label">In Transit</div>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i> 8% increase
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon green">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-number">892</div>
                                <div class="stat-label">Delivered Today</div>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i> 15% increase
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon orange">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="stat-number">23</div>
                                <div class="stat-label">Delayed</div>
                                <div class="stat-trend down">
                                    <i class="fas fa-arrow-down"></i> 5% decrease
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Shipments Table -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card-custom">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-list me-2"></i>Recent Shipments</span>
                                    <button class="btn btn-primary btn-sm">View All</button>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-custom">
                                            <thead>
                                                <tr>
                                                    <th>Shipment ID</th>
                                                    <th>Recipient Name</th>
                                                    <th>Recipient Contact</th>
                                                    <th>Delivery Address</th>
                                                    <th>Status</th>
                                                    <th>Created Date</th>
                                                    <th>Dispatched Date</th>
                                                    <th>Delivered Date</th>
                                                    <th>Courier ID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>SHIP-001234</strong></td>
                                                    <td>John Doe</td>
                                                    <td>+1 (555) 123-4567</td>
                                                    <td>123 Main St, New York, NY 10001</td>
                                                    <td><span class="badge-status badge-in-transit">In Transit</span></td>
                                                    <td>Nov 28, 2025</td>
                                                    <td>Nov 29, 2025</td>
                                                    <td>-</td>
                                                    <td>COU-001</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>SHIP-001235</strong></td>
                                                    <td>Jane Smith</td>
                                                    <td>+1 (555) 234-5678</td>
                                                    <td>456 Ocean Ave, Miami, FL 33101</td>
                                                    <td><span class="badge-status badge-delivered">Delivered</span></td>
                                                    <td>Nov 26, 2025</td>
                                                    <td>Nov 27, 2025</td>
                                                    <td>Nov 30, 2025</td>
                                                    <td>COU-002</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>SHIP-001236</strong></td>
                                                    <td>Bob Johnson</td>
                                                    <td>+1 (555) 345-6789</td>
                                                    <td>789 Park Rd, Boston, MA 02108</td>
                                                    <td><span class="badge-status badge-pending">Pending</span></td>
                                                    <td>Nov 30, 2025</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>SHIP-001237</strong></td>
                                                    <td>Alice Williams</td>
                                                    <td>+1 (555) 456-7890</td>
                                                    <td>321 Mountain Dr, Denver, CO 80202</td>
                                                    <td><span class="badge-status badge-delayed">Delayed</span></td>
                                                    <td>Nov 25, 2025</td>
                                                    <td>Nov 26, 2025</td>
                                                    <td>-</td>
                                                    <td>COU-003</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>SHIP-001238</strong></td>
                                                    <td>Michael Brown</td>
                                                    <td>+1 (555) 567-8901</td>
                                                    <td>654 Peachtree St, Atlanta, GA 30303</td>
                                                    <td><span class="badge-status badge-in-transit">In Transit</span></td>
                                                    <td>Nov 27, 2025</td>
                                                    <td>Nov 28, 2025</td>
                                                    <td>-</td>
                                                    <td>COU-001</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="card-custom">
                                <div class="card-header">
                                    <i class="fas fa-chart-line me-2"></i>Shipment Trends
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="shipmentChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-custom">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-2"></i>Status Distribution
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="statusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top Carriers -->
                    <div class="row g-4 mt-1">
                        <div class="col-md-6">
                            <div class="card-custom">
                                <div class="card-header">
                                    <i class="fas fa-truck me-2"></i>Top Carriers
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <strong>FedEx</strong>
                                            <div class="text-muted small">456 shipments</div>
                                        </div>
                                        <div class="progress" style="width: 60%; height: 8px;">
                                            <div class="progress-bar bg-danger" style="width: 85%"></div>
                                        </div>
                                        <span class="text-muted">85%</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <strong>UPS</strong>
                                            <div class="text-muted small">389 shipments</div>
                                        </div>
                                        <div class="progress" style="width: 60%; height: 8px;">
                                            <div class="progress-bar bg-danger" style="width: 72%"></div>
                                        </div>
                                        <span class="text-muted">72%</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <strong>USPS</strong>
                                            <div class="text-muted small">234 shipments</div>
                                        </div>
                                        <div class="progress" style="width: 60%; height: 8px;">
                                            <div class="progress-bar bg-danger" style="width: 55%"></div>
                                        </div>
                                        <span class="text-muted">55%</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>DHL</strong>
                                            <div class="text-muted small">155 shipments</div>
                                        </div>
                                        <div class="progress" style="width: 60%; height: 8px;">
                                            <div class="progress-bar bg-danger" style="width: 35%"></div>
                                        </div>
                                        <span class="text-muted">35%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-custom">
                                <div class="card-header">
                                    <i class="fas fa-clock me-2"></i>Recent Activity
                                </div>
                                <div class="card-body">
                                    <div class="d-flex mb-3 activity-item" onclick="trackDelivery('TRK-001235')">
                                        <div class="flex-shrink-0">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-check text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Package Delivered</h6>
                                            <p class="text-muted mb-0 small"><strong>TRK-001235</strong> delivered to Maria Santos</p>
                                            <span class="text-muted small">2 minutes ago</span>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 activity-item" onclick="trackDelivery('TRK-001234')">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-truck text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Shipment Updated</h6>
                                            <p class="text-muted mb-0 small"><strong>TRK-001234</strong> now in transit</p>
                                            <span class="text-muted small">15 minutes ago</span>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 activity-item" onclick="trackDelivery('TRK-001237')">
                                        <div class="flex-shrink-0">
                                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-exclamation text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Delay Alert</h6>
                                            <p class="text-muted mb-0 small"><strong>TRK-001237</strong> delayed due to weather</p>
                                            <span class="text-muted small">1 hour ago</span>
                                        </div>
                                    </div>
                                    <div class="d-flex activity-item" onclick="alert('Customer Details: Miguel Ramos registered 3 hours ago')">
                                        <div class="flex-shrink-0">
                                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">New Customer</h6>
                                            <p class="text-muted mb-0 small"><strong>Miguel Ramos</strong> registered</p>
                                            <span class="text-muted small">3 hours ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Customer Modal -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Add New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="customerAlert" class="alert" style="display: none;"></div>
                    <form id="addCustomerForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="customer_name" name="name" placeholder="Enter customer full name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="customer_email" name="email" placeholder="customer@email.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" id="customer_phone" name="phone" placeholder="+1 (555) 000-0000" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="customer_company" name="company" placeholder="Company name (optional)">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Address *</label>
                                <input type="text" class="form-control" id="customer_address" name="address" placeholder="Street address" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">City *</label>
                                <input type="text" class="form-control" id="customer_city" name="city" placeholder="City" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">State *</label>
                                <input type="text" class="form-control" id="customer_state" name="state" placeholder="State" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">ZIP Code *</label>
                                <input type="text" class="form-control" id="customer_zip" name="zip_code" placeholder="ZIP" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" id="customer_notes" name="notes" rows="3" placeholder="Additional customer notes..."></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitCustomerBtn">Add Customer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Shipment Modal -->
    <div class="modal fade" id="addShipmentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Add New Shipment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="shipmentAlert" class="alert" style="display: none;"></div>
                    <form id="addShipmentForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tracking Number</label>
                                <input type="text" class="form-control" placeholder="Auto-generated" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Origin *</label>
                                <input type="text" class="form-control" id="origin" name="origin" placeholder="Origin city" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Destination *</label>
                                <input type="text" class="form-control" id="destination" name="destination" placeholder="Destination city" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Carrier *</label>
                                <select class="form-select" id="carrier" name="carrier" required>
                                    <option value="">Select carrier</option>
                                    <option value="FedEx">FedEx</option>
                                    <option value="UPS">UPS</option>
                                    <option value="USPS">USPS</option>
                                    <option value="DHL">DHL</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Estimated Delivery *</label>
                                <input type="date" class="form-control" id="estimated_delivery" name="estimated_delivery" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Additional notes..."></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitShipmentBtn">Add Shipment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Carriers List Modal -->
    <div class="modal fade" id="carriersModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-truck me-2"></i>All Carriers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="input-group" style="max-width: 300px;">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search carriers...">
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarrierModal">
                            <i class="fas fa-plus me-2"></i>Add New Carrier
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Carrier ID</th>
                                    <th>Name</th>
                                    <th>Contact Info</th>
                                    <th>Assigned Zone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>CAR-001</strong></td>
                                    <td>Jose Mendoza</td>
                                    <td>
                                        <div><i class="fas fa-envelope me-1"></i> john.williams@fedex.com</div>
                                        <div><i class="fas fa-phone me-1"></i> +1 (800) 463-3339</div>
                                    </td>
                                    <td>North America - West Coast</td>
                                </tr>
                                <tr>
                                    <td><strong>CAR-002</strong></td>
                                    <td>Sarah Martinez</td>
                                    <td>
                                        <div><i class="fas fa-envelope me-1"></i> sarah.martinez@ups.com</div>
                                        <div><i class="fas fa-phone me-1"></i> +1 (800) 742-5877</div>
                                    </td>
                                    <td>North America - East Coast</td>
                                </tr>
                                <tr>
                                    <td><strong>CAR-003</strong></td>
                                    <td>Miguel Santos</td>
                                    <td>
                                        <div><i class="fas fa-envelope me-1"></i> michael.johnson@usps.com</div>
                                        <div><i class="fas fa-phone me-1"></i> +1 (800) 275-8777</div>
                                    </td>
                                    <td>North America - Central</td>
                                </tr>
                                <tr>
                                    <td><strong>CAR-004</strong></td>
                                    <td>Elena Torres</td>
                                    <td>
                                        <div><i class="fas fa-envelope me-1"></i> emma.davis@dhl.com</div>
                                        <div><i class="fas fa-phone me-1"></i> +1 (800) 225-5345</div>
                                    </td>
                                    <td>International - Europe</td>
                                </tr>
                                <tr>
                                    <td><strong>CAR-005</strong></td>
                                    <td>David Bautista</td>
                                    <td>
                                        <div><i class="fas fa-envelope me-1"></i> david.brown@amazon.com</div>
                                        <div><i class="fas fa-phone me-1"></i> +1 (888) 280-4331</div>
                                    </td>
                                    <td>North America - Southwest</td>
                                </tr>
                                <tr>
                                    <td><strong>CAR-006</strong></td>
                                    <td>Lisa Aquino</td>
                                    <td>
                                        <div><i class="fas fa-envelope me-1"></i> lisa.anderson@ontrac.com</div>
                                        <div><i class="fas fa-phone me-1"></i> +1 (800) 334-5000</div>
                                    </td>
                                    <td>North America - Northwest</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Carrier Modal -->
    <div class="modal fade" id="addCarrierModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-truck me-2"></i>Add New Carrier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Company Name *</label>
                                <input type="text" class="form-control" placeholder="Enter carrier company name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Person *</label>
                                <input type="text" class="form-control" placeholder="Full name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address *</label>
                                <input type="email" class="form-control" placeholder="carrier@email.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" placeholder="+1 (800) 000-0000" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Address *</label>
                                <input type="text" class="form-control" placeholder="Street address" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">City *</label>
                                <input type="text" class="form-control" placeholder="City" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">State *</label>
                                <input type="text" class="form-control" placeholder="State" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">ZIP Code *</label>
                                <input type="text" class="form-control" placeholder="ZIP" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Service Type</label>
                                <select class="form-select">
                                    <option selected>Select service type</option>
                                    <option>Ground Shipping</option>
                                    <option>Express Shipping</option>
                                    <option>Overnight Delivery</option>
                                    <option>International</option>
                                    <option>Same Day</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Website</label>
                                <input type="url" class="form-control" placeholder="https://www.carrier.com">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" rows="3" placeholder="Additional carrier information..."></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Carrier</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Customers List Modal -->
    <div class="modal fade" id="customersModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-users me-2"></i>All Customers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="input-group" style="max-width: 300px;">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search customers...">
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                            <i class="fas fa-user-plus me-2"></i>Add New Customer
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Total Orders</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>CUST-001</strong></td>
                                    <td>Juan Dela Cruz</td>
                                    <td>juan.delacruz@email.com</td>
                                    <td>+1 (555) 123-4567</td>
                                    <td>Los Angeles, CA</td>
                                    <td>15</td>
                                    <td><span class="badge-status badge-delivered">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>CUST-002</strong></td>
                                    <td>Juana Santiago</td>
                                    <td>juana.santiago@email.com</td>
                                    <td>+1 (555) 234-5678</td>
                                    <td>Chicago, IL</td>
                                    <td>23</td>
                                    <td><span class="badge-status badge-delivered">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>CUST-003</strong></td>
                                    <td>Roberto Reyes</td>
                                    <td>roberto.reyes@email.com</td>
                                    <td>+1 (555) 345-6789</td>
                                    <td>Seattle, WA</td>
                                    <td>8</td>
                                    <td><span class="badge-status badge-delivered">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>CUST-004</strong></td>
                                    <td>Alicia Gonzales</td>
                                    <td>alicia.gonzales@email.com</td>
                                    <td>+1 (555) 456-7890</td>
                                    <td>Houston, TX</td>
                                    <td>31</td>
                                    <td><span class="badge-status badge-delivered">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>CUST-005</strong></td>
                                    <td>Miguel Ramos</td>
                                    <td>miguel.ramos@email.com</td>
                                    <td>+1 (555) 567-8901</td>
                                    <td>Phoenix, AZ</td>
                                    <td>12</td>
                                    <td><span class="badge-status badge-delivered">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>CUST-006</strong></td>
                                    <td>Sofia Cruz</td>
                                    <td>{{ $sofiaCruzEmail }}</td>
                                    <td>{{ $sofiaCruzPhone }}</td>
                                    <td>San Francisco, CA</td>
                                    <td>19</td>
                                    <td><span class="badge-status badge-pending">Inactive</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Updates Modal -->
    <div class="modal fade" id="statusUpdatesModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-sync-alt me-2"></i>Status Updates</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="input-group" style="max-width: 300px;">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search updates...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Update ID</th>
                                    <th>Shipment ID</th>
                                    <th>Status</th>
                                    <th>Timestamp</th>
                                    <th>Updated By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>UPD-001</strong></td>
                                    <td><strong>SHIP-001235</strong></td>
                                    <td><span class="badge-status badge-delivered">Delivered</span></td>
                                    <td>Nov 30, 2025 10:15 AM</td>
                                    <td>COU-002 (UPS Driver)</td>
                                </tr>
                                <tr>
                                    <td><strong>UPD-002</strong></td>
                                    <td><strong>SHIP-001234</strong></td>
                                    <td><span class="badge-status badge-in-transit">In Transit</span></td>
                                    <td>Nov 29, 2025 2:30 PM</td>
                                    <td>COU-001 (FedEx Driver)</td>
                                </tr>
                                <tr>
                                    <td><strong>UPD-003</strong></td>
                                    <td><strong>SHIP-001237</strong></td>
                                    <td><span class="badge-status badge-delayed">Delayed</span></td>
                                    <td>Nov 28, 2025 8:45 AM</td>
                                    <td>Admin User</td>
                                </tr>
                                <tr>
                                    <td><strong>UPD-004</strong></td>
                                    <td><strong>SHIP-001238</strong></td>
                                    <td><span class="badge-status badge-in-transit">In Transit</span></td>
                                    <td>Nov 28, 2025 11:20 AM</td>
                                    <td>COU-001 (FedEx Driver)</td>
                                </tr>
                                <tr>
                                    <td><strong>UPD-005</strong></td>
                                    <td><strong>SHIP-001239</strong></td>
                                    <td><span class="badge-status badge-in-transit">In Transit</span></td>
                                    <td>Nov 30, 2025 9:00 AM</td>
                                    <td>COU-004 (OnTrac Driver)</td>
                                </tr>
                                <tr>
                                    <td><strong>UPD-006</strong></td>
                                    <td><strong>SHIP-001236</strong></td>
                                    <td><span class="badge-status badge-pending">Pending</span></td>
                                    <td>Nov 30, 2025 7:30 AM</td>
                                    <td>Admin User</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delivery Confirmations Modal -->
    <div class="modal fade" id="deliveryConfirmationsModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-clipboard-check me-2"></i>Delivery Confirmations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="input-group" style="max-width: 300px;">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search confirmations...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Confirmation ID</th>
                                    <th>Shipment ID</th>
                                    <th>Recipient Name</th>
                                    <th>Delivered Date</th>
                                    <th>Courier ID</th>
                                    <th>Signature</th>
                                    <th>Photo Proof</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>CONF-001</strong></td>
                                    <td><strong>SHIP-001235</strong></td>
                                    <td>Maria Santos</td>
                                    <td>Nov 30, 2025 10:15 AM</td>
                                    <td>COU-002</td>
                                    <td><span class="badge-status badge-delivered">Signed</span></td>
                                    <td><button class="btn btn-sm btn-outline-primary btn-action" onclick="showPhotoProof('SHIP-001235', 'Maria Santos')"><i class="fas fa-image"></i></button></td>
                                </tr>
                                <tr>
                                    <td><strong>CONF-002</strong></td>
                                    <td><strong>SHIP-001240</strong></td>
                                    <td>David Villanueva</td>
                                    <td>Nov 29, 2025 3:45 PM</td>
                                    <td>COU-003</td>
                                    <td><span class="badge-status badge-delivered">Signed</span></td>
                                    <td><button class="btn btn-sm btn-outline-primary btn-action" onclick="showPhotoProof('SHIP-001240', 'David Villanueva')"><i class="fas fa-image"></i></button></td>
                                </tr>
                                <tr>
                                    <td><strong>CONF-003</strong></td>
                                    <td><strong>SHIP-001241</strong></td>
                                    <td>Emily Fernandez</td>
                                    <td>Nov 29, 2025 11:30 AM</td>
                                    <td>COU-001</td>
                                    <td><span class="badge-status badge-pending">Left at Door</span></td>
                                    <td><button class="btn btn-sm btn-outline-primary btn-action" onclick="showPhotoProof('SHIP-001241', 'Emily Fernandez')"><i class="fas fa-image"></i></button></td>
                                </tr>
                                <tr>
                                    <td><strong>CONF-004</strong></td>
                                    <td><strong>SHIP-001242</strong></td>
                                    <td>Roberto Lopez</td>
                                    <td>Nov 28, 2025 2:15 PM</td>
                                    <td>COU-004</td>
                                    <td><span class="badge-status badge-delivered">Signed</span></td>
                                    <td><button class="btn btn-sm btn-outline-primary btn-action" onclick="showPhotoProof('SHIP-001242', 'Roberto Lopez')"><i class="fas fa-image"></i></button></td>
                                </tr>
                                <tr>
                                    <td><strong>CONF-005</strong></td>
                                    <td><strong>SHIP-001243</strong></td>
                                    <td>Maria Garcia</td>
                                    <td>Nov 28, 2025 9:20 AM</td>
                                    <td>COU-001</td>
                                    <td><span class="badge-status badge-delivered">Signed</span></td>
                                    <td><button class="btn btn-sm btn-outline-primary btn-action" onclick="showPhotoProof('SHIP-001243', 'Maria Garcia')"><i class="fas fa-image"></i></button></td>
                                </tr>
                                <tr>
                                    <td><strong>CONF-006</strong></td>
                                    <td><strong>SHIP-001244</strong></td>
                                    <td>Tomas Alvarez</td>
                                    <td>Nov 27, 2025 4:50 PM</td>
                                    <td>COU-003</td>
                                    <td><span class="badge-status badge-pending">Left at Door</span></td>
                                    <td><button class="btn btn-sm btn-outline-primary btn-action" onclick="showPhotoProof('SHIP-001244', 'Tomas Alvarez')"><i class="fas fa-image"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Send Alert Modal -->
    <div class="modal fade" id="sendAlertModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-bell me-2"></i>Send Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="alertType" class="form-label">Alert Type</label>
                            <select class="form-select" id="alertType" required>
                                <option value="">Select alert type...</option>
                                <option value="delay">Delay Notification</option>
                                <option value="delivery">Delivery Update</option>
                                <option value="issue">Issue Alert</option>
                                <option value="general">General Notification</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alertRecipient" class="form-label">Recipient</label>
                            <select class="form-select" id="alertRecipient" required>
                                <option value="">Select recipient...</option>
                                <option value="all">All Customers</option>
                                <option value="specific">Specific Customer</option>
                                <option value="courier">Courier</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alertShipmentId" class="form-label">Shipment ID (Optional)</label>
                            <input type="text" class="form-control" id="alertShipmentId" placeholder="e.g., SHIP-001235">
                        </div>
                        <div class="mb-3">
                            <label for="alertMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="alertMessage" rows="4" required placeholder="Enter your alert message..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn" style="background-color: var(--primary-red); color: white;">Send Alert</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Modal -->
    <div class="modal fade" id="reportsModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Reports & Analytics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Report Cards -->
                        <div class="col-md-4">
                            <div class="card-custom h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-invoice fa-3x text-danger mb-3"></i>
                                    <h5>Shipment Report</h5>
                                    <p class="text-muted">Detailed shipment analytics and statistics</p>
                                    <button class="btn btn-primary btn-sm" onclick="generateReport('Shipment')"><i class="fas fa-download me-2"></i>Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-custom h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                    <h5>Customer Report</h5>
                                    <p class="text-muted">Customer activity and order history</p>
                                    <button class="btn btn-primary btn-sm" onclick="generateReport('Customer')"><i class="fas fa-download me-2"></i>Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-custom h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-truck fa-3x text-success mb-3"></i>
                                    <h5>Courier Performance</h5>
                                    <p class="text-muted">Delivery performance and efficiency</p>
                                    <button class="btn btn-primary btn-sm" onclick="generateReport('Courier Performance')"><i class="fas fa-download me-2"></i>Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-custom h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-line fa-3x text-warning mb-3"></i>
                                    <h5>Monthly Summary</h5>
                                    <p class="text-muted">Monthly shipment trends and insights</p>
                                    <button class="btn btn-primary btn-sm" onclick="generateReport('Monthly Summary')"><i class="fas fa-download me-2"></i>Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-custom h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                                    <h5>Delay Analysis</h5>
                                    <p class="text-muted">Delayed shipments and root causes</p>
                                    <button class="btn btn-primary btn-sm" onclick="generateReport('Delay Analysis')"><i class="fas fa-download me-2"></i>Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-custom h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-dollar-sign fa-3x text-success mb-3"></i>
                                    <h5>Revenue Report</h5>
                                    <p class="text-muted">Financial overview and revenue trends</p>
                                    <button class="btn btn-primary btn-sm" onclick="generateReport('Revenue')"><i class="fas fa-download me-2"></i>Generate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-3"><i class="fas fa-calendar-alt me-2"></i>Custom Report</h5>
                            <form>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Report Type</label>
                                        <select class="form-select">
                                            <option>Select report type...</option>
                                            <option>Shipment Report</option>
                                            <option>Customer Report</option>
                                            <option>Courier Performance</option>
                                            <option>Financial Report</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Format</label>
                                        <select class="form-select">
                                            <option>PDF</option>
                                            <option>Excel</option>
                                            <option>CSV</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email To (Optional)</label>
                                        <input type="email" class="form-control" placeholder="email@example.com">
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary"><i class="fas fa-file-download me-2"></i>Generate Custom Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Proof Modal -->
    <div class="modal fade" id="photoProofModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-camera me-2"></i>Delivery Photo Proof</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-1"><strong>Shipment ID:</strong> <span id="proofShipmentId"></span></h6>
                                    <p class="mb-0 text-muted"><strong>Recipient:</strong> <span id="proofRecipient"></span></p>
                                </div>
                                <span class="badge bg-success">Delivered</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-0">
                                    <img id="proofImage" src="" alt="Delivery Proof" class="img-fluid w-100" style="border-radius: 10px; max-height: 500px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="alert alert-info mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Photo Details:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Captured by: <span id="proofCourier"></span></li>
                                    <li>Date & Time: <span id="proofDateTime"></span></li>
                                    <li>Location: <span id="proofLocation"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="downloadPhoto()">
                        <i class="fas fa-download me-2"></i>Download Photo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipments List Modal -->
    <div class="modal fade" id="shipmentsModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-box me-2"></i>All Shipments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="input-group" style="max-width: 300px;">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search shipments...">
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addShipmentModal">
                            <i class="fas fa-plus me-2"></i>Add New Shipment
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Shipment ID</th>
                                    <th>Recipient Name</th>
                                    <th>Recipient Contact</th>
                                    <th>Delivery Address</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Dispatched Date</th>
                                    <th>Delivered Date</th>
                                    <th>Courier ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>SHIP-001234</strong></td>
                                    <td>John Doe</td>
                                    <td>+1 (555) 123-4567</td>
                                    <td>123 Main St, New York, NY 10001</td>
                                    <td><span class="badge-status badge-in-transit">In Transit</span></td>
                                    <td>Nov 28, 2025</td>
                                    <td>Nov 29, 2025</td>
                                    <td>-</td>
                                    <td>COU-001</td>
                                </tr>
                                <tr>
                                    <td><strong>SHIP-001235</strong></td>
                                    <td>Jane Smith</td>
                                    <td>+1 (555) 234-5678</td>
                                    <td>456 Ocean Ave, Miami, FL 33101</td>
                                    <td><span class="badge-status badge-delivered">Delivered</span></td>
                                    <td>Nov 26, 2025</td>
                                    <td>Nov 27, 2025</td>
                                    <td>Nov 30, 2025</td>
                                    <td>COU-002</td>
                                </tr>
                                <tr>
                                    <td><strong>SHIP-001236</strong></td>
                                    <td>Bob Johnson</td>
                                    <td>+1 (555) 345-6789</td>
                                    <td>789 Park Rd, Boston, MA 02108</td>
                                    <td><span class="badge-status badge-pending">Pending</span></td>
                                    <td>Nov 30, 2025</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td><strong>SHIP-001237</strong></td>
                                    <td>Alice Williams</td>
                                    <td>+1 (555) 456-7890</td>
                                    <td>321 Mountain Dr, Denver, CO 80202</td>
                                    <td><span class="badge-status badge-delayed">Delayed</span></td>
                                    <td>Nov 25, 2025</td>
                                    <td>Nov 26, 2025</td>
                                    <td>-</td>
                                    <td>COU-003</td>
                                </tr>
                                <tr>
                                    <td><strong>SHIP-001238</strong></td>
                                    <td>Michael Brown</td>
                                    <td>+1 (555) 567-8901</td>
                                    <td>654 Peachtree St, Atlanta, GA 30303</td>
                                    <td><span class="badge-status badge-in-transit">In Transit</span></td>
                                    <td>Nov 27, 2025</td>
                                    <td>Nov 28, 2025</td>
                                    <td>-</td>
                                    <td>COU-001</td>
                                </tr>
                                <tr>
                                    <td><strong>SHIP-001239</strong></td>
                                    <td>Sarah Davis</td>
                                    <td>+1 (555) 678-9012</td>
                                    <td>987 Cedar Ln, Portland, OR 97201</td>
                                    <td><span class="badge-status badge-in-transit">In Transit</span></td>
                                    <td>Nov 29, 2025</td>
                                    <td>Nov 30, 2025</td>
                                    <td>-</td>
                                    <td>COU-004</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Navigation active state
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.top-nav .nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Remove active class from all links
                    navLinks.forEach(l => l.classList.remove('active'));
                    // Add active class to clicked link (if not opening modal)
                    if (!this.hasAttribute('data-bs-toggle')) {
                        this.classList.add('active');
                    }
                });
            });
        });

        // Make shipment rows clickable
        document.addEventListener('DOMContentLoaded', function() {
            // Recent Shipments table rows
            const shipmentRows = document.querySelectorAll('.table-custom tbody tr');
            shipmentRows.forEach(row => {
                row.addEventListener('click', function(e) {
                    // Don't trigger if clicking on action buttons
                    if (e.target.closest('.btn-action')) return;
                    
                    const trackingNumber = this.querySelector('strong').textContent;
                    showShipmentDetails(trackingNumber);
                });
            });

            // Recent Activity items
            const activityItems = document.querySelectorAll('.activity-item');
            activityItems.forEach(item => {
                item.addEventListener('click', function() {
                    const activityText = this.querySelector('p strong').textContent;
                    alert('Activity Details: ' + activityText);
                });
            });
        });

        // Show shipment details
        function showShipmentDetails(trackingNumber) {
            alert('Tracking Details for ' + trackingNumber + '\n\nClick OK to view full tracking history and real-time updates.');
        }

        // Track delivery function
        function trackDelivery(trackingNumber) {
            alert('Tracking ' + trackingNumber + '\n\nShowing real-time location and delivery status...');
        }

        // Add Shipment Form Submission
        document.getElementById('submitShipmentBtn').addEventListener('click', function() {
            const form = document.getElementById('addShipmentForm');
            const formData = new FormData(form);
            const submitBtn = this;
            const alert = document.getElementById('shipmentAlert');

            // Disable button during submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';

            // Convert FormData to JSON
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            fetch('/shipments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    alert.className = 'alert alert-success';
                    alert.style.display = 'block';
                    alert.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + data.message + 
                                     '<br><strong>Tracking Number: ' + data.tracking_number + '</strong>';
                    
                    // Reset form
                    form.reset();
                    
                    // Hide modal after 2 seconds
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addShipmentModal'));
                        modal.hide();
                        alert.style.display = 'none';
                        
                        // Show success notification
                        showNotification('Shipment created successfully! Tracking: ' + data.tracking_number, 'success');
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert.className = 'alert alert-danger';
                alert.style.display = 'block';
                alert.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Error creating shipment. Please try again.';
            })
            .finally(() => {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Add Shipment';
            });
        });

        // Show notification function
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                ${message}
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }

        // Generate report function
        function generateReport(reportType) {
            // Create loading notification
            const notification = document.createElement('div');
            notification.className = 'alert alert-info position-fixed';
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-spinner fa-spin me-2"></i>
                Generating ${reportType} Report...
            `;
            document.body.appendChild(notification);

            // Simulate report generation (replace with actual API call later)
            setTimeout(() => {
                notification.remove();
                
                // Show success notification
                showNotification(`${reportType} Report generated successfully! Download starting...`, 'success');
                
                // Simulate download (in real implementation, this would trigger actual file download)
                console.log(`Downloading ${reportType} Report`);
            }, 1500);
        }

        // Export data function
        function exportData() {
            // Create loading notification
            const notification = document.createElement('div');
            notification.className = 'alert alert-info position-fixed';
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-spinner fa-spin me-2"></i>
                Exporting data...
            `;
            document.body.appendChild(notification);

            // Simulate export (replace with actual API call later)
            setTimeout(() => {
                notification.remove();
                
                // Show success notification
                showNotification('Data exported successfully! Download starting...', 'success');
                
                // Simulate CSV download
                const csvContent = 'Tracking Number,Customer,Origin,Destination,Status,Date\n';
                const blob = new Blob([csvContent], { type: 'text/csv' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `shipments_export_${new Date().toISOString().split('T')[0]}.csv`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            }, 1500);
        }

        // Add Customer Form Submission
        document.getElementById('submitCustomerBtn').addEventListener('click', function() {
            const form = document.getElementById('addCustomerForm');
            const formData = new FormData(form);
            const submitBtn = this;
            const alert = document.getElementById('customerAlert');

            // Disable button during submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';

            // Convert FormData to JSON
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            fetch('/customers', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    alert.className = 'alert alert-success';
                    alert.style.display = 'block';
                    alert.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + data.message;
                    
                    // Reset form
                    form.reset();
                    
                    // Hide modal after 2 seconds
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addCustomerModal'));
                        modal.hide();
                        alert.style.display = 'none';
                        
                        // Show success notification
                        showNotification('Customer added successfully!', 'success');
                    }, 2000);
                } else {
                    // Show error message
                    alert.className = 'alert alert-danger';
                    alert.style.display = 'block';
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat().map(err => `<li>${err}</li>`).join('');
                        alert.innerHTML = `<i class="fas fa-exclamation-circle me-2"></i><strong>Validation Error:</strong><ul class="mb-0 mt-2">${errorList}</ul>`;
                    } else {
                        alert.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + (data.message || 'Error adding customer.');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert.className = 'alert alert-danger';
                alert.style.display = 'block';
                alert.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Error adding customer. Please try again.';
            })
            .finally(() => {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Add Customer';
            });
        });

        // Show Photo Proof function
        function showPhotoProof(shipmentId, recipientName) {
            // Sample delivery proof images (you can replace with actual images from your database)
            const deliveryProofs = {
                'SHIP-001235': {
                    image: 'https://images.unsplash.com/photo-1601933973783-43cf8a7d4c5f?w=800&auto=format&fit=crop',
                    courier: 'COU-002 (UPS Driver - John Smith)',
                    dateTime: 'Nov 30, 2025 10:15 AM',
                    location: '123 Main Street, Manila'
                },
                'SHIP-001240': {
                    image: 'https://images.unsplash.com/photo-1588880331179-bc9b93a8cb5e?w=800&auto=format&fit=crop',
                    courier: 'COU-003 (DHL Driver - Sarah Johnson)',
                    dateTime: 'Nov 29, 2025 3:45 PM',
                    location: '456 Oak Avenue, Quezon City'
                },
                'SHIP-001241': {
                    image: 'https://images.unsplash.com/photo-1598128558393-70ff21433be0?w=800&auto=format&fit=crop',
                    courier: 'COU-001 (FedEx Driver - Mike Davis)',
                    dateTime: 'Nov 29, 2025 11:30 AM',
                    location: '789 Elm Street, Makati'
                },
                'SHIP-001242': {
                    image: 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&auto=format&fit=crop',
                    courier: 'COU-004 (OnTrac Driver - Lisa Wong)',
                    dateTime: 'Nov 28, 2025 2:15 PM',
                    location: '321 Pine Road, Pasig'
                },
                'SHIP-001243': {
                    image: 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=800&auto=format&fit=crop',
                    courier: 'COU-001 (FedEx Driver - Mike Davis)',
                    dateTime: 'Nov 28, 2025 9:20 AM',
                    location: '654 Maple Drive, Taguig'
                },
                'SHIP-001244': {
                    image: 'https://images.unsplash.com/photo-1585128792126-25b69e1f2d33?w=800&auto=format&fit=crop',
                    courier: 'COU-003 (DHL Driver - Sarah Johnson)',
                    dateTime: 'Nov 27, 2025 4:50 PM',
                    location: '987 Cedar Lane, Mandaluyong'
                }
            };

            const proof = deliveryProofs[shipmentId] || {
                image: 'https://images.unsplash.com/photo-1601933973783-43cf8a7d4c5f?w=800&auto=format&fit=crop',
                courier: 'Unknown Courier',
                dateTime: 'Unknown Date',
                location: 'Unknown Location'
            };

            // Set modal content
            document.getElementById('proofShipmentId').textContent = shipmentId;
            document.getElementById('proofRecipient').textContent = recipientName;
            document.getElementById('proofImage').src = proof.image;
            document.getElementById('proofCourier').textContent = proof.courier;
            document.getElementById('proofDateTime').textContent = proof.dateTime;
            document.getElementById('proofLocation').textContent = proof.location;

            // Show the modal
            const photoModal = new bootstrap.Modal(document.getElementById('photoProofModal'));
            photoModal.show();
        }

        // Download photo function
        function downloadPhoto() {
            const imageUrl = document.getElementById('proofImage').src;
            const shipmentId = document.getElementById('proofShipmentId').textContent;
            
            // Create a temporary link to download the image
            const link = document.createElement('a');
            link.href = imageUrl;
            link.download = `delivery_proof_${shipmentId}_${new Date().getTime()}.jpg`;
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            showNotification('Photo downloaded successfully!', 'success');
        }
    </script>
    <script>
        // Shipment Trends Chart
        const shipmentCtx = document.getElementById('shipmentChart').getContext('2d');
        const shipmentChart = new Chart(shipmentCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Shipments',
                    data: [650, 780, 920, 850, 1100, 1050, 1200, 1350, 1180, 1400, 1300, 1234],
                    borderColor: '#dc2626',
                    backgroundColor: 'rgba(220, 38, 38, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Status Distribution Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Delivered', 'In Transit', 'Pending', 'Delayed'],
                datasets: [{
                    data: [892, 567, 189, 23],
                    backgroundColor: [
                        '#22c55e',
                        '#3b82f6',
                        '#f97316',
                        '#ef4444'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>
