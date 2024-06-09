<?php

class Pages extends CI_Controller
{
    
    public function view($page = 'home')
    {
        $data['controller'] = $this;
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['categories'] = $this->Categories_model->get_categories();
        $data['cities'] = $this->Property_model->get_all_municipios();


        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if ($page == 'home') {

            $data['slides'] = $this->Property_model->get_slides();
            $data['properties'] = $this->Property_model->get_property();
           
            

            $data['main_image'] = array();
            foreach ($data['properties'] as $key => $property) {
                $data['main_image'][$key] = $this->Property_model->get_main_image($property['property_id']);
            }

        }

        if ($page == 'property_list'){
            $data['properties'] = $this->Property_model->get_property();
            $data['main_image'] = array();
            foreach ($data['properties'] as $key => $property) {
                $data['main_image'][$key] = $this->Property_model->get_main_image($property['property_id']);
            }
        }

        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('_frontend/footer', $data);
    }




    public function property_details($slug) {
        $data['controller'] = $this;
        
        //get property by slug
        $data['property'] = $this->Property_model->get_property_by_slug($slug);
        $data['images'] = $this->Property_model->get_images($data['property']['property_id']);

        //get custom fields
        $data['custom_fields'] = $this->Property_model->get_custom_fields_for_page($data['property']['property_id']);

        $user_id = $data['property']['user_id'];
        $data['user'] = $this->User_model->get_user($user_id);
        

        $data['title'] = 'Detalles | ' . $data['property']['title'];
        $data['categories'] = $this->Categories_model->get_categories();
        $data['cities'] = $this->Property_model->get_all_municipios();
    
        
    
        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/property_details', $data);
        $this->load->view('_frontend/footer', $data);
    }



    public function search()
    {
        if (isset($_POST['search'])){
            $data = array (
                'search' => $this->input->post('search'),
                'category' => $this->input->post('category'),
                'city' => $this->input->post('city'),
                'min_price' => $this->input->post('min_price'),
                'max_price' => $this->input->post('max_price'),
                'bedrooms' => $this->input->post('bedrooms'),
                'bathrooms' => $this->input->post('bathrooms'),
                'garage' => $this->input->post('garage'),
                'surface' => $this->input->post('surface'),
                'purpose' => $this->input->post('purpose')
            );

            $data['properties'] = $this->Property_model->search($data);

            //redirect to property_list view
            $this->load->view('_frontend/header', $data);
            $this->load->view('_frontend/navbar', $data);
            $this->load->view('pages/property_list', $data);
            $this->load->view('_frontend/footer', $data);
        }
    }
    
 



    public function main_image($property)
    {
        $data = $this->Property_model->get_main_image($property);
        return $data['url'];
    }
}