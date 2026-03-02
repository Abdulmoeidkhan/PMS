<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Participant Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #7c3aed;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .navbar-nav .nav-link {
            margin-left: 1rem;
            color: rgba(255, 255, 255, 0.8) !important;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
        }

        /* Main Container */
        .main-container {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 5px solid;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-card.primary {
            border-left-color: var(--primary-color);
        }

        .stat-card.pending {
            border-left-color: var(--warning-color);
        }

        .stat-card.approved {
            border-left-color: var(--success-color);
        }

        .stat-card.rejected {
            border-left-color: var(--danger-color);
        }

        .stat-card.users {
            border-left-color: var(--secondary-color);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Action Buttons */
        .action-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 12px 25px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn.primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }

        .action-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.4);
        }

        .action-btn.success {
            background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
            color: white;
        }

        .action-btn.success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }

        .action-btn.secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .action-btn.secondary:hover {
            background: #e5e7eb;
        }

        /* User Info Card */
        .user-info-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .user-details h6 {
            margin: 0;
            font-weight: 600;
        }

        .user-details small {
            color: #999;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }

            .action-btn {
                width: 100%;
                justify-content: center;
            }

            .stat-card {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin/dashboard">
                <i class="bi bi-diagram-3"></i> Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/dashboard">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/participants">
                            <i class="bi bi-people"></i> Participants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">
                            <i class="bi bi-person-gear"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="/logout" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-container">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="text-white mb-2">Welcome, {{ auth()->user()->name }}!</h1>
                <p class="text-white-50">Manage participants and user accounts</p>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="text-white-50">Last login: {{ auth()->user()->updated_at->diffForHumans() }}</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <!-- Total Participants -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card primary">
                    <div class="stat-icon text-primary">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <div class="stat-number">{{ $total_participants }}</div>
                    <div class="stat-label">Total Participants</div>
                </div>
            </div>

            <!-- Pending -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card pending">
                    <div class="stat-icon" style="color: var(--warning-color);">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="stat-number">{{ $pending }}</div>
                    <div class="stat-label">Pending Review</div>
                </div>
            </div>

            <!-- Approved -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card approved">
                    <div class="stat-icon text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $approved }}</div>
                    <div class="stat-label">Approved</div>
                </div>
            </div>

            <!-- Rejected -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card rejected">
                    <div class="stat-icon text-danger">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="stat-number">{{ $rejected }}</div>
                    <div class="stat-label">Rejected</div>
                </div>
            </div>
        </div>

        <!-- Secondary Stats -->
        <div class="row mb-4">
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card users">
                    <div class="stat-icon" style="color: var(--secondary-color);">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-number">{{ $total_users }}</div>
                    <div class="stat-label">Total Users</div>
                </div>
            </div>

            <!-- Approval Rate -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card primary">
                    <div class="stat-icon text-primary">
                        <i class="bi bi-percent"></i>
                    </div>
                    <div class="stat-number">
                        @if($total_participants > 0)
                            {{ round(($approved / $total_participants) * 100) }}%
                        @else
                            0%
                        @endif
                    </div>
                    <div class="stat-label">Approval Rate</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row">
            <div class="col-12">
                <div class="action-buttons">
                    <a href="/admin/participants" class="action-btn primary">
                        <i class="bi bi-people"></i> View All Participants
                    </a>
                    <a href="/admin/participants?status=pending" class="action-btn warning" style="background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%); color: white;">
                        <i class="bi bi-hourglass-split"></i> Review Pending
                    </a>
                    <a href="/admin/users" class="action-btn success">
                        <i class="bi bi-person-plus"></i> Manage Users
                    </a>
                    <a href="/admin/export" class="action-btn secondary">
                        <i class="bi bi-download"></i> Export CSV
                    </a>
                </div>
            </div>
        </div>

        <!-- User Info Card -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="user-info-card">
                    <div class="user-info">
                        <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                        <div class="user-details">
                            <h6>{{ auth()->user()->name }}</h6>
                            <small>{{ auth()->user()->email }}</small>
                            <br>
                            <small class="text-success" style="font-weight: 600;">
                                <i class="bi bi-shield-check"></i> Administrator
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
