<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-blue: #00246B;
            --light-blue: #CADCFC;
            --bg-color: #f4f7fb;
        }
        body {
            background-color: var(--bg-color);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .navbar {
            background-color: var(--dark-blue) !important;
            padding: 15px 0;
        }
        .navbar-brand {
            color: var(--light-blue) !important;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 1.5rem;
        }
        .nav-link {
            color: var(--light-blue) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: #fff !important;
            transform: translateY(-1px);
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 36, 107, 0.08);
            background-color: #ffffff;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s ease;
            margin-bottom: 30px;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 36, 107, 0.15);
        }
        h1, h2, h3, h4, h5, h6 {
            color: var(--dark-blue);
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        /* Premium Hover Effects in All Buttons */
        .btn {
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .btn::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255,255,255,0.1);
            z-index: -2;
        }
        .btn::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background-color: rgba(255,255,255,0.2);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index: -1;
        }
        .btn-danger::before {
             background-color: rgba(0,0,0,0.15);
        }
        .btn:hover::before {
            width: 100%;
        }
        .btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 36, 107, 0.3);
            color: #fff;
        }
        
        .btn-primary {
            background-color: var(--dark-blue);
            color: #fff;
        }
        .btn-success {
            background-color: #198754;
            color: white;
        }
        .btn-success:hover {
            box-shadow: 0 10px 20px rgba(25, 135, 84, 0.4);
        }
        .btn-warning {
            background-color: var(--light-blue);
            color: var(--dark-blue);
            font-weight: 600;
        }
        .btn-warning:hover {
            background-color: #b3ccfa;
            color: var(--dark-blue);
            box-shadow: 0 10px 20px rgba(202, 220, 252, 0.6);
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.4);
        }
        .btn-sm {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        /* Table Styles */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            background-color: #fff;
        }
        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-dark {
            background-color: var(--dark-blue) !important;
            color: #fff;
        }
        .table-dark th {
            background-color: var(--dark-blue) !important;
            border-color: #001845;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            padding: 16px 15px;
        }
        .table-hover tbody tr {
            transition: all 0.3s ease;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(202, 220, 252, 0.2) !important;
            transform: scale(1.005);
            box-shadow: 0 5px 15px rgba(0, 36, 107, 0.05);
            z-index: 10;
            position: relative;
        }
        .table td {
            vertical-align: middle;
            padding: 15px;
            border-bottom: 1px solid #eef2f7;
            color: #555;
            font-weight: 400;
        }

        /* Form Controls */
        .form-control {
            border-radius: 10px;
            border: 2px solid #eef2f7;
            padding: 14px 18px;
            transition: all 0.3s ease;
            background-color: #f9fbfd;
            font-weight: 400;
            color: #333;
        }
        .form-control:focus {
            border-color: var(--light-blue);
            box-shadow: 0 0 0 4px rgba(202, 220, 252, 0.4);
            background-color: #fff;
            transform: translateY(-2px);
        }
        label {
            color: var(--dark-blue);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
            font-weight: 500;
        }
        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border-left: 5px solid #198754;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border-left: 5px solid #dc3545;
        }
        
        .premium-bg {
            background: linear-gradient(135deg, var(--dark-blue) 0%, #001845 100%);
            color: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0, 36, 107, 0.2);
            position: relative;
            overflow: hidden;
        }
        .premium-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(202,220,252,0.1) 0%, transparent 60%);
            z-index: 0;
        }
        .premium-bg > * {
            position: relative;
            z-index: 1;
        }
        .premium-bg h1 {
            color: var(--light-blue);
            font-weight: 700;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gem me-2" viewBox="0 0 16 16">
                    <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 .01-.644zM10.5 2.7 8 6.53 5.5 2.7zm2.256 0H12l-2.4 3.2zM3 2.7H1.244l2.4 3.2zM.5 4.7 8 14.7 15.5 4.7z"/>
                </svg>
                PremiumApp
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/students') }}">Students</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
