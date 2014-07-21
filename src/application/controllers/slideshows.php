<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slideshows extends MY_Controller {
		
	public function index() 
	{
		$this->view();
	}
	
	public function view()
	{
		$query = SlideshowQuery::create()->find();
		$this->load->view('slideshows/view', array('slideshows' => $query));
	} 
	
	
	public function add() 
	{
		$slideshow = new Slideshow();
		$slideshow->setEffect(SlideshowPeer::EFFECT_FADE);
		$this->_create($slideshow);
	}
	
	public function edit($id) 
	{
		$slideshow = SlideshowQuery::create()->findOneById($id);
		if (!is_null($slideshow)) {
			$this->_create($slideshow);
		} else {
			show_404();
		}
	}
	
	protected function _create(Slideshow $slideshow) 
	{
		$errors = array();
		if ($data = $this->input->post('slideshow')) {
				
			$slideshow->fromArray($data);
				
			if ($slideshow->validate()) {
				$slideshow->save();
				$this->addSuccessMessage('Slideshow saved');
				redirect('slideshows');
			} else {
				$errors = $slideshow->getValidationFailures();
			}
				
		}
		$this->load->view('slideshows/form', array(
				'slideshow' => $slideshow,
				'errors'    => $errors
		));
	}
	
	public function upload($id = NULL) 
	{
		$slideshows = SlideshowQuery::create()->find();
		$this->load->view('slideshows/upload', array('slideshows' => $slideshows, 'id' => $id));
	}
	
	public function manage($id) 
	{
		$slideshow = SlideshowQuery::create()->findOneById($id);
		if (!is_null($slideshow)) {
			
			$page = $this->input->get('page', TRUE);
			if (FALSE === $page || !ctype_digit($page)) {
				$page = 1;
			}
			
			$images = ImageQuery::create()->paginate($page, 12);
			$slideshowImages = SlideshowImageQuery::create()
											->joinWith('SlideshowImage.Image')
											->filterBySlideshowId($slideshow->getId())
											->orderByOrder()
											->find();
			
			$this->load->view('slideshows/manage', array(
					'slideshow' => $slideshow, 
					'images' => $images,
					'slideshowimages' => $slideshowImages
					)
				);
		} else {
			show_404();
		}
	}
	
	public function images() 
	{
		$images = ImageQuery::create()->find();
		$this->load->view('slideshows/images', array('images' => $images));
	}
	
	public function doUpload() 
	{
		$this->load->library('UploadHandler');
		$files = $this->uploadhandler->post();
		
		//var_dump($_FILES);
	}
	
	public function addimage($slideshowId, $imageId)
	{
		$slideshow = SlideshowQuery::create()->findOneById($slideshowId);
		if (!is_null($slideshow)) {
			$image = ImageQuery::create()->findOneById($imageId);
			if (!is_null($image)) {
				$success = TRUE;
				try {
					$slideshow->addImage($image);
					$slideshow->save();
				} catch (PropelException $e) {
					//Duplicate
					$success = FALSE;
				}
				
				if ($this->input->is_ajax_request()) {
					return json_encode(array('success' => $success));
				} else {
					$this->addSuccessMessage('Image added');
					redirect('slideshows/manage/' . $slideshow->getId() . $page);
				}
			}
		}
	}
	
	public function removeimage($slideshowId, $imageId, $order)
	{
		$slideshowImage = SlideshowImageQuery::create()
							->filterBySlideshowId($slideshowId)
							->filterByImageId($imageId)
							->filterByOrder($order)
							->delete();
		
		if ($this->input->is_ajax_request()) {
			return json_encode(array('success' => TRUE));
		} else {
			$this->addSuccessMessage('Image removed');
			redirect('slideshows/manage/' . $slideshowId);
		}
	}
	
	public function delete($imageId) 
	{
		$image = ImageQuery::create()->findOneById($imageId);
		if (!is_null($image)) {
			$image->delete();
			if ($this->input->is_ajax_request()) {
				return json_encode(array('success' => TRUE));
			} else {
				$this->addSuccessMessage('Image deleted');
				redirect('slideshows/images');
			}
		} else {
			//Error
			show_404();
		}
	}
	
	public function deleteslideshow($slideshowId) 
	{
		$slideshow = SlideshowQuery::create()->findOneById($slideshowId);
		if (!is_null($slideshow)) {
			if ($this->input->post('confirm') !== FALSE && $this->input->post('confirm') == $slideshow->getId()) {
				$slideshow->delete();
				$this->addSuccessMessage('Slideshow deleted');
				redirect('slideshows');
			} else {
				$this->load->view('slideshows/delete', array('slideshow'=>$slideshow));
			}
		} else {
			show_404();
		}
	}
}