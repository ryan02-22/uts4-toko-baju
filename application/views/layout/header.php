<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Luxe Threads'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="<?= base_url(); ?>" class="logo">LUXE.<span>THREADS</span></a>

            <ul class="nav-links">
                <li><a href="<?= base_url(); ?>" class="active">Home</a></li>
                <li><a href="<?= base_url('transaksi'); ?>">Transaksi</a></li>
                <li><a href="#">Men</a></li>
                <li><a href="#">Women</a></li>
                <li><a href="#">Collections</a></li>
            </ul>

            <div class="nav-actions">
                <a href="#" class="icon-link" title="Search"><i class="fas fa-search"></i></a>
                <a href="#" class="icon-link" title="Cart"><i class="fas fa-shopping-bag"></i><span class="badge">0</span></a>
                <?php if($this->session->userdata('logged_in')): ?>
                    <a href="<?= base_url('auth/logout'); ?>" class="btn-primary-outline"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <?php else: ?>
                    <a href="<?= base_url('auth/login'); ?>" class="btn-primary-outline"><i class="fas fa-user"></i> Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <main>
