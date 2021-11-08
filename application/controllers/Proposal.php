<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Proposal extends Clients_controller
{
    public function __construct()
    {
        parent::__construct();
    }



            //             array('title' => 'Expedite Permit Package To The City', 'mail_template' => 'permit-package'), 


    public function add_new_project($id)
    {
        $estimated_data = $this->db->where('id', $id)->get('tblproposals')->row();

        $client_data = $this->db->where('company', $estimated_data->email)->get('tblclients')->row();
        // echo '<pre>';print_r($client_data);die;

        $client_array['company'] = $estimated_data->email;
        $client_array['phonenumber'] = $estimated_data->phone;
        // email
        $client_array['country'] = $estimated_data->country;
        $client_array['city'] = $estimated_data->city;
        $client_array['zip'] = $estimated_data->zip;
        $client_array['state'] = $estimated_data->state;
        $client_array['address'] = $estimated_data->address;
        // $client_array['website'] = $estimated_data->rel_id;

        $client_array['billing_street'] = $estimated_data->address;
        $client_array['billing_city'] = $estimated_data->city;
        $client_array['billing_state'] = $estimated_data->state;
        $client_array['billing_zip'] = $estimated_data->zip;
        $client_array['billing_country'] = $estimated_data->country;

        $client_array['shipping_street'] = $estimated_data->address;
        $client_array['shipping_city'] = $estimated_data->city;
        $client_array['shipping_state'] = $estimated_data->state;
        $client_array['shipping_zip'] = $estimated_data->zip;
        $client_array['shipping_country'] = $estimated_data->country;

        $client_array['datecreated'] = date("Y-m-d H:i:s");
        $client_array['active'] = 1;
        $client_array['leadid'] = $estimated_data->rel_id;

        $client_array['default_currency'] = 0;
        $client_array['show_primary_contact'] = 0;
        $client_array['addedfrom'] = $id;

        // echo '<pre>';print_r($client_array);die;

        $this->db->insert('tblclients', $client_array);
        $clientid = $this->db->insert_id();


        $project_array = array();

        $project_array['name'] = "Project for Proposal #".$estimated_data->id;
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
        $project_array['addedfrom'] = 13;
        $this->db->insert('tblprojects', $project_array);
        $insert_id = $this->db->insert_id();
        $project_id = $insert_id;

        if($insert_id)
        {

            $custom_task_to_be_assigned = $this->db->select('tblcustomtask.id as customtask_id,tblcustomtask.title,tblcustomtask.role_id,(select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name,(select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template,(select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name')->where('parent_task_id',0)->get('tblcustomtask')->result_array();
            
            // p($custom_task_to_be_assigned);

            // $task_to_be_assigned = [
            //             array('title' => 'Final Measurements & Diagram (Uploaded)', 'mail_template' => ''), 
            //             array('title' => 'Signed Permit Application (Uploaded)', 'mail_template' => ''), 
            //             array('title' => 'Schedule Install', 'mail_template' => 'schedule-install'), 
            //             array('title' => 'Inspect Project', 'mail_template' => ''), 
            //             array('title' => 'Signed Client Walk Through (Uploaded)', 'mail_template' => ''), 
            //             array('title' => 'Final Inspection (Uploaded)', 'mail_template' => 'final-inspection'), 
            //             array('title' => 'HOA Approval (If Needed)', 'mail_template' => 'hoa-approved'), 
            //             array('title' => 'Entering & Placing Order (Uploaded)', 'mail_template' => 'place-order'), 
            //             array('title' => 'Submit For Engineering If Needed', 'mail_template' => ''), 
            //             array('title' => 'Confirming Final Measurement Frame Color Glass Color & Operation Of All Openings', 'mail_template' => ''), 
            //             array('title' => 'Prep Permit Application & Send To Project Manager', 'mail_template' => ''), 
            //             array('title' => 'Print Permit Package Once Approved', 'mail_template' => 'package-approved' )
                        
            //             ];

            $task_to_be_assigned  = $custom_task_to_be_assigned;

            foreach ($task_to_be_assigned as  $task_value_array) 
            {
               $new_task_id =  $this->create_custom_task($task_value_array, $project_id, $clientid);
            }

        }
        return $insert_id;
    }



    public function create_custom_task($task_value_array, $project_id, $clientid)
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



    public function index($id, $hash)
    {
        check_proposal_restrictions($id, $hash);
        $proposal = $this->proposals_model->get($id);
        if ($proposal->rel_type == 'customer' && !is_client_logged_in()) {
            load_client_language($proposal->rel_id);
        }
        $identity_confirmation_enabled = get_option('proposal_accept_identity_confirmation');
        if ($this->input->post()) {
            $action = $this->input->post('action');
            switch ($action) {
                case 'proposal_pdf':

                    $proposal_number = format_proposal_number($id);
                    $companyname     = get_option('invoice_company_name');
                    if ($companyname != '') {
                        $proposal_number .= '-' . mb_strtoupper(slug_it($companyname), 'UTF-8');
                    }

                    try {
                        $pdf = proposal_pdf($proposal);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        die;
                    }

                    $pdf->Output($proposal_number . '.pdf', 'D');

                    break;
                case 'proposal_comment':
                    // comment is blank
                    if (!$this->input->post('content')) {
                        redirect($this->uri->uri_string());
                    }
                    $data               = $this->input->post();
                    $data['proposalid'] = $id;
                    $this->proposals_model->add_comment($data, true);
                    redirect($this->uri->uri_string() . '?tab=discussion');

                    break;
                case 'accept_proposal':
                    $success = $this->proposals_model->mark_action_status(3, $id, true);
                    if ($success) {

                        $this->add_new_project($id);
                        process_digital_signature_image($this->input->post('signature', false), PROPOSAL_ATTACHMENTS_FOLDER . $id);
                        
                        $proposal_data = $this->db->where('id', $id)->get('tblproposals')->row();


                        $bodymessage = $this->load->view('admin/tasks/email/templet/welcome','',true);
                        $subject= 'welcome';
                        $email = $proposal_data->email;
                        
                        $this->send_email_for_task($email, $subject, $bodymessage);
                        
                        $this->db->where('id', $id);
                        $this->db->update('tblproposals', get_acceptance_info_array());
                        redirect($this->uri->uri_string(), 'refresh');
                    }

                    break;
                case 'decline_proposal':
                    $success = $this->proposals_model->mark_action_status(2, $id, true);
                    if ($success) {
                        redirect($this->uri->uri_string(), 'refresh');
                    }

                    break;
            }
        }

        $number_word_lang_rel_id = 'unknown';
        if ($proposal->rel_type == 'customer') {
            $number_word_lang_rel_id = $proposal->rel_id;
        }
        $this->load->library('numberword', [
            'clientid' => $number_word_lang_rel_id,
        ]);

        $this->use_navigation = false;
        $this->use_submenu    = false;

        $data['title']     = $proposal->subject;
        $data['proposal']  = do_action('proposal_html_pdf_data', $proposal);
        $data['bodyclass'] = 'proposal proposal-view';

        $data['identity_confirmation_enabled'] = $identity_confirmation_enabled;
        if ($identity_confirmation_enabled == '1') {
            $data['bodyclass'] .= ' identity-confirmation';
        }

        $data['comments'] = $this->proposals_model->get_comments($id);
        add_views_tracking('proposal', $id);
        do_action('proposal_html_viewed', $id);
        $data['exclude_reset_css'] = true;
        $data                      = do_action('proposal_customers_area_view_data', $data);
        no_index_customers_area();
        $this->data = $data;
        $this->view = 'viewproposal';
        $this->layout();
    }




    public function send_email_for_task($email, $subject, $bodymessage)
    {
        // $email = 'sbtssc@gmail.com';
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

        $this->email->set_newline(config_item('newline'));
        $this->email->set_crlf(config_item('crlf'));
        $this->email->from(get_option('smtp_email'), $template->fromname);
        // p($email);

        $this->email->to($email); // client email addres
        // $systemBCC = get_option('bcc_emails');

        if ($systemBCC != '') {
            $this->email->bcc($systemBCC);
        }

        $this->email->subject($template->subject);
        $this->email->message($template->message);
        if ($this->email->send(true)) 
        {
            // p('succc');
            return true;
        } 
        else 
        {
            // p('ffffff');
            return false;
        }
    }

}
