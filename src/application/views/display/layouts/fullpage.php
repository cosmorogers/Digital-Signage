<?php
/* $screen Screen */
$layoutDescription = array(
    'name' => "Full Page",
    'desc' => "A simple full page 1 column layout",
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
    <style type="text/css">
        body, html {
            overflow: hidden;
            width: <?= $screen->getWidth() ?>px;
            height: <?= $screen->getHeight() ?>px;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
<script src="<?php echo base_url('assets/js/jquery-1.9.1.js');?>"></script>
<script src="<?php echo base_url('assets/js/refresh-screen.js');?>"></script>
  <?php echo (!is_null($t) ? $t->getWidgetsInContainer('main', $screen) : ''); ?>



<?php if(!is_null($t)):?>
    <?php foreach ($t->getScripts() as $script) : ?>
        <script src="<?php echo base_url('assets/js/' . $script); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>

