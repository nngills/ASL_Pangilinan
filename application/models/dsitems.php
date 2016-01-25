<?php
class DSitems extends CI_Model {
	
	//SETS UP "DontStarveItems" DATABASE CONNECTION
	public function __construct(){
		$this->load->database(); 
	}
	
	//returns tabs from the database
	public function get_tabs(){
		$query = $this->db->query('select tabName from tabs order by id');
		return $query->result();	
	}
	
	//returns craftable items from the database
	public function get_craftitems(){
		$query = $this->db->query('
			select items.itemsName, tabs.tabName from craftable_items
			join items on items.id = craftable_items.itemId
			join tabs on tabs.id = craftable_items.tab
			order by tabs.id;
		');
		return $query->result();	
	}
	
	//returns itemname from the GET URL
	public function get_GETid(){
		$item_name = $_GET['id'];
		return $item_name;	
	}
	
	//returns the materials for the enterred parameter
	//parameter is the item name from the GET URL
	public function get_mats($item_name){
		$query = $this->db->query('
			select quantity, items.itemsName as material from materials
			join items
			on material = items.id
			where craftableid = (select id from items where itemsName = "'.$item_name.'")'
		);	
		return $query->result();	
	}
}
?>