<?php
class Pages extends CI_Controller {

	public function view($page = 'default'){
			if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
			{
					// Whoops, we don't have a page for that!
					show_404();
			}
	
			$data['title'] = ucfirst($page); // Capitalize the first letter
			
			$this->load->view('templates/header');
			$this->load->view('pages/nav');
			
			if(isset($_GET['id'])){
				$data['item_name'] = $this->input->get('id');
				$this->load->view('pages/recipe.php', $data);
			}else{
				$this->load->view('pages/'.$page);
			}
			
			$this->load->view('pages/itemlist');
			$this->load->view('templates/footer');
			
	}
}
?>