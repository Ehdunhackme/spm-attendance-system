<?php 
include '../Includes/dbcon.php';

// Set timezone to GMT+8
date_default_timezone_set('Asia/Kuala_Lumpur');

// Initialize $fullName variable
?>
<nav class="navbar navbar-expand navbar-light bg-gradient-primary topbar mb-4 static-top">
  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
  <div class="text-white big" style="margin-left:100px;"><b></b></div>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      </a>
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
        aria-labelledby="searchDropdown">
        <form class="navbar-search">
          <div class="input-group">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>
 
    <div class="topbar-divider d-none d-sm-block"></div>
    <li class="nav-item no-arrow">
      <a class="nav-link" href="logout.php">
        <i class="fas fa-power-off fa-fw mr-2 text-danger"></i>
        Log Keluar
      </a>
    </li>
  </ul>
</nav>
