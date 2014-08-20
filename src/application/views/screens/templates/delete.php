<?php
/* @var $this CI_Loader */
/* @var $template Template */

$header = array (
    'title' => 'Delete Template',
    'active' => 'screens',
    'breadcrumbs' => array (
        'Screens' => site_url('screens'),
        'Manage Templates' => site_url('templates')
    ),
    'sidemenu' => 'screens'
);


$this->view('templates/header', $header);

$this->helper('form');
?>

    <div class="alert alert-error alert-block">
        <?php echo form_open('', array('class'=>'form-horizontal'))?>
        <h5>Are you sure you want to delete the template "<?php echo $template->getName(); ?>" ?</h5>
        <p>This action is <strong>NOT</strong> reversible.</p>
        <input type="hidden" name="confirm" value="<?php echo $template->getId()?>">
        <button type="submit" class="btn btn-danger">Yes</button>
        <a href="<?php echo site_url('templates')?>" class="btn btn-success">No</a>
        </form>
    </div>
<?php $this->view('templates/footer');?>