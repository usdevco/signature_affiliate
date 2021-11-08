<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * custom_task_helper
 */


    function send_task_email($email, $subject, $bodymessage, $attachments = [])
    {
        $ci = & get_instance();
        $ci->load->database();
        $ci->load->config('email');
        // Simulate fake template to be parsed
        $template = new StdClass();
        $template->message = $bodymessage;

        $template->fromname = $email; //we use email because client name is not available
        $template->subject  = $subject;

        $template = parse_email_template($template);
        $ci->email->initialize();
        if (get_option('mail_engine') == 'phpmailer') {
            $ci->email->set_debug_output(function ($err) {
                if (!isset($GLOBALS['debug'])) {
                    $GLOBALS['debug'] = '';
                }
                $GLOBALS['debug'] .= $err . '<br />';
                // p($err);
                return $err;
            });
            $ci->email->set_smtp_debug(3);
            // p($ci->email->set_smtp_debug(3));
        }

        $for_name = get_option('invoice_company_name').' | CRM ';
        $ci->email->set_newline(config_item('newline'));
        $ci->email->set_crlf(config_item('crlf'));
        $ci->email->from(get_option('smtp_email'), $for_name);
        $ci->email->to($email); // client email addres

        if (isset($systemBCC) && $systemBCC != '') {
            $ci->email->bcc($systemBCC);
        }

        $ci->email->subject($template->subject);
        $ci->email->message($template->message);
        if(is_array($attachments))
        {
            foreach ($attachments as $key => $filepath) 
            {
                $ci->email->attach($filepath, $disposition = '', $newname = NULL, $mime = '');
            }
        }
        if ($ci->email->send(true)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }




    function add_new_project($id)
    {
        $ci = & get_instance();
        $ci->load->database();

        $estimate_id = $id;
        $estimated_data = $ci->db->where('id', $id)->get('tblestimates')->row();
        $clientid = $estimated_data->clientid; 
        $client_db_data = $ci->db->where('userid', $clientid)->get('tblclients')->row();
        $client_name = isset($client_db_data->company) ? $client_db_data->company : 'Estimate';

        $client_data = array('from_lead' => NULL);
        $ci->db->where('userid', $clientid)->update('tblclients',$client_data);

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
        $ci->db->insert('tblprojects', $project_array);
        $insert_id = $ci->db->insert_id();
        $project_id = $insert_id;

        if($insert_id)
        {

            $custom_task_to_be_assigned = $ci->db->select('tblcustomtask.id as customtask_id,tblcustomtask.title,tblcustomtask.role_id,(select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name,(select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template,(select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name')->where('parent_task_id','0')->get('tblcustomtask')->result_array();

            $task_to_be_assigned  = $custom_task_to_be_assigned;

            foreach ($task_to_be_assigned as  $task_value_array) 
            {
               $new_task_id =  create_custom_task($estimate_id,$task_value_array, $project_id, $clientid);
            }

        }
        return $insert_id;
    }



    function create_custom_task($estimate_id, $task_value_array, $project_id, $clientid)
    {   
            $ci = & get_instance();
            $ci->load->database();
            $task_name = $task_value_array['title'];
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


            $ci->db->insert('tblstafftasks', $task_array);
            $tsk_id = $ci->db->insert_id();

            $tblstaff_user = $ci->db->where('role',$task_value_array['role_id'])->get('tblstaff')->result();
            
            foreach ($tblstaff_user as $user_array) 
            {
                $task_asign_array = array();
                $task_asign_array['staffid'] = $user_array->staffid; 
                $task_asign_array['taskid'] = $tsk_id; 
                $task_asign_array['assigned_from'] = $clientid; 
                $task_asign_array['is_assigned_from_contact'] = 0; 
                $ci->db->insert('tblstafftaskassignees', $task_asign_array);

                $tbltaskstimers_array =  array( 
                                    'start_time'  => time(),
                                    'staff_id'    => $user_array->staffid,
                                    'task_id'     => $tsk_id,
                                    'hourly_rate' => $user_array->hourly_rate,
                                    'note'        => NULL, 
                                );

                // $new_insert_id = $ci->proposals_model->insert_tbltaskstimers($data);

                $ci->db->insert('tbltaskstimers',$tbltaskstimers_array);
                $new_insert_id = $ci->db->insert_id();
                
                $email = $user_array->email;
                $email = "laxmansingh.atn@gmail.com";
                $subject = $task_name." For Estimate No :".format_estimate_number($estimate_id)." (".date('Y-m-d H:i:s').")";
                $bodymessage = "Hello ".$user_array->firstname. " ". $user_array->lastname ."Yo have Assign New Task : ".$task_name." For Estimate No :".format_estimate_number($estimate_id);

                send_task_email($email, $subject, $bodymessage);
                               
            }

            return true;
    }


