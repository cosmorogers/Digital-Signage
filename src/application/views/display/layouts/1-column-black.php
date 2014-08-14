<?php
/* $screen Screen */
$layoutDescription = array(
    'name' => "1 Column (Black Background)",
    'desc' => "A simple 1 column layout with black background. Good for full screen slideshows",
    'containers' => array(
        array(
            'name' => 'main',
            'desc' => 'Appears in the main column'
        )
    ),
    'has_title' => false,
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
            background: #000;
        }
        .hero-unit {
            padding: 10px 30px 30px;
        }
        .hero-unit h1 {
            font-size: 40px;
        }
    </style>

</head>

<body>

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


