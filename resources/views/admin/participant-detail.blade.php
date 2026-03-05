<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Details - Admin Panel</title>
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

        /* Card */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 25px;
            border: none;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .card-body {
            padding: 25px;
        }

        /* Section Title */
        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1f2937;
            margin-top: 25px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e5e7eb;
        }

        .section-title:first-child {
            margin-top: 0;
        }

        /* Info Row */
        .info-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-weight: 600;
            color: #6b7280;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-value {
            color: #1f2937;
            font-size: 1rem;
            word-break: break-word;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: fit-content;
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

        /* File Section */
        .file-section {
            background: #f9fafb;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .file-item:last-child {
            border-bottom: none;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-grow: 1;
        }

        .file-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .file-details h6 {
            margin: 0;
            font-weight: 600;
            color: #1f2937;
        }

        .file-details small {
            color: #9ca3af;
        }

        .file-download-btn {
            padding: 8px 16px;
            border-radius: 8px;
            background: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .file-download-btn:hover {
            background: #4338ca;
            color: white;
        }

        .file-download-btn.disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 12px 25px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
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

        .action-btn.danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
            color: white;
        }

        .action-btn.danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        }

        .action-btn.secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .action-btn.secondary:hover {
            background: #e5e7eb;
        }

        /* Preview Modal Styles */
        .preview-modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .preview-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-modal-content {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            max-width: 90%;
            max-height: 90vh;
            overflow: auto;
            position: relative;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .preview-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .preview-modal-header h5 {
            margin: 0;
            color: #1f2937;
        }

        .preview-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
            transition: color 0.2s ease;
        }

        .preview-modal-close:hover {
            color: #1f2937;
        }

        .preview-modal-body {
            padding: 20px;
            text-align: center;
        }

        .preview-modal-body img {
            max-width: 100%;
            max-height: 70vh;
            border-radius: 10px;
            object-fit: contain;
        }

        .preview-modal-body iframe {
            width: 100%;
            height: 70vh;
            border: none;
            border-radius: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-row {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-btn {
                justify-content: center;
            }

            .preview-modal-content {
                max-width: 95%;
                max-height: 95vh;
            }

            .preview-modal-body img {
                max-height: 60vh;
            }

            .preview-modal-body iframe {
                height: 60vh;
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
    <div class="container main-container">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="text-white mb-2">{{ $participant->full_name }}</h1>
                <p class="text-white-50">
                    <a href="/admin/participants" class="text-white-50">← Back to Participants</a>
                </p>
            </div>
            <div class="d-flex gap-2">
                <span class="status-badge {{ $participant->status }}">
                    {{ ucfirst($participant->status) }}
                </span>
                <a href="{{ route('admin.participant.edit', $participant->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>

        <!-- Personal Information Card -->
        <div class="card">
            <div class="card-header">
                <h2><i class="bi bi-person"></i> Personal Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Full Name</span>
                        <span class="info-value">{{ $participant->full_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nick Name</span>
                        <span class="info-value">{{ $participant->nick_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $participant->email }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Phone (Encrypted)</span>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="info-value" id="mobileValue">••••••••{{ substr($participant->mobile, -4) }}</span>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="mobileToggle" onclick="toggleMobile()">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Emergency Contact (Encrypted)</span>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="info-value" id="emergencyValue">••••••••{{ substr($participant->emergency_contact, -4) }}</span>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="emergencyToggle" onclick="toggleEmergency()">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Date of Birth</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($participant->dob)->format('M d, Y') }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Nationality</span>
                        <span class="info-value">{{ $participant->nationality }}</span>
                    </div>
                </div>

                <div class="section-title">Medical & Performance Information</div>
                <div class="info-row">
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label">Medical Information</span>
                        <span class="info-value">{{ $participant->medical_info ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label">Performance</span>
                        <span class="info-value">{{ $participant->performance ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="section-title">Address Information</div>
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">City</span>
                        <span class="info-value">{{ $participant->city }}</span>
                    </div>
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label">Address</span>
                        <span class="info-value">{{ $participant->address }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cricket Information Card -->
        <div class="card">
            <div class="card-header">
                <h2><i class="bi bi-trophy"></i> Cricket Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Shirt Number</span>
                        <span class="info-value">{{ $participant->shirt_number }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kit Size</span>
                        <span class="info-value">{{ ucfirst($participant->kit_size) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Identity (Encrypted)</span>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="info-value" id="identityValue">••••{{ substr($participant->identity, -4) }}</span>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="identityToggle" onclick="toggleIdentity()">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label">Skill Categories</span>
                        <span class="info-value">
                            @if($participant->skill_categories && is_array($participant->skill_categories))
                                @foreach($participant->skill_categories as $skill)
                                    <span class="badge bg-primary me-2">{{ $skill }}</span>
                                @endforeach
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label">Category</span>
                        <span class="info-value">
                            @if($participant->category)
                                <span class="badge bg-success">{{ $participant->category->name }}</span>
                            @else
                                <span class="text-muted">Not assigned</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Travel Information Card -->
        <div class="card">
            <div class="card-header">
                <h2><i class="bi bi-airplane"></i> Travel Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Airline</span>
                        <span class="info-value">{{ $participant->airline ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Arrival Date</span>
                        <span class="info-value">{{ $participant->arrival_date ? \Carbon\Carbon::parse($participant->arrival_date)->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Arrival Time</span>
                        <span class="info-value">{{ $participant->arrival_time ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="section-title">Hotel Information</div>
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Hotel Name</span>
                        <span class="info-value">{{ $participant->hotel_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Checkin Date</span>
                        <span class="info-value">{{ $participant->checkin ? \Carbon\Carbon::parse($participant->checkin)->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Checkout Date</span>
                        <span class="info-value">{{ $participant->checkout ? \Carbon\Carbon::parse($participant->checkout)->format('M d, Y') : 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Card -->
        <div class="card">
            <div class="card-header">
                <h2><i class="bi bi-file-earmark"></i> Uploaded Documents</h2>
            </div>
            <div class="card-body">
                <div class="file-section">
                    @if($participant->passport_picture)
                        <div class="file-item">
                            <div class="file-info">
                                <div class="file-icon">
                                    <i class="bi bi-file-image"></i>
                                </div>
                                <div class="file-details">
                                    <h6>Passport Photo</h6>
                                    <small>Image document</small>
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button type="button" class="file-download-btn" style="background: #7c3aed;" onclick="previewImage('{{ route('admin.participant.preview', ['participantId' => $participant->id, 'fileType' => 'passport']) }}', 'Passport Photo')">
                                    <i class="bi bi-eye"></i> Preview
                                </button>
                                <a href="{{ route('admin.participant.download', ['participantId' => $participant->id, 'fileType' => 'passport']) }}" class="file-download-btn">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($participant->id_picture)
                        <div class="file-item">
                            <div class="file-info">
                                <div class="file-icon">
                                    <i class="bi bi-file-image"></i>
                                </div>
                                <div class="file-details">
                                    <h6>ID Picture</h6>
                                    <small>Image document</small>
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button type="button" class="file-download-btn" style="background: #7c3aed;" onclick="previewImage('{{ route('admin.participant.preview', ['participantId' => $participant->id, 'fileType' => 'id']) }}', 'ID Picture')">
                                    <i class="bi bi-eye"></i> Preview
                                </button>
                                <a href="{{ route('admin.participant.download', ['participantId' => $participant->id, 'fileType' => 'id']) }}" class="file-download-btn">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($participant->hotel_reservation)
                        <div class="file-item">
                            <div class="file-info">
                                <div class="file-icon">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </div>
                                <div class="file-details">
                                    <h6>Hotel Reservation</h6>
                                    <small>PDF document</small>
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button type="button" class="file-download-btn" style="background: #7c3aed;" onclick="previewPDF('{{ route('admin.participant.preview', ['participantId' => $participant->id, 'fileType' => 'hotel']) }}', 'Hotel Reservation')">
                                    <i class="bi bi-eye"></i> Preview
                                </button>
                                <a href="{{ route('admin.participant.download', ['participantId' => $participant->id, 'fileType' => 'hotel']) }}" class="file-download-btn">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($participant->flight_reservation)
                        <div class="file-item">
                            <div class="file-info">
                                <div class="file-icon">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </div>
                                <div class="file-details">
                                    <h6>Flight Reservation</h6>
                                    <small>PDF document</small>
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button type="button" class="file-download-btn" style="background: #7c3aed;" onclick="previewPDF('{{ route('admin.participant.preview', ['participantId' => $participant->id, 'fileType' => 'flight']) }}', 'Flight Reservation')">
                                    <i class="bi bi-eye"></i> Preview
                                </button>
                                <a href="{{ route('admin.participant.download', ['participantId' => $participant->id, 'fileType' => 'flight']) }}" class="file-download-btn">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        </div>
                    @endif

                    @if(!$participant->passport_picture && !$participant->id_picture && !$participant->hotel_reservation && !$participant->flight_reservation)
                        <div style="text-align: center; color: #9ca3af; padding: 20px;">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                            No documents uploaded
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Submission Information Card -->
        <div class="card">
            <div class="card-header">
                <h2><i class="bi bi-clock"></i> Submission Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Submitted On</span>
                        <span class="info-value">{{ $participant->created_at->format('M d, Y H:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Last Updated</span>
                        <span class="info-value">{{ $participant->updated_at->format('M d, Y H:i A') }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Current Status</span>
                        <span class="info-value">
                            <span class="status-badge {{ $participant->status }}">
                                {{ ucfirst($participant->status) }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Actions</h5>
                <div class="action-buttons">
                    @if($participant->status === 'pending')
                        <form method="POST" action="/admin/participants/{{ $participant->id }}/approve" style="margin: 0;">
                            @csrf
                            <button type="submit" class="action-btn success" onclick="return confirm('Approve this participant?')">
                                <i class="bi bi-check-circle"></i> Approve
                            </button>
                        </form>

                        <form method="POST" action="/admin/participants/{{ $participant->id }}/reject" style="margin: 0;">
                            @csrf
                            <button type="submit" class="action-btn danger" onclick="return confirm('Reject this participant?')">
                                <i class="bi bi-x-circle"></i> Reject
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="/admin/participants/{{ $participant->id }}" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn danger" onclick="return confirm('Delete this participant? This action cannot be undone.')">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>

                    <a href="/admin/participants" class="action-btn secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div id="imagePreviewModal" class="preview-modal">
        <div class="preview-modal-content">
            <div class="preview-modal-header">
                <h5 id="previewTitle">Preview</h5>
                <button type="button" class="preview-modal-close" onclick="closePreview()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="preview-modal-body">
                <img id="previewImage" src="" alt="Preview" />
            </div>
        </div>
    </div>

    <!-- PDF Preview Modal -->
    <div id="pdfPreviewModal" class="preview-modal">
        <div class="preview-modal-content">
            <div class="preview-modal-header">
                <h5 id="pdfPreviewTitle">Preview</h5>
                <button type="button" class="preview-modal-close" onclick="closePDFPreview()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="preview-modal-body">
                <iframe id="pdfFrame" src=""></iframe>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const mobileValue = '{{ $participant->mobile }}';
        const emergencyValue = '{{ $participant->emergency_contact }}';
        const identityValue = '{{ $participant->identity }}';
        let mobileVisible = false;
        let emergencyVisible = false;
        let identityVisible = false;

        function toggleMobile() {
            mobileVisible = !mobileVisible;
            const display = document.getElementById('mobileValue');
            const btn = document.getElementById('mobileToggle');
            if (mobileVisible) {
                display.textContent = mobileValue;
                btn.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                display.textContent = '••••••••' + mobileValue.slice(-4);
                btn.innerHTML = '<i class="bi bi-eye"></i>';
            }
        }

        function toggleEmergency() {
            emergencyVisible = !emergencyVisible;
            const display = document.getElementById('emergencyValue');
            const btn = document.getElementById('emergencyToggle');
            if (emergencyVisible) {
                display.textContent = emergencyValue;
                btn.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                display.textContent = '••••••••' + emergencyValue.slice(-4);
                btn.innerHTML = '<i class="bi bi-eye"></i>';
            }
        }

        function toggleIdentity() {
            identityVisible = !identityVisible;
            const display = document.getElementById('identityValue');
            const btn = document.getElementById('identityToggle');
            if (identityVisible) {
                display.textContent = identityValue;
                btn.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                display.textContent = '••••' + identityValue.slice(-4);
                btn.innerHTML = '<i class="bi bi-eye"></i>';
            }
        }

        // Preview Functions
        function previewImage(imageSrc, title) {
            document.getElementById('previewTitle').textContent = title;
            document.getElementById('previewImage').src = imageSrc;
            document.getElementById('imagePreviewModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closePreview() {
            document.getElementById('imagePreviewModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        function previewPDF(pdfSrc, title) {
            document.getElementById('pdfPreviewTitle').textContent = title;
            document.getElementById('pdfFrame').src = pdfSrc;
            document.getElementById('pdfPreviewModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closePDFPreview() {
            document.getElementById('pdfPreviewModal').classList.remove('show');
            document.getElementById('pdfFrame').src = '';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the modal content
        document.getElementById('imagePreviewModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closePreview();
            }
        });

        document.getElementById('pdfPreviewModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closePDFPreview();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closePreview();
                closePDFPreview();
            }
        });
    </script>
