
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="bootstrap material admin template">
		<meta name="viewport" content="width=device-width">
		<title><?= (isset($title)?$title:'Tradeworthy'); ?></title>
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300%7CRaleway:400,300%7CRoboto:400,700,300%7CLato' rel='stylesheet' type='text/css' />
		<!--  Icon CSS -->
		<link rel="stylesheet" href="../assets/css/global/iconstyle.css" />
		<link rel="stylesheet" href="../assets/fonts/font-awasome/font-awesome.min.css" />
		<!-- Global plugin CSS -->
		<link class="nor-css" rel="stylesheet" href="../assets/css/global/bootstrap.min.css" />
		<!--  Global Template CSS -->
		<link rel="stylesheet" href="../assets/css/global/style.css" />
		<link id="site-color" rel="stylesheet" href="../assets/css/colors/default.css" />
		<link rel="stylesheet" href="../assets/css/global/responsive.css" />
		<link rel="stylesheet" href="../assets/css/global/site.min.css" />
		<!--  Page plugin CSS -->
		<link rel="stylesheet" href="../assets/fonts/font-awasome/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/css/sort-nestable/tasklist.min.css" />
		<link rel="stylesheet" href="../assets/css/calendar/fullcalendar.css" />
		<link rel="stylesheet" href="../assets/fonts/weather/weather-icons.min.css" />
		<link href="../assets/css/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css"/>
		<link href="../assets/css/morrischarts/morris.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/c3-chart/c3.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../assets/plugin/magnific-popup/css/magnific-popup.min.css">
		<!--  Page CSS -->
		<link rel="stylesheet" href="../assets/css/google-map/custom-map.css" />
		<link rel="stylesheet" href="../assets/css/calendar/custom.css" />
		<link rel="stylesheet" href="../assets/css/dashboard/dashboard_v3.css" />
		<link href="../assets/css/c3-chart/c3.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/b-1.2.4/r-2.1.0/rr-1.2.0/datatables.min.css"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../public/css/style.css?cache=<?= time(); ?>">
		<link rel="stylesheet" type="text/css" href="../public/css/responsive.css?cache=<?= time(); ?>">
	</head>
	<body class="dashboard site-navbar-small site-menu-left site-menu-top">
		<!-- Start Header Section -->
		<div class="main-header navbar navbar-fixed-top navbar-inverse navbar-mega" style="background-color: #006064; border-color: #006064">
			<div class="navbar-header">
				<!--  Template Logo -->
				<a class="navbar-brand" href="home">
					<!-- <img class="navbar-brand-logo navbar-brand-logo-normal" src="../assets/images/logo.png" title="Tradeworthy" alt="logo"> -->
					Tradeworthy
				</a>
			</div>
			<div class="navbar-container container-fluid">
				<div class="collapse navbar-collapse navbar-block navbar-collapse-toolbar" id="site-navbar-collapse">
					<!--  Menu -->
					<div class="utmenucontainer">
						<div class="overlapblackbg"></div>
						<a id="wsnavtoggle" class="animated-arrow"><span></span></a>
						<nav class="utmenu">
							<ul class="mobile-sub utmenu-list">
								<li>
									<div class="navbar-header mobile-res-logo">
										<a class="navbar-brand" href="javascript:void(0)">
											<img class="navbar-brand-logo navbar-brand-logo-normal" src="../assets/images/logo.png" title="Porish" alt="logo">
										</a>
									</div>
								</li>
								
							</ul>
						</nav>
					</div>
					<ul class="nav navbar-nav navbar-toolbar">
						<li class="toggle-menu">
							<div>
								<button class="button-menu-mobile open-left waves-effect">
								<i class="icon_menu"></i>
								</button>
							</div>
						</li>
						
					</ul>
					<ul class="nav navbar-nav navbar-toolbar navbar-right">
						<li id="search-icon">
							<!--  Toggle Search  -->
							<!-- <a class="icon icon_search waves-effect waves-light" href="javascript:void(0)" role="button">
								<span class="sr-only">Toggle Search</span>
							</a> -->
						</li>
						<li class="dropdown">
							<!--  Profile Section -->
							<!-- <ul class="dropdown-menu dropdown-top-border position-absolute" role="menu">
								<li role="presentation">
									<a href="my-jobs" role="menuitem"><i class="icon icon_profile" aria-hidden="true"></i> My Jobs </a>
								</li>
								<li role="presentation">
									<a href="add-job" role="menuitem"><i class="icon icon_briefcase_alt" aria-hidden="true"></i> Add a Job </a>
								</li>
								<li role="presentation">
									<a href="edit-details" role="menuitem"><i class="icon icon_pencil" aria-hidden="true"></i> Edit Details </a>
								</li>
								<li role="presentation">
									<a href="change-password" role="menuitem"><i class="icon icon_cog" aria-hidden="true"></i> Change Password </a>
								</li>
								<li class="divider" role="presentation"></li>
								<li role="presentation">
									<a href="logout" role="menuitem"><i class="icon icon_lock_alt" aria-hidden="true"></i> Logout</a>
								</li>
							</ul> -->
						</li>
						<li>
							<!--  Toggle Search  -->
							<a class="waves-effect waves-light" href="login" role="button">
								Login
							</a>
						</li>
						<li>
							<!--  Toggle Search  -->
							<a class="waves-effect waves-light" href="register" role="button">
								Sign Up
							</a>
						</li>
					</ul>
				</div>
				<div class="navbar-search-overlap" id="site-navbar-search">
					<form role="search">
						<div class="form-group">
							<!--  Search Box -->
							<div class="input-search">
								<i class="input-search-icon icon_search" aria-hidden="true"></i>
								<input type="text" class="form-control" name="site-search" placeholder="Search...">
								<button type="button" class="input-search-close icon icon_close" aria-label="Close"></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="left-side-menu">
			<!--  Menu -->
			<div class="sidebar-menu">
				<ul>
					<li class="site-menu-title">
						<!-- General
						<span class="title-i"></span> -->
					</li>
					<li>
						<!-- <a class="" href="/crm/index.php">  <span>Dashboard</span></a> -->
					</li>
					<li>
						<!-- <a class="" href="/crm/add-lead.php"> <span> Add Lead </span> </a> -->
					</li>
					<li>
						<!-- <a tabindex="0" class="" id="popoverLink" role="button" data-toggle="popover" data-container="body" data-content="" title="Today's Callbacks" data-html="true"> Due Callbacks <span class="callbackCount">$callbackCount['count(lead_id)'] </span></a> -->
					</li>
					<li>
						<!-- <a class="" href="/crm/view-callbacks.php"> <span> View all Callbacks </span> </a> -->
					</li>
				</ul>
			</div>
		</div>
		<!-- End Header Section -->
		<!-- Start Contain Section -->
		<div class="main-content">
			<div class="page-content container-fluid">
				<div class="main-dashboard">