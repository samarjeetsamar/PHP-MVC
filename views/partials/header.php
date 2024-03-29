<?php 
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- //header css -->
    <style>
        .navbar {
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
            }
            .navbar .navbar-brand img {
            max-width: 100px;
            }
            .navbar .navbar-nav .nav-link {
            color: #000;
            }
            @media screen and (min-width: 1024px) {
            .navbar {
                letter-spacing: 0.1em;
            }
            .navbar .navbar-nav .nav-link {
                padding: 0.5em 1em;
            }
            .search-and-icons {
                width: 50%;
            }
            .search-and-icons form {
                flex: 1;
            }
            }
            @media screen and (min-width: 768px) {
            .navbar .navbar-brand img {
                max-width: 7em;
            }
            .navbar .navbar-collapse {
                display: flex;
                flex-direction: column-reverse;
                align-items: flex-end;
            }
            .search-and-icons {
                display: flex;
                align-items: center;
            }
            }
            .search-and-icons form input {
            border-radius: 0;
            height: 2em;
            background: #fff
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='grey' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E")
                no-repeat 95%;
            }
            .search-and-icons form input:focus {
            background: #fff;
            box-shadow: none;
            }
            .search-and-icons .user-icons div {
            padding-right: 1em;
            }
            .contact-info p,
            .contact-info a {
            font-size: 0.9em;
            padding-right: 1em;
            color: grey;
            }
            .contact-info a {
            padding-right: 0;
            }
</style>
    
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