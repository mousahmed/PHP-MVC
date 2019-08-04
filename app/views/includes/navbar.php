<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <a class="navbar-brand" href="/"><?= SITENAME ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item ">
                    <a class="nav-link" href="/posts">Posts</a>
                </li>
                <?php if ($_SESSION['user_admin'] == 1): ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="/comments">Comments</a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>


        </ul>
        <!--  <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
          </form>-->

        <?php if (isset($_SESSION['user_id'])): ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $_SESSION['user_name'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/users/logout">logout</a>
                    </div>
                </li>
            </ul>
        <?php else: ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="/users/register">Register</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/users/login">Login</a>
                </li>
            </ul>
        <?php endif; ?>
    </div>


</nav>