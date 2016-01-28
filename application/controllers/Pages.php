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
			
			//get version from GET
			if(isset($_GET['version'])){
				$data['version'] = $_GET['version'];
			}else{
				$data['version'] = 1;
			}
			
			//gets tabs from the database
			$data['tabs'] = $this->DSitems->get_tabs();
			//gets tabs from the database
			$data['craft_items'] = $this->DSitems->get_craftitems($data['version']);
			
			//get current version name
			$data['v'] = $this->DSitems->get_version($data['version']);
			
			$this->load->view('templates/head', $data);
			$this->load->view('pages/header', $data);
			$this->load->view('pages/nav', $data);
			
			//if there is no GET set to default page
			if(isset($_GET['id'])){
				//gets item name from the GET
				$data['item_name'] = $_GET['id'];
				//gets item's recipe materials
				$data['mats'] = $this->DSitems->get_mats($data['item_name'], $data['version']);
				$this->load->view('pages/recipe.php', $data);
				$data['ablerecipes'] = $this->DSitems->get_ablerecipes($data['item_name'], $data['version']);
				if(!empty($data['ablerecipes'])){
					$this->load->view('pages/recipelist.php', $data);
				}
				
			}else{
				$this->load->view('pages/'.$page);
				
			}
			$this->load->view('pages/searchbar.php');
			$this->load->view('pages/itemlist', $data);
			$this->load->view('templates/footer');
	}
	
	//This function gets called in AJAX
	//Handles the search functions
	public function search(){
		
		$this->load->model('DSitems');
		
		$data['search_results'] = $this->DSitems->search_items($_GET['search_query'], $_GET['version']);
		$data['search_mats'] = $this->DSitems->search_mats($_GET['search_query'], $_GET['version']);
		$data['version'] = $_GET['version'];
		
		$this->load->view('pages/search.php', $data);
	}
}
?>