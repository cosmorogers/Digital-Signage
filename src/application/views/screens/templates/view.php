<?php
/* @var $this CI_Loader */
/* @var $screens PropelCollection */

$header = array(
    'title' => 'Manage Templates',
    'active' => 'screens',
    'breadcrumbs' => array(
        'Screens' => site_url('screens')
    ),
    'sidemenu' => 'screens'
);
$this->view('templates/header', $header);
?>


    <p class=""><a href="<?php echo site_url('templates/create') ?>" class="btn btn-inverse"><i
                class="icon-white icon-plus-sign"></i> Create a Template</a>
    <table class="table table-striped table-hover table-bordered">
        <thead>
        <tr class="table-headings">
            <th>Name</th>
            <th>Layout</th>
            <th>Screen</th>
            <th class="actions">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($templates as $template): ?>
            <tr>
                <td><?php echo $template->getName(); ?></td>
                <td><?php echo $template->getLayout(); ?></td>
                <td></td>
                <td>
                    <div class="btn-group">
                        <a href="<?php echo site_url('templates/edit/' . $template->getId()); ?>" class="btn"><i
                                class="icon icon-pencil"></i></a>
                        <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="<?php echo site_url('templates/delete/' . $template->getId()); ?>"><i
                                        class="icon-trash"></i> Delete</a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>




<?php $this->view('templates/footer'); ?>