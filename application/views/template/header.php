<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Universal Tag Manager Portal</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/fullcalendar.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/maruti-style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/maruti-media.css" class="skin-color" />
        <link rel="icon" href="<?php echo base_url(); ?>resources/img/logosmall.png" sizes="192x192" />
    </head>
    <body>

        <!--Header-part-->
        <div id="header">
            <h1><a href="<?php echo base_url(); ?>dashboard.html">Maruti Admin</a></h1>
        </div>
        <!--close-Header-part--> 

        <!--top-Header-messaages-->
        <div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
        <!--close-top-Header-messaages--> 

        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <div class="pull-left"><h3 class="text-info"><img src="<?php echo base_url(); ?>resources/img/logosmall.png" width="80"  />&nbsp;&nbsp;Universal Tag Manager Portal</h3></div>
            <ul class="nav pull-right">
                <li class="" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
                <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
                <li class=""><a title="" href="<?php echo base_url()."logout"; ?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>
        <!--close-top-Header-menu-->
        <div id="content" style="min-height: 830px;">
            <div class="container-fluid">
                <?php echo (isset($msg)&&!empty($msg))?$msg:'';  ?>
                <div class="quick-actions_homepage">
                    <ul class="quick-actions">
                        <li> <a href="<?php echo base_url(); ?>"> <i class="icon-dashboard"></i> My Dashboard </a> </li>
                        <li> <a href="<?php echo base_url(); ?>sites"> <i class="icon-web"></i> My Sites </a> </li>
                    </ul>
                </div>