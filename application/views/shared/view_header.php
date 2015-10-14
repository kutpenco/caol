<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <title><?='Admin - '.$page_title;?></title>
        <!-- Bootstrap Core CSS -->
        <link href="<?=base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="<?=base_url('assets/bower_components/metisMenu/dist/metisMenu.min.css');?>" rel="stylesheet">
        <!-- Timeline CSS -->
        <link href="<?=base_url('assets/css/timeline.css');?>" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="<?=base_url('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');?>" rel="stylesheet">
        <!-- DataTables Responsive CSS -->
        <link href="<?=base_url('assets/bower_components/datatables-responsive/css/dataTables.responsive.css');?>" rel="stylesheet">
        <!-- Bootstrap validator CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/bower_components/bootstrapvalidator/dist/css/bootstrapValidator.min.css');?>"/>
        <!-- Datetime Picker library -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url('assets/bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');?>">
        <!-- Morris Charts CSS -->
        <link href="<?=base_url('assets/bower_components/morrisjs/morris.css');?>" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?=base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?=base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

        <!-- Chosen Library -->
        <link href="<?=base_url('assets/bower_components/chosen_v1.4.0/chosen.min.css');?>" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js');?>"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js');?>"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="<?=base_url('assets/img/logo.gif');?>" alt=""></a>
                </div>
                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <img class="img-rounded" src="<?=base_url('assets/img/no-profile-picture-male.jpg');?>" height="32px" width="32px">  <?=$current_user;
?> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">


                    <li><a href="<?=base_url('logout/');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="#"><i class="fa fa-suitcase fa-fw"></i> Consultor <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false">
                        <li>
                            <a href="<?=base_url('consultor/relatorio')?>"><i class="fa fa-file-text-o fa-fw"></i> Relatorio</a>
                        </li>
                        <li>
                            <a href="<?=base_url('consultor/grafico')?>"><i class="fa fa-bar-chart fa-fw"></i> Gráfico</a>
                        </li>
                        <li>
                            <a href="<?=base_url('consultor/pizza')?>"><i class="fa fa-pie-chart fa-fw"></i> Pizza</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> Cliente <span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level collapse" aria-expanded="false">
                        <li>
                            <a href="<?=base_url('cliente/relatorio')?>"><i class="fa fa-file-text-o fa-fw"></i> Relatorio</a>
                        </li>
                        <li>
                            <a href="<?=base_url('cliente/grafico')?>"><i class="fa fa-file fa-fw"></i> Gráfico</a>
                        </li>
                        <li>
                            <a href="<?=base_url('cliente/pizza')?>"><i class="fa fa-pie-chart fa-fw"></i> Pizza</a>
                        </li>
                    </ul>

                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>