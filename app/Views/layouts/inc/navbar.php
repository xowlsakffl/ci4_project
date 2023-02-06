<nav class="navbar navbar-expand-md navbar-light bg-light p-3">
    <div class="container-fluid">
        <a href="<?=base_url()?>" style="max-width:170px;"><img src="/img/Logo.png" alt="" class="mw-100"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item px-2">
                    <a href="/news" class="nav-link position-relative">
                        <i class="bi bi-bell" style="font-size:22px;margin-right: 3px;"></i>
                        <span class="badge bg-primary badge-number" style="position:absolute;right:0px">4</span>
                    </a>
                </li>
                <li class="nav-item dropdown mr-lg-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Name
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?=base_url().'/logout'?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>