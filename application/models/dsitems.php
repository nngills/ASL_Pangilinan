<?php
class DSitems extends CI_Model {
	
	//SETS UP "DontStarveItems" DATABASE CONNECTION
	public function __construct(){
		$this->load->database(); 
	}
	
	//get version name
	public function get_version($v){
		$query = $this->db->query('select versionName from version where id ='.$v);	
		return $query->result();
	}
	
	//returns tabs from the database
	public function get_tabs(){
		$query = $this->db->query('select tabName from tabs order by id');
		return $query->result();	
	}
	
	//returns craftable items from the database
	public function get_craftitems($version){
		$query = $this->db->query('
			select items.itemsName, tabs.tabName from craftable_items
			join items on items.id = craftable_items.itemId
			join tabs on tabs.id = craftable_items.tab
			where version <= '.$version.';
			order by tabs.id;
		');
		return $query->result();	
	}
	
	//returns the materials for the enterred parameter
	//parameter is the item name from the GET URL
	public function get_mats($item_name, $version){
		$query = $this->db->query('
			select quantity, items.itemsName as material from materials
			join items
			on material = items.id
			where craftableid = (select id from items where itemsName = "'.$item_name.'")
			and (materials.version = '.$version.' or materials.version = 0)'
		);	
		return $query->result();	
	}
	
	//get items that use this material
	public function get_ablerecipes($item_name, $version){
		$query = $this->db->query('
			select itemsName 
			from materials 
			join items
			on items.id = materials.craftableId
			where material = (select id from items where itemsName = "'.$item_name.'")
			and items.version <= '.$version.'
			group by craftableId;
		');
		
		$results = array();
		
		foreach($query->result() as $row){
			
			$itemarr = array("itemsName"=>$row->itemsName);
			
			$matsquery = $this->db->query('
				select quantity, items.itemsName as material from materials
				join items
				on material = items.id
				where craftableid = (select id from items where itemsName = "'.$row->itemsName.'")
				and (materials.version = '.$version.' or materials.version = 0)'
			);
			$mats = $matsquery->result();
			foreach($mats as $matsrow){
				$matsarr = array("material"=>$matsrow->material, "quantity"=>$matsrow->quantity);
				array_push($itemarr ,$matsarr);
			};
			array_push($results, $itemarr);
		}
		
		return $results;
	}
	
	//get itemNames that contain the string
	//used for the search function
	public function search_items($search_query, $version){
		$query = $this->db->query('
			select itemsName from craftable_items
			join items
			on items.id = craftable_items.itemId
			where itemsName like "%'.$search_query.'%"
			and items.version <= '.$version
		);	
		return $query->result();	
	}
}
?>