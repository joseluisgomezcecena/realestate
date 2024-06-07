<?php 

class Property_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }



    public function get_property($property_id =NULL)
    {
        if ($property_id != NULL) {
            $this->db->where('property_id', $property_id);
        }

        $this->db->select('property.*, category.category_name, category.category_id, estados.nombre as estado, municipios.nombre as ciudad');
        $this->db->from('property');
        $this->db->join('category', 'category.category_id = property.category');
        //$this->db->join('property_custom_field', 'c_property_id = property.property_id', 'left');
       // $this->db->join('custom_fields', 'custom_fields.custom_id = property_custom_field.c_custom_field', 'left');
        $this->db->join('estados', 'estados.id = property.state', 'left');
        $this->db->join('municipios', 'municipios.id = property.city', 'left');
       
        $query = $this->db->get();
        if ($property_id != NULL) {
            return $query->row_array();
        }else{
            return $query->result_array();
        }
    }


    public function get_property_by_slug($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->select('property.*, category.category_name, category.category_id, estados.nombre as estado, municipios.nombre as ciudad');
        $this->db->from('property');
        $this->db->join('category', 'category.category_id = property.category');
        $this->db->join('estados', 'estados.id = property.state', 'left');
        $this->db->join('municipios', 'municipios.id = property.city', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }




    public function get_main_image($property_id)
    {
        $this->db->where('property_id', $property_id);
        $this->db->where('image_order', 0); // Get the first image (main image)
        $this->db->limit(1);
        $query = $this->db->get('images');
        return $query->row_array();
    }




    public function create_property($data){
        $this->db->insert('property', $data);
        return $this->db->insert_id();
    }


    public function create_image($data){

        $property_id = $data['property_id'];
        $this->db->where('property_id', $property_id);
        $query = $this->db->get('images');
        $image_order = $query->num_rows() + 1;
        $data['image_order'] = $image_order;
        

        $this->db->insert('images', $data);
        return $this->db->insert_id();
    }



    public function update_order($order) 
    {
        foreach ($order as $i => $po_id) {
            $data = array('image_order' => $i);
            $this->db->where('image_id', $po_id);
            $this->db->update('images', $data);
        }
    }


    public function update_property($property_id,$data){
        $this->db->where('property_id', $property_id);
        return $this->db->update('property', $data);
    }


    public function get_images($property_id){
        $this->db->order_by('image_order', 'ASC');
        $this->db->where('property_id', $property_id);
        $query = $this->db->get('images');
        return $query->result_array();
    }
    

    public function get_municipios($state_id){
        $this->db->where('estado', $state_id);
        $query = $this->db->get('municipios');
        return $query->result_array();
    }


    public function get_all_municipios(){
        $query = $this->db->get('municipios');
        return $query->result_array();
    }



    public function get_states(){
        $query = $this->db->get('estados');
        return $query->result_array();
    }


    public function get_custom_fields($property_id){
        $this->db->where('c_property_id', $property_id);
        $this->db->select('custom_fields.custom_name, property_custom_field.c_custom_field, property_custom_field.c_property_id, property_custom_field.c_custom_field');
        $this->db->from('property_custom_field');
        $this->db->join('custom_fields', 'custom_fields.custom_id = property_custom_field.c_custom_field');
        $query = $this->db->get();
        return $query->result_array();
    }



}