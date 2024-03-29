<!doctype html>
<html lang="en">
  <head>
  <?php
   	/**
		 * Creating a header page for sign-in, sign-out,
		 * dashboard, salespeople, clients, and calls
		 *
		 * PHP version 7.1
		 *
		 * @author     Jugal Patel <jugal.patel1@dcmail.ca>
		 * @version    1.0  (September/9th/2020)
		 */
   
	/*
	PLACED THE FOLLOWING TWO LINES TO DISPLAY ERROR ON SERVER, COMMENT OUT BEFORE SUBMITTING YOUR LAB(S)
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	*/
  //worked on this on September/9th/2020 from session_start to require("./includes/functions.php");
		session_start();
		ob_start();
		require("./constants.php");
		require("./includes/functions.php");
		require("./includes/db.php");		
		
		//$message = isset($_SESSION['message'])?$_SESSION['message']:""; // conditional operator
		$message = flashMessage();		
		//print_r($_SESSION);	
				
	?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
	
	<!-- A script for the pagination -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./css/styles.css" rel="stylesheet">
			
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Company name</a>
        <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
		<?php
		if (isset ($_SESSION["user"]))
		{
			echo  '<a class="nav-link" href="sign-out.php">Sign out</a>';
		}
		else
		{
			echo '<a class="nav-link" href="sign-in.php">Sign In</a>';
		}
		?>
            
        </li>
        </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                <a class="nav-link active" href="./dashboard.php">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file"></span>
                    Orders
                </a>
                </li>
				

				<?php
					if (isset ($_SESSION["user"]))
					{
				?>
				   <li class="nav-item">
                        <a class="nav-link" href="clients.php">
                            <span data-feather="file"></span>
                            Clients
                        </a>
                    </li>
				
				   <li class="nav-item">
                <a class="nav-link" href="calls.php">
                    <span data-feather="file"></span>
                    Calls
                </a>
                </li>
				  <li class="nav-item">
                <a class="nav-link" href="change-password.php">
                    <span data-feather="file"></span>
                    Change Password
                </a>
				   </li>
				<?php
					}
				?>
				
				<?php
					if (isset ($_SESSION["user"]) && $_SESSION["user"]["type"]== ADMIN)
					{
				?>
				   <li class="nav-item">
                <a class="nav-link" href="salespeople.php">
                    <span data-feather="file"></span>
                    Salespeople
                </a>
                </li>
				<?php
					}
				?>
				   
				    <li class="nav-item">
                <a class="nav-link" href="reset.php">
                    <span data-feather="file"></span>
                    Reset
                </a>
                </li>
				
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="shopping-cart"></span>
                    Products
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Customers
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2"></span>
                    Reports
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="layers"></span>
                    Integrations
                </a>
                </li>
				
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Saved reports</span>
                <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Current month
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Last quarter
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Social engagement
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Year-end sale
                </a>
                </li>
            </ul>
            </div>
        </nav>

        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
