<?php 
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $metadata['title'] ?? ''; ?></title>
    <meta name="description" content="<?= $metadata['description'] ?? ''; ?>">
    <meta name="keywords" content="<?=  $metadata['keywords'] ?? ''; ?>">
    <?php include_once VIEW_BASE_PATH .'partials/head.php'; ?>
</head>
<body>


<nav class="navbar navbar-expand-md bg-body-tertiary">
  	<div class="container-xl">
		<a class="navbar-brand" href="<?= route('home'); ?>">
			<img src="https://codingyaar.com/wp-content/uploads/coding-yaar-logo.png" alt="">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/') echo "btn-dark text-white"; ?>"  href="<?= route('home'); ?>">Home</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/users') echo "btn-dark text-white"; ?>" href="<?= route('users'); ?>">All Users</a>
				</li>
                <li class="nav-item">
					<a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/register') echo "btn-dark text-white"; ?>" href="<?= route('User'); ?>">Register</a>
				</li>
                <li class="nav-item">
					<a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/login') echo "btn-dark text-white"; ?>" href="<?= route('showLoginForm'); ?>">Login</a>
				</li>
                <li class="nav-item">
					<a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/dashboard') echo "btn-dark text-white"; ?>" href="<?= route('dashboard'); ?>">Dashboard</a>
				</li>
			</ul>
			<div class="search-and-icons">
				<form class="d-flex mb-2 me-2" role="search">
					<input class="form-control me-2" type="search" aria-label="Search">
				</form>
				<div class="user-icons d-flex mb-2">
					<div class="profile"><i class="bi bi-person"></i></div>
					<div class="wishlist"><i class="bi bi-heart"></i></div>
					<div class="cart"><i class="bi bi-cart3"></i></div>
				</div>
			</div>
			<div class="contact-info d-md-flex">
				<p>+0987654321 | +1234567890 </p>
				<p><a href="mailto:">contact@domainname.com</a></p>
			</div>
		</div>
  </div>
</nav>