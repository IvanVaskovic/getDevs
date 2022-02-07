<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <!-- sidebar start -->
          <li class="nav-item">
            <a class="nav-link" href="home.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Welcome</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./account.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Account</span>
            </a>
          </li>
          <li class="nav-item <?= (isset($sidebar_active)) ? $sidebar_active : '' ?>">
            <a class="nav-link" href="./devs_1.php">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">Devs</span>
            </a>
          </li>
          <li class="nav-item <?= (isset($sidebar_active_comp)) ? $sidebar_active_comp : '' ?>">
            <a class="nav-link" href="companies_1.php">
              <i class="icon-briefcase menu-icon"></i>
              <span class="menu-title">Companies</span>
            </a>
          </li>
          <?php if ($user == 'admin' || $user == 'company') : ?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-square-check menu-icon"></i>
              <span class="menu-title">Projects</span>          <!-- to be updated -->
            </a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="./about_us.php">
              <i class="icon-help menu-icon"></i>
              <span class="menu-title">About Us</span>
            </a>
          </li>
          <?php if ($user == 'admin') : ?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-cog menu-icon"></i>
              <span class="menu-title">Admin</span>          <!-- to be updated -->
            </a>
          </li> 
          <?php endif; ?>
          <!-- sidebar end -->
        </ul>
      </nav>