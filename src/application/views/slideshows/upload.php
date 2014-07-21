<?php 
/* @var $this CI_Loader */
/* @var $slideshow Slideshow */
/* @var $id int */

$header = array (
		'title' => 'Upload images',
		'active' => 'slideshows',
		'breadcrumbs' => array (
				'Slideshows' => site_url('slideshows')
		),
		'sidemenu' => 'slideshows'
);


$this->view('templates/header', $header);
$this->helper('form');
?>


<!-- Bootstrap CSS fixes for IE6 -->
<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
<!-- Bootstrap Image Gallery styles -->
<!--<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">-->
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fileupload-ui.css'); ?>">

<?php echo form_open_multipart(site_url('slideshows/doupload'), array('id'=>'fileupload'))?>
	<!-- Redirect browsers with JavaScript disabled to the origin page -->
	<noscript></noscript>
	<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
	<div class="fileupload-buttonbar">
		<div class="span9">
			<!-- The fileinput-button span is used to style the file input field as button -->
			<span class="btn btn-success fileinput-button"> <i class="icon-plus icon-white"></i> <span>Add files...</span> 
				<input type="file" name="files[]" multiple>
			</span>
			<button type="submit" class="btn btn-primary start">
				<i class="icon-upload icon-white"></i> <span>Start upload</span>
			</button>
			<button type="reset" class="btn btn-warning cancel">
				<i class="icon-ban-circle icon-white"></i> <span>Cancel upload</span>
			</button>
			
			Slideshow(s) to add to:
			<select name="slideshows[]" id="slideshows-multiselect" multiple="multiple" style="vertical-align: top;">
				<?php foreach ($slideshows as $slideshow) : /* @var $slideshow Slideshow */?>
                <option value="<?=$slideshow->getId()?>" <?= ($slideshow->getId() == $id ? 'selected' : '')?>><?= $slideshow->getName()?></option>
                <?php endforeach;?>
            </select>
		</div>
		<!-- The global progress information -->
		<div class="span3 fileupload-progress fade">
			<!-- The global progress bar -->
			<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
				<div class="bar" style="width: 0%;"></div>
			</div>
			<!-- The extended global progress information -->
			<div class="progress-extended">&nbsp;</div>
		</div>
	</div>
	<!-- The loading indicator is shown during file processing -->
	<div class="fileupload-loading"></div>
	<br>
	<!-- The table listing the files available for upload/download -->
	<table role="presentation" class="table table-striped">
		<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
	</table>
</form>


<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td>{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td>{% if (!i) { %}
            <button class="btn btn-warning cancel">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
    </tr>
{% } %}
</script><?php /*
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url('assets/js/upload/vendor/jquery.ui.widget.js');?>"></script>

<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo base_url('assets/js/upload/tmpl.min.js');?>"></script>

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo base_url('assets/js/upload/load-image.min.js');?>"></script>

<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo base_url('assets/js/upload/canvas-to-blob.min.js');?>"></script>

<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
<script src="<?php echo base_url('assets/js/upload/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/upload/bootstrap-image-gallery.min.js');?>"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url('assets/js/upload/jquery.iframe-transport.js');?>"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url('assets/js/upload/jquery.fileupload.js');?>"></script>
<!-- The File Upload file processing plugin -->
<script src="<?php echo base_url('assets/js/upload/jquery.fileupload-fp.js');?>"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url('assets/js/upload/jquery.fileupload-ui.js');?>"></script>

<script src="<?php echo base_url('assets/js/bootstrap-multiselect.js');?>"></script>

<!-- The main application script -->
<script src="<?php echo base_url('assets/js/upload/main.js');?>"></script>
*/ ?>
<?php /*
</div><!--/span-->
      </div><!--/row-->
      <footer>
       
      </footer>

    </div><!--/.fluid-container-->
</div>
  </body>
</html>*/ ?>
<?php 
$footer = array (
	'js' => array (
		'upload/vendor/jquery.ui.widget.js',
		'upload/tmpl.min.js',
		'upload/load-image.min.js',
		'upload/canvas-to-blob.min.js',
		'upload/bootstrap-image-gallery.min.js',
		'upload/jquery.iframe-transport.js',
		'upload/jquery.fileupload.js',
		'upload/jquery.fileupload-fp.js',
		'upload/jquery.fileupload-ui.js',
		'bootstrap-multiselect.js',
		'upload/main.js'
	)
);
$this->view('templates/footer', $footer);
?>
