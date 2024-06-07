<?php

class Workorders extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, etc.
    }
    
    public function index() {
        $data['active'] = 'workorders';
        // Display a list of work orders
        //workorders are the same as projects
        $data['title'] = "Ordenes de Trabajo";
        $data['projects'] = $this->Projects_model->get_projects();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('workorders/index', $data);
        $this->load->view('_templates/footer');

    }


    

    public function update($id)
    {
        $data['active'] = 'workorders';
        $data['title'] = "Llenar Orden de Trabajo";
        $data['users'] = $this->User_model->get_users();
        
        // Fetch the project
        $data['project'] = $this->Projects_model->get_project($id);

        // Fetch the uploaded files for the project.
        $data['files'] = $this->Projects_model->get_files($id);
        
        // Fetch the shared fields for the project
        $data['sharedfields'] = $this->Sharedfields_model->get_shared_fields();
        
        // Fetch the operations for the project
        $data['operations'] = $this->Projects_model->get_operations_by_project($id);

        // For each operation, fetch the custom fields
        foreach ($data['operations'] as &$operation) {
            $operation['custom_fields'] = $this->Operations_model->get_operation_customfields($operation['po_operation_id']);
        }
                
        $this->form_validation->set_rules('shared_project_id', 'Proyecto', 'required');

        if ($this->form_validation->run() == FALSE) 
        {
            // Validation failed, reload the update project form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('workorders/update', $data);
            $this->load->view('_templates/footer');
        } 
        else 
        {
            // Validation passed, update the project in the database
            $this->Projects_model->update_project($id);
            redirect('projects');
        }
    }




    public function create($project_id) 
    {
        $data['active'] = 'workorders';
        $operation_id = $this->input->post('operation_id');
        

        $check_if_record_exists = $this->Projects_model->check_if_record_exists($project_id, $operation_id);



        // Check if the user is authorized to sign the work order Realizo field.
        $realizo_user = $this->input->post('realizo');
        $password_realizo = $this->input->post('password_realizo');
        $check_realizo = $this->User_model->check_user_signature($realizo_user, $password_realizo);
        
        if (!$check_realizo && !empty($password_realizo)) {
            $this->session->set_flashdata('error', 'Usuario y/o contraseña incorrectos. No se puede firmar la orden de trabajo.');
            redirect(base_url("workorders/update/$project_id"));
        }

        // Check if the user is authorized to sign the work order Reviso field.
        $reviso_user = $this->input->post('reviso');
        $password_reviso = $this->input->post('password_reviso');
        $check_reviso = $this->User_model->check_user_signature($reviso_user, $password_reviso);

        if (!$check_reviso && !empty($password_reviso)) {
            $this->session->set_flashdata('error', 'Usuario y/o contraseña incorrectos. No se puede firmar la orden de trabajo.');
            redirect(base_url("workorders/update/$project_id"));
        }

        // Check if the user is authorized to sign the work order Entrego field.
        $entrego_user = $this->input->post('entrego');
        $password_entrego = $this->input->post('password_entrego');
        $check_entrego = $this->User_model->check_user_signature($entrego_user, $password_entrego);

        if (!$check_entrego && !empty($password_entrego)) {
            $this->session->set_flashdata('error', 'Usuario y/o contraseña incorrectos. No se puede firmar la orden de trabajo.');
            redirect(base_url("workorders/update/$project_id"));
        }

        // Check if the user is authorized to sign the work order Recibio field.
        $recibio_user = $this->input->post('recibio');
        $password_recibio = $this->input->post('password_recibio');
        $check_recibio = $this->User_model->check_user_signature($recibio_user, $password_recibio);

        if (!$check_recibio && !empty($password_recibio)) {
            $this->session->set_flashdata('error', 'Usuario y/o contraseña incorrectos. No se puede firmar la orden de trabajo.');
            redirect(base_url("workorders/update/$project_id"));
        }
        



        // Process shared fields
        $sharedData = array(
            'shared_project_id' => $project_id,
            'shared_operation_id' => $operation_id,
            'hora_inicio' => $this->input->post('hora_inicio'),
            'hora_termino' => $this->input->post('hora_termino'),
            'realizo' => $this->input->post('realizo'),
            'reviso' => $this->input->post('reviso'),
            'fecha' => $this->input->post('fecha'),
            'entrego' => $this->input->post('entrego'),
            'recibio' => $this->input->post('recibio'),
            'hora_salida' => $this->input->post('hora_salida'),
            'hora_recibido' => $this->input->post('hora_recibido'),
            'observaciones' => $this->input->post('observaciones')
        );

        if ($check_if_record_exists) {
            // Update shared fields in the database
            $id = $check_if_record_exists['shared_id'];
            $this->Projects_model->update_sharedfields($id, $sharedData);
        } else {
            // Save shared fields to the database
            $this->Projects_model->insert_sharedfields($sharedData);
        }
        
        
            //delete all custom fields for this operation and project
            $this->Projects_model->delete_customfields($operation_id, $project_id);

            // Process custom fields
            $customFields = $this->input->post('custom_fields');
            foreach ($customFields as $customFieldId => $customFieldValue) {
                $customFieldData = array(
                    'cf_project_id' => $project_id,
                    'cf_operation_id' => $operation_id,
                    'cf_custom_field' => $customFieldId,
                    'cf_data' => $customFieldValue['value']
                );
                
                // Save custom field to the database
                $this->Projects_model->insert_customfield($customFieldData);
            }

        
        // Redirect or display success message.
        $this->session->set_flashdata('success', 'Orden de trabajo actualizada exitosamente.');
        redirect(base_url("workorders/update/$project_id"));
    }


    public function upload_files($project_id)
    {
        $data['active'] = 'workorders';

        $config['upload_path'] = './uploads/project_uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|txt';
        $config['max_size'] = 100000;

        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            redirect(base_url("workorders/update/$project_id"));
        } else {
            $data = array('upload_data' => $this->upload->data());
            $fileData = array(
                'file_name' => $data['upload_data']['file_name'],
                'file_path' => $data['upload_data']['full_path'],
                'file_project_id' => $project_id,
                'file_user' => $this->session->userdata('username')
            );
            $this->Projects_model->insert_file($fileData);
            $this->session->set_flashdata('success', 'Archivo subido exitosamente.');
            redirect(base_url("workorders/update/$project_id"));
        }
    }



    public function update_status($project_id)
    {
        $status = $this->input->post('status');
        $this->Projects_model->update_status($project_id, $status);
        $this->session->set_flashdata('success', 'Estado de la orden de trabajo actualizado.');
        redirect(base_url("workorders/update/$project_id"));

    }




    public function print($id)
    {
        $data['active'] = 'workorders';
        $data['title'] = "Llenar Orden de Trabajo";
        
        // Fetch the project
        $data['project'] = $this->Projects_model->get_project($id);

        // Fetch the uploaded files for the project.
        $data['files'] = $this->Projects_model->get_files($id);
        
        // Fetch the shared fields for the project
        $data['sharedfields'] = $this->Sharedfields_model->get_shared_fields();
        
        // Fetch the operations for the project
        $data['operations'] = $this->Projects_model->get_operations_by_project($id);

        // For each operation, fetch the custom fields
        foreach ($data['operations'] as &$operation) {
            $operation['custom_fields'] = $this->Operations_model->get_operation_customfields($operation['po_operation_id']);
        }
        $this->load->view('workorders/print', $data);
    }




    public function print_template($id)
    {
        $data['active'] = 'workorders';
        $data['title'] = "Llenar Orden de Trabajo";
        
        // Fetch the project
        $data['project'] = $this->Projects_model->get_project($id);

        // Fetch the uploaded files for the project.
        $data['files'] = $this->Projects_model->get_files($id);
        
        // Fetch the shared fields for the project
        $data['sharedfields'] = $this->Sharedfields_model->get_shared_fields();
        
        // Fetch the operations for the project
        $data['operations'] = $this->Projects_model->get_operations_by_project($id);

        // For each operation, fetch the custom fields
        foreach ($data['operations'] as &$operation) {
            $operation['custom_fields'] = $this->Operations_model->get_operation_customfields($operation['po_operation_id']);
        }
        $this->load->view('workorders/print_template', $data);
    }


}