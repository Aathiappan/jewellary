<?php 
$user = auth()->user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      overflow-x: hidden;
    }
	.navbar {
	  background-color: #1E1E2F !important;
	}
    .sidebar {
      position: fixed;
      top: 56px; /* height of navbar */
      left: -250px;
      width: 250px;
      height: 100%;
      /*background: #343a40;
      color: white;*/
      transition: left 0.3s ease;
      z-index: 1040;
	  overflow-y: auto;
	  background-color: #2A2D3E;
	  color: #EAEAEA;

    }

    .sidebar a {
      color: white;
      padding: 12px 20px;
      display: block;
      text-decoration: none;
    }
	.sidebar.collapsed {
	  left: -250px;
	  display:none;
	}
	#main-content {
	  margin-left: 250px;
	  transition: margin-left 0.3s ease;  
	}

	.sidebar.collapsed + #main-content {
	  margin-left: 0;
	}
	@media (max-width: 991.98px) {
	  /* On small screens, sidebar overlays content */
	  .sidebar {
		left: -250px;
		z-index: 1050;
	  }

	  .sidebar.show {
		left: 0;
		display:block;
	  }

	  #main-content {
		margin-left: 0 !important;
	  }
	}
    .sidebar a:hover {
      background: #495057;
    }

    .sidebar.show {
      left: 0;
    }

    @media (min-width: 992px) {
      .sidebar {
        left: 0 ;
        position: fixed;
        height: calc(100vh - 56px);
        top: 56px;
        width: 250px;
        float: left;
      }
      #main-content {
        margin-left: 250px;
      }
	  .sidebar:not(.collapsed) + #main-content {
		  width:calc(100% - 256px);
	   }
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
      <button class="btn btn-dark me-2" id="toggleSidebar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">ATTS Jewellary</a>
      <div class="collapse navbar-collapse d-none d-lg-block">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><span style="color:#faebd7">Admin, <?php echo $user->username; ?> </span></li>
          <!--<li class="nav-item"><a class="nav-link" href="#">Users</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>-->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar bg-dark text-white" id="sidebarMenu">
	<a href="#" class="d-block d-lg-none">Admin, <?php echo $user->username; ?></a>
    <!--<a href="#">Dashboard</a>
    <a href="#">Users</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>-->
	<a href="<?php echo base_url().'admin/category'; ?>">Category</a>
    <a href="<?php echo base_url().'logout'; ?>">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="container-fluid flex-grow-1" id="main-content" style="margin-top: 56px;">