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