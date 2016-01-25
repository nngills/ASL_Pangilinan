<?php
class Pages extends CI_Controller {

	public function view($page = 'default'){
			if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
			{
				// Whoops, we don't have a page for that!
				show_404();
			}
			
			//loads the model to get data from the database
		    $this->load->model('DSitems');
			
			//gets tabs from the database
			$data['tabs'] = $this->DSitems->get_tabs();
			//gets tabs from the database
			$data['craft_items'] = $this->DSitems->get_craftitems();
			
			$this->load->view('templates/header');
			$this->load->view('pages/nav', $data);
			
			//if there is no GET set to default page
			if(isset($_GET['id'])){
				//gets item name from the GET
				$data['item_name'] = $this->DSitems->get_GETid();
				//gets item's recipe materials
				$data['mats'] = $this->DSitems->get_mats($data['item_name']);
				$this->load->view('pages/recipe.php', $data);
				
			}else{
				$this->load->view('pages/'.$page);
				
			}
			$this->load->view('pages/searchbar.php');
			$this->load->view('pages/itemlist', $data);
			$this->load->view('templates/footer');
	}
}
?>