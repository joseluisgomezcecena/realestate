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

            $data['properties'] = $this->Property_model->get_property();
           
            

            $data['main_image'] = array();
            foreach ($data['properties'] as $key => $property) {
                $data['main_image'][$key] = $this->Property_model->get_main_image($property['property_id']);
            }

        }

        if ($page == 'property') {
            //$data['property'] = $this->Property_model->get_property($this->uri->segment(2));
            //$data['images'] = $this->Property_model->get_images($this->uri->segment(2));

            //get property by slug
            $data['property'] = $this->Property_model->get_property_by_slug($this->uri->segment(2));
            $data['images'] = $this->Property_model->get_images($data['property']['property_id']);
        }



        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('_frontend/footer', $data);
    }




    public function main_image($property)
    {
        $data = $this->Property_model->get_main_image($property);
        return $data['url'];
    }
}