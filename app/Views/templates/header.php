<!doctype html>
<html>

<head>
    <title>Internshala Assignment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <span class="navbar-brand" href="#"><?= esc($title) ?></span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if (session()->has('user_id') && session()->has('username')) : ?>
                    <li class="nav-item">
                        <span class="nav-link">Hi, <?= esc(session()->get('fullname')) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                <?php endif ?>

                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/view_available_cars">Available Cars</a>
                </li>
                <?php if (session()->has('user_id') && session()->has('username') && session()->get('user_type') == 'agency') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/add_cars">Add Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/view_booked_cars">View Booked Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/view_all_cars">View Your Cars</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</body>

</html>