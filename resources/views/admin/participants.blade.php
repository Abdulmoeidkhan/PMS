<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants - Admin Panel</title>
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

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0;
            color: #1f2937;
        }

        .page-header p {
            color: #6b7280;
            margin: 5px 0 0 0;
        }

        /* Filter & Search */
        .filter-section {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .filter-section .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .filter-section .form-control,
        .filter-section .form-select {
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            padding: 10px 15px;
        }

        .filter-section .form-control:focus,
        .filter-section .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
        }

        /* Table */
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table {
            margin: 0;
        }

        .table thead {
            background: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
        }

        .table thead th {
            font-weight: 600;
            color: #374151;
            padding: 15px;
            border: none;
        }

        .table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f9fafb;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        /* Status Badge */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.approved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.rejected {
            background: #fee2e2;
            color: #7f1d1d;
        }

        /* Action Buttons in Table */
        .action-btn-small {
            padding: 6px 12px;
            border-radius: 8px;
            border: none;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .action-btn-small.view {
            background: var(--primary-color);
            color: white;
        }

        .action-btn-small.view:hover {
            background: #4338ca;
        }

        .action-btn-small.approve {
            background: var(--success-color);
            color: white;
        }

        .action-btn-small.approve:hover {
            background: #059669;
        }

        .action-btn-small.reject {
            background: var(--danger-color);
            color: white;
        }

        .action-btn-small.reject:hover {
            background: #dc2626;
        }

        .action-btn-small.delete {
            background: #f3f4f6;
            color: #ef4444;
        }

        .action-btn-small.delete:hover {
            background: #e5e7eb;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            color: #6b7280;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #9ca3af;
        }

        /* Pagination */
        .pagination {
            margin-top: 25px;
        }

        .page-link {
            border-radius: 8px;
            margin: 0 3px;
            border: none;
            color: var(--primary-color);
        }

        .page-link:hover {
            background: var(--primary-color);
            color: white;
        }

        .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.85rem;
            }

            .action-btn-small {
                padding: 4px 8px;
                font-size: 0.75rem;
            }

            .page-header h1 {
                font-size: 1.5rem;
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
                        <a class="nav-link" href="/admin/dashboard">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/participants">
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
    <div class="container-fluid main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="bi bi-people"></i> Participants Management</h1>
            <p>View, approve, and manage participant submissions</p>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="GET" action="/admin/participants">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search by name, email, or city..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Filter by Status</label>
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-search"></i> Search
                        </button>
                        <a href="/admin/participants" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        @if($participants->count() > 0)
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participants as $participant)
                                <tr>
                                    <td>
                                        <strong>{{ $participant->full_name }}</strong>
                                    </td>
                                    <td>{{ $participant->email }}</td>
                                    <td>{{ substr($participant->mobile, -4, 4) }}... (encrypted)</td>
                                    <td>{{ $participant->city }}</td>
                                    <td>
                                        <span class="status-badge {{ $participant->status }}">
                                            {{ ucfirst($participant->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small>{{ $participant->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td>
                                        <a href="/admin/participants/{{ $participant->id }}" class="action-btn-small view">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        @if($participant->status === 'pending')
                                            <form action="/admin/participants/{{ $participant->id }}/approve" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="action-btn-small approve" onclick="return confirm('Approve this participant?')">
                                                    <i class="bi bi-check"></i> Approve
                                                </button>
                                            </form>
                                            <form action="/admin/participants/{{ $participant->id }}/reject" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="action-btn-small reject" onclick="return confirm('Reject this participant?')">
                                                    <i class="bi bi-x"></i> Reject
                                                </button>
                                            </form>
                                        @endif
                                        <form action="/admin/participants/{{ $participant->id }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn-small delete" onclick="return confirm('Delete this participant?')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($participants->hasPages())
                    <div class="d-flex justify-content-center p-3">
                        {{ $participants->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="table-container">
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h3>No participants found</h3>
                    <p>{{ request('search') || request('status') ? 'Try adjusting your search filters' : 'No participants have submitted the form yet' }}</p>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
