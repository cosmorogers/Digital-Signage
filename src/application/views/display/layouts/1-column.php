<?php
/* $screen Screen */
$layoutDescription = array(
    'name' => "1 Column",
    'desc' => "A simple 1 column layout",
    'containers' => array(
        array(
            'name' => 'main',
            'desc' => 'Appears in the main column'
        )
    ),
    'has_title' => true,
);

$t = $screen->getTemplate();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BAS::Digital Signage System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/admin.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/smoothness/jquery-ui-1.10.1.custom.min.css'); ?>" rel="stylesheet">
<!-- weather!! -->
    <link href="<?php echo base_url('assets/css/meteocons/stylesheet.css');?>" rel="stylesheet">


    <style type="text/css">
        body, html {
            overflow: hidden;
            width: <?= $screen->getWidth() ?>px;
            height: <?= $screen->getHeight() ?>px;
            padding-top: 0;
        }
        .hero-unit {
            padding: 10px 30px 30px;
        }
        .hero-unit h1 {
            font-size: 40px;
        }
        /* pager */
        .cycle-pager {
            text-align: center; width: 100%; z-index: 500; position: absolute; bottom: -40px; overflow: hidden;
        }
        .cycle-pager span {
            font-family: arial; font-size: 50px; width: 16px; height: 16px;
            display: inline-block; color: #ddd; cursor: pointer;
        }
        .cycle-pager span.cycle-pager-active { color: #8D1950;}
        .cycle-pager > * { cursor: pointer;}
        #progress { position: absolute; bottom: -30px; height: 1px; width: 0px; background: #8D1950; z-index: 500; }
        .table th, .table td { text-align: center; vertical-align: middle;}
    </style>

</head>

<body>
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="#"><img src="<?php echo base_url('assets/img/logo_w.png'); ?>"/></a>

            <h2 style="color:#FFF; text-align:center; padding-right:37px;"><?php echo $screen->getName(); ?></h2>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?php echo (!is_null($t) ? $t->getWidgetsInContainer('main', $screen) : ''); ?>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.9.1.js');?>"></script>
<script src="<?php echo base_url('assets/js/refresh-screen.js');?>"></script>
<?php if(!is_null($t)):?>
    <?php foreach ($t->getScripts() as $script) : ?>
        <script src="<?php echo base_url('assets/js/' . $script); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>


