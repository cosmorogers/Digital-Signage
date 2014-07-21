<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes extends MY_Controller {
		
	public function index() 
	{
		$this->view();
	}

	public function view($page = 1)
	{
		$query = QuoteQuery::create();
		
		$filters = $this->input->get('filter');
		
		if (!is_array($filters)) {
			$filters = array(
					'display' => '10'
			);
		}
		
		if (isset($filters['display']) && ctype_digit($filters['display'])) {
			$perPage = $filters['display'];
		} else {
			$perPage = 10;
		}
		
		if (isset($filters['quote']) && '' != $filters['quote']) {
			$query->filterByQuote('%' . $filters['quote'] . '%');
		}
		
		
		$quotes = $query->paginate($page,$perPage);
		
		$this->load->view('quotes/view', array(
				'quotes' => $quotes,
				'filters' => $filters
				));
	}
	
	public function add()
	{
		$quote = new Quote;
		$this->_create($quote);
	}
	
	public function edit($id)
	{
		$quote = QuoteQuery::create()->findOneById($id);
		if (!is_null($quote)) {
			$this->_create($quote);
		} else {
			show_404();
		}
	}
	
	protected function _create(Quote $quote)
	{
		$errors = array();
		if ($data = $this->input->post('quote')) {
		
			$quote->fromArray($data);
		
			if ($quote->validate()) {
				$quote->save();
				$this->addSuccessMessage('Quote saved');
				redirect('quotes');
			} else {
				$errors = $quote->getValidationFailures();
			}
		
		}
		$this->load->view('quotes/form', array(
				'quote'  => $quote,
				'errors' => $errors
		));
	}
	
	public function delete($id) {
		$quote = QuoteQuery::create()->findOneById($id);
		if (!is_null($quote)) {
			if ($this->input->post('confirm') !== FALSE && $this->input->post('confirm') == $id) {
				$quote->delete();
				$this->addSuccessMessage('Quote deleted');
				redirect('quotes');
			} else {
				$this->load->view('quotes/delete', array('quote'=>$quote));
			}
		} else {
			show_404();
		}
	}
	
}