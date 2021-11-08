<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Estimate extends Clients_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('custom_task_helper');
    }

    public function index($id, $hash)
    {
        check_estimate_restrictions($id, $hash);
        $estimate = $this->estimates_model->get($id);

        if (!is_client_logged_in()) {
            load_client_language($estimate->clientid);
        }

        $identity_confirmation_enabled = get_option('estimate_accept_identity_confirmation');

        if ($this->input->post('estimate_action')) {
            $action = $this->input->post('estimate_action');

            // Only decline and accept allowed
            if ($action == 4 || $action == 3) {

                $success = $this->estimates_model->mark_action_status($action, $id, true);

                $redURL   = $this->uri->uri_string();
                $accepted = false;

                if(is_array($success) && $success)
                {
                    $email = $this->input->post('acceptance_email');
                    $subject = 'Welcome';
                    $bodymessage = $this->load->view('admin/tasks/email/templet/welcome','',true);
                    send_task_email($email, $subject, $bodymessage);
                    add_new_project($id);
                }


                if (is_array($success) && $success['invoiced'] == true) {
                    $accepted = true;
                    $invoice  = $this->invoices_model->get($success['invoiceid']);
                    set_alert('success', _l('clients_estimate_invoiced_successfully'));
                    $redURL = site_url('invoice/' . $invoice->id . '/' . $invoice->hash);
                } 
                elseif (is_array($success) && $success['invoiced'] == false || $success === true) 
                {
                    if ($action == 4) {
                        $accepted = true;
                        set_alert('success', _l('clients_estimate_accepted_not_invoiced'));
                    } else {
                        set_alert('success', _l('clients_estimate_declined'));
                    }
                } else {
                    set_alert('warning', _l('clients_estimate_failed_action'));
                }
                if ($action == 4 && $accepted = true) {
                    process_digital_signature_image($this->input->post('signature', false), ESTIMATE_ATTACHMENTS_FOLDER . $id);

                    $this->db->where('id', $id);
                    $this->db->update('tblestimates', get_acceptance_info_array());
                }
            }
            redirect($redURL);
        }
        // Handle Estimate PDF generator
        if ($this->input->post('estimatepdf')) {
            try {
                $pdf = estimate_pdf($estimate);
            } catch (Exception $e) {
                echo $e->getMessage();
                die;
            }

            $estimate_number = format_estimate_number($estimate->id);
            $companyname     = get_option('invoice_company_name');
            if ($companyname != '') {
                $estimate_number .= '-' . mb_strtoupper(slug_it($companyname), 'UTF-8');
            }
            $pdf->Output(mb_strtoupper(slug_it($estimate_number), 'UTF-8') . '.pdf', 'D');
            die();
        }
        $this->load->library('numberword', [
            'clientid' => $estimate->clientid,
        ]);

        $data['title']                         = format_estimate_number($estimate->id);
        $this->use_navigation                  = false;
        $this->use_submenu                     = false;
        $data['hash']                          = $hash;
        $data['can_be_accepted']               = false;
        $data['estimate']                      = do_action('estimate_html_pdf_data', $estimate);
        $data['bodyclass']                     = 'viewestimate';
        $data['identity_confirmation_enabled'] = $identity_confirmation_enabled;
        if ($identity_confirmation_enabled == '1') {
            $data['bodyclass'] .= ' identity-confirmation';
        }
        $this->data = $data;
        $this->view = 'estimatehtml';
        add_views_tracking('estimate', $id);
        do_action('estimate_html_viewed', $id);
        no_index_customers_area();
        $this->layout();
    }


    private function a_add_new_project($id)
    {
        $estimate_id = $id;
        $estimated_data = $this->db->where('id', $id)->get('tblestimates')->row();
        $clientid = $estimated_data->clientid; 
        $client_db_data = $this->db->where('userid', $clientid)->get('tblclients')->row();
        $client_name = isset($client_db_data->company) ? $client_db_data->company : 'Estimate';

        $client_data = array('from_lead' => NULL);
        $this->db->where('userid', $clientid)->update('tblclients',$client_data);

        $project_array = array();
        $project_array['name'] = $client_name.' '.format_estimate_number($estimated_data->id);
        $project_array['description'] = "";
        $project_array['status'] = 1;
        $project_array['clientid'] = $clientid;
        $project_array['billing_type'] = '';
        $project_array['start_date'] = date('Y-m-d H:i:s');
        $project_array['deadline'] = "";
        $project_array['project_created'] = date('Y-m-d H:i:s');
        $project_array['date_finished'] = '';
        $project_array['progress'] = 0;
        $project_array['progress_from_tasks'] = 1;
        $project_array['project_cost'] = $estimated_data->total;
        $project_array['project_rate_per_hour'] = 0;
        $project_array['estimated_hours'] = 0;
        $project_array['addedfrom'] = get_staff_user_id();
        $this->db->insert('tblprojects', $project_array);
        $insert_id = $this->db->insert_id();
        $project_id = $insert_id;

        if($insert_id)
        {

            $custom_task_to_be_assigned = $this->db->select('tblcustomtask.id as customtask_id,tblcustomtask.title,tblcustomtask.role_id,(select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name,(select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template,(select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name')->where('parent_task_id','0')->get('tblcustomtask')->result_array();

            $task_to_be_assigned  = $custom_task_to_be_assigned;

            foreach ($task_to_be_assigned as  $task_value_array) 
            {
               $new_task_id =  $this->create_custom_task($estimate_id,$task_value_array, $project_id, $clientid);
            }

        }
        return $insert_id;
    }



    private function a_create_custom_task($estimate_id, $task_value_array, $project_id, $clientid)
    {
            $task_array = array();
            $task_array['name'] = $task_value_array['title'];
            $task_array['description'] = $task_value_array['title'];
            $task_array['priority'] = 1;
            $task_array['dateadded'] = date('Y-m-d H:i:s');
            $task_array['startdate'] = date('Y-m-d H:i:s');;
            // $task_array['duedate'] = ;
            // $task_array['datefinished'] = ;
            $task_array['addedfrom'] = $clientid;
            $task_array['is_added_from_contact'] = 0;
            $task_array['status'] = 1;
            // $task_array['recurring_type'] = ;
            $task_array['repeat_every'] = 0;
            $task_array['recurring'] = 0;
            // $task_array['is_recurring_from'] = ;
            $task_array['cycles'] = 0;
            $task_array['total_cycles'] = 0;
            $task_array['custom_recurring'] = 0;
            // $task_array['last_recurring_date'] = ;
            $task_array['rel_id'] = $project_id;
            $task_array['rel_type'] = 'project';

            // $task_array['rel_id'] = $estimate_id;
            // $task_array['rel_type'] = 'estimate';

            $task_array['is_public'] = 0;
            $task_array['billable'] = 1;
            $task_array['billed'] = 0;
            $task_array['invoice_id'] = 0;
            $task_array['hourly_rate'] = 0.00;
            $task_array['milestone'] = 0;
            $task_array['kanban_order'] = 0;
            $task_array['milestone_order'] = 0;
            $task_array['visible_to_client'] = 1;
            $task_array['deadline_notified'] = 0;
            $task_array['mail_template'] = $task_value_array['mail_template'];
            $task_array['progress_step'] = $task_value_array['step_name'];
            $task_array['custom_task_id'] = $task_value_array['customtask_id'];


            $this->db->insert('tblstafftasks', $task_array);
            $tsk_id = $this->db->insert_id();

            $tblstaff_user = $this->db->where('role',$task_value_array['role_id'])->get('tblstaff')->result();
            
            foreach ($tblstaff_user as $user_array) 
            {
                $task_asign_array = array();
                $task_asign_array['staffid'] = $user_array->staffid; 
                $task_asign_array['taskid'] = $tsk_id; 
                $task_asign_array['assigned_from'] = $clientid; 
                $task_asign_array['is_assigned_from_contact'] = 0; 
                $this->db->insert('tblstafftaskassignees', $task_asign_array);

                $tbltaskstimers_array =  array( 
                                    'start_time'  => time(),
                                    'staff_id'    => $user_array->staffid,
                                    'task_id'     => $tsk_id,
                                    'hourly_rate' => $user_array->hourly_rate,
                                    'note'        => NULL, 
                                );

                // $new_insert_id = $this->proposals_model->insert_tbltaskstimers($data);

                $this->db->insert('tbltaskstimers',$tbltaskstimers_array);
                $new_insert_id = $this->db->insert_id();
                               
            }

            return true;
    }

    private function a_send_email_for_welcome($email, $subject, $bodymessage)
    {
        $this->load->config('email');
        // Simulate fake template to be parsed
        $template = new StdClass();
        $template->message = $bodymessage;

        $template->fromname = $email; //we use email because client name is not available
        $template->subject  = $subject;

        $template = parse_email_template($template);
        $this->email->initialize();
        if (get_option('mail_engine') == 'phpmailer') {
            $this->email->set_debug_output(function ($err) {
                if (!isset($GLOBALS['debug'])) {
                    $GLOBALS['debug'] = '';
                }
                $GLOBALS['debug'] .= $err . '<br />';
                // p($err);
                return $err;
            });
            $this->email->set_smtp_debug(3);
            // p($this->email->set_smtp_debug(3));
        }

        $for_name = get_option('invoice_company_name').' | CRM ';
        $this->email->set_newline(config_item('newline'));
        $this->email->set_crlf(config_item('crlf'));
        $this->email->from(get_option('smtp_email'), $for_name);
        $this->email->to($email); // client email addres

        if (isset($systemBCC) && $systemBCC != '') {
            $this->email->bcc($systemBCC);
        }

        $this->email->subject($template->subject);
        $this->email->message($template->message);
        if ($this->email->send(true)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

}
