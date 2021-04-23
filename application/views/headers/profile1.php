<!DOCTYPE html>
<html lang="en">
<!--<html xml:lang="ar" lang="ar" dir="" xmlns="http://www.w3.org/1999/xhtml">-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo lang('profile'); ?></title>
	<link rel="shortcut icon" href="<?php if(isset($system->logo) && $system->logo != '') echo base_url().'imgs/'.$system->logo; ?>">

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>gentelella-master/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>gentelella-master/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>gentelella-master/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
