<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="<?php echo base_url();?>public/assets/Adminto/images/gwc-icon.png">
	<title>@yield('page_title')</title>
	@include('template.includes.header')	
</head>
<!-- You can edit body class depending on what template you are using! -->
<body class="loading" data-layout-color="light"  data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>
	<div id="wrapper">
		@include('template.includes.navbar')

		@include('template.includes.sidebar')

		@yield('page_content')

		@include('template.includes.footer')
	</div>
</body>
</html>