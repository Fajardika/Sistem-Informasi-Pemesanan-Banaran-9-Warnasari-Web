    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top shadow  background_admin">
    <div class="container-fluid">
        <button class="navbar-toggler btn-outline-success" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-justify text-white"></i>
        </button>
        <!-- Button Logout -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item" id="right">
            <button type="button" class="btn dropdown-toggle text-white btn-sm mt-1 pb-1" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" id="btn_user">
                <i class="bi bi-person-circle"></i></i> User
            </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="nav-link ms-3" href="../index.php" id="gambar3">Home</a></li>
                    <li><a class="nav-link ms-3" href="../menu.php" id="gambar3">Menu</a></li>
                    <li><a class="nav-link ms-3" href="../gallery.php" id="gambar3">Gallery</a></li>
                    <li class="border-bottom border-success"><a class="nav-link ms-3" href="../about.php" id="gambar3">About Us</a></li>
                    <div class="d-grid gap-2 me-2 ms-2 mt-2"> 
                        <button type="button" onclick="logout_2()" class="btn text-white rounded-pill btn-sm" id="btn_user3">Logout</button>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
    </nav>