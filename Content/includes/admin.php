<?php
  include_once "header.php";
  include_once "../../Models/functions.php";
;?>

<body>
<div class="container-fluid p-0">
  <div class="admin-content">
    <div class="row m-0">
  <div class="sidebar-navigation admin-bg p-0 col-sm-2">
    <ul class="nav">
      <li class= "nav-itemcol-lg-12">
        <div class="img">
          <div class="row m-0">
            <div class="col-lg-4 p-2">
            <img class="rounded-circle border mx-center" src="../images/mojamorda.jpg">
            </div>
            <div class="col-lg-8 p-2">
            <h5 class="user-welcome">Welcome <?php echo $_SESSION['uLogin']; ?></h5> <!--dlugosc imienia nie moze przekroczyc 13 liter-->
            </div>
          </div>
        </div>
      </li>
      <li class= "nav-item col-lg-12 "><a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li class= "nav-item col-lg-12"><a class="nav-link" href="posts.php"><i class="fas fa-file"></i> Posts</a></li>
      <li class= "nav-item col-lg-12"><a class="nav-link" href="pages.php"><i class="fas fa-book-open"></i> Pages</a></li>
      <li class= "nav-item col-lg-12"><a class="nav-link" href="categories.php"><i class="fas fa-list"></i> Categories</a></li>
      <li class= "nav-item col-lg-12"><a class="nav-link" href="products.php"><i class="fas fa-box"></i> Products</a></li>
      <li class= "nav-item col-lg-12"><a class="nav-link" href="customers.php"><i class="fas fa-users"></i> Customers</a></li>
      <li class= "nav-item col-lg-12"><a class="nav-link" href="tables.php"><i class="fas fa-table"></i> Tables</a></li>
      <li class= "nav-item col-lg-12"><a class="nav-link" href="charts.php"><i class="fas fa-chart-line"></i> Charts</a></li>
    </ul>
 </div>
<div class="content p-0 col-sm-10">
  <div class="top-navigation ">

    <ul class="nav justify-content-end pr-3 admin-bg">
      <li class= "nav-item"><a class="nav-link" href="../../public_html/index.php"><i class="fas fa-home"></i> Homepage</a></li>
      <li class= "nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"><i class="fas fa-user"></i> <?php echo $_SESSION['uLogin']; ?> </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="profile.php"><i class="fas fa-user-edit"></i> Edit Profile</a>
            <a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> Messages</a>
            <a class="dropdown-item" href="#"><i class="fas fa-cogs"></i> Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../../Controllers/logout.php"><i class="fas fa-door-open"></i> Log Out</a>
        </div>
      </li>
    </ul>
  </div>
