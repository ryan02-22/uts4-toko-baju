<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Admin Dashboard - Luxe Threads'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <style>
        /* Admin Sidebar */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            color: #fff;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .sidebar .logo {
            color: #fff;
            font-size: 20px;
            margin-bottom: 30px;
            display: block;
            text-align: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .logo span {
            color: var(--secondary-color);
        }

        .sidebar-menu {
            list-style: none;
            margin-top: 20px;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.7);
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--secondary-color);
            color: #1a1a1a;
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            margin-left: 260px;
            padding-top: 80px;
            background-color: #f5f5f5;
        }

        .top-nav {
            background: white;
            padding: 20px 30px;
            position: fixed;
            top: 0;
            right: 0;
            left: 260px;
            z-index: 998;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-nav h1 {
            font-size: 24px;
            color: var(--primary-color);
            margin: 0;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 6px;
            transition: var(--transition);
        }

        .user-profile:hover {
            background-color: #f0f0f0;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary-color), #a08830);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .page-content {
            padding: 30px;
            margin-top: 0;
        }

        .breadcrumb {
            margin-bottom: 30px;
            font-size: 14px;
            color: var(--text-light);
        }

        .breadcrumb a {
            color: var(--secondary-color);
            margin: 0 5px;
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content,
            .top-nav {
                margin-left: 200px;
            }

            .top-nav {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 250px;
                left: -250px;
                transition: left 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content,
            .top-nav {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="<?= base_url('admin'); ?>" class="logo">LUXE.<span>THREADS</span></a>

            <ul class="sidebar-menu">
                <li>
                    <a href="<?= base_url('admin'); ?>" class="<?= current_url() == base_url('admin') || current_url() == base_url('admin/') ? 'active' : ''; ?>">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/profile'); ?>" class="<?= strpos(current_url(), 'profile') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/transaksi'); ?>" class="<?= strpos(current_url(), 'transaksi') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-receipt"></i>
                        <span>Transactions</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('auth/logout'); ?>">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navigation -->
            <nav class="top-nav">
                <h1><?= isset($title) ? $title : 'Admin Dashboard'; ?></h1>
                <div class="user-menu">
                    <div class="user-profile" onclick="toggleUserMenu()">
                        <div class="user-avatar"><?= strtoupper(substr($this->session->userdata('user'), 0, 1)); ?></div>
                        <div>
                            <div style="font-weight: 600; color: var(--primary-color);"><?= $this->session->userdata('user'); ?></div>
                            <div style="font-size: 12px; color: var(--text-light);"><?= ucfirst($this->session->userdata('role')); ?></div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="page-content">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span><?= $this->session->flashdata('success'); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?= $this->session->flashdata('error'); ?></span>
                    </div>
                <?php endif; ?>