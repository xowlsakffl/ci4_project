<nav class="navbar navbar-expand-lg bg-dark fixed-top" style="height:70px">
    <div class="container-fluid">
        <a href="<?=base_url()?>" style="max-width:170px;"><img src="/img/Logo.png" alt="" class="mw-100"></a>
        <div class="d-flex align-items-center mx-3">
            <a href="/news" class="nav-link position-relative mx-4">
                <i class="bi bi-bell" style="font-size:22px;margin-right: 3px;"></i>
                <span class="badge bg-primary badge-number" style="position:absolute;right:0px">4</span>
            </a>
            <div class="dropdown pt-3 pb-3">
                <a class="dropdown-toggle text-white text-decoration-none" href="#" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?=auth()->user()->username?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <?php if(auth()->loggedIn()){?>
                        <li><a class="dropdown-item" href="#">마이페이지</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?=base_url().'/logout'?>">로그아웃</a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</nav>