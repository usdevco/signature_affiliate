<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tasks extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('projects_model');
        $this->load->library('form_validation');
        $this->load->model('Tasks_model');
    }

    /* Open also all taks if user access this /tasks url */
    public function index($id = '')
    {
        $this->list_tasks($id);
    }

    /* List all tasks */
    public function list_tasks($id = '')
    {
        close_setup_menu();
        // If passed from url
        $data['custom_view'] = $this->input->get('custom_view') ? $this->input->get('custom_view') : '';
        $data['taskid']      = $id;

        if ($this->input->get('kanban')) {
            $this->switch_kanban(0, true);
        }

        $data['switch_kanban'] = false;
        $data['bodyclass']     = 'tasks-page';

        if ($this->session->userdata('tasks_kanban_view') == 'true') {
            $data['switch_kanban'] = true;
            $data['bodyclass']     = 'tasks-page kan-ban-body';
        }

        $data['title'] = _l('tasks');
        $this->load->view('admin/tasks/manage', $data);
    }

    public function table()
    {
        $this->app->get_table_data('tasks');
    }

    public function kanban()
    {
        echo $this->load->view('admin/tasks/kan_ban', [], true);
    }

    public function ajax_search_assign_task_to_timer()
    {
        if ($this->input->is_ajax_request()) {
            $q = $this->input->post('q');
            $q = trim($q);
            $this->db->select('name, id,' . tasks_rel_name_select_query() . ' as subtext');
            $this->db->from('tblstafftasks');
            $this->db->where('tblstafftasks.id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid = ' . get_staff_user_id() . ')');
            //   $this->db->where('id NOT IN (SELECT task_id FROM tbltaskstimers WHERE staff_id = ' . get_staff_user_id() . ' AND end_time IS NULL)');
            $this->db->where('status != ', 5);
            $this->db->where('billed', 0);
            $this->db->where('(name LIKE "%' . $q . '%" OR ' . tasks_rel_name_select_query() . ' LIKE "%' . $q . '%")');
            echo json_encode($this->db->get()->result_array());
        }
    }

    public function tasks_kanban_load_more()
    {
        $status = $this->input->get('status');
        $page   = $this->input->get('page');

        $where = [];
        if ($this->input->get('project_id')) {
            $where['rel_id']   = $this->input->get('project_id');
            $where['rel_type'] = 'project';
        }

        $tasks = $this->tasks_model->do_kanban_query($status, $this->input->get('search'), $page, false, $where);

        foreach ($tasks as $task) {
            $this->load->view('admin/tasks/_kan_ban_card', [
                'task'   => $task,
                'status' => $status,
            ]);
        }
    }

    public function update_order()
    {
        $this->tasks_model->update_order($this->input->post());
    }

    public function switch_kanban($set = 0, $manual = false)
    {
        if ($set == 1) {
            $set = 'false';
        } else {
            $set = 'true';
        }

        $this->session->set_userdata([
            'tasks_kanban_view' => $set,
        ]);
        if ($manual == false) {
            // clicked on VIEW KANBAN from projects area and will redirect again to the same view
            if (strpos($_SERVER['HTTP_REFERER'], 'project_id') !== false) {
                redirect(admin_url('tasks'));
            } else {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    // Used in invoice add/edit
    public function get_billable_tasks_by_project($project_id)
    {
        if ($this->input->is_ajax_request() && (has_permission('invoices', '', 'edit') || has_permission('invoices', '', 'create'))) {
            $customer_id = get_client_id_by_project_id($project_id);
            echo json_encode($this->tasks_model->get_billable_tasks($customer_id, $project_id));
        }
    }

    // Used in invoice add/edit
    public function get_billable_tasks_by_customer_id($customer_id)
    {
        if ($this->input->is_ajax_request() && (has_permission('invoices', '', 'edit') || has_permission('invoices', '', 'create'))) {
            echo json_encode($this->tasks_model->get_billable_tasks($customer_id));
        }
    }

    public function update_task_description($id)
    {
        if (has_permission('tasks', '', 'edit')) {
            $this->db->where('id', $id);
            $this->db->update('tblstafftasks', [
                'description' => $this->input->post('description', false),
            ]);
        }
    }

    public function detailed_overview()
    {
        $overview = [];

        $has_permission_create = has_permission('tasks', '', 'create');
        $has_permission_view   = has_permission('tasks', '', 'view');

        if (!$has_permission_view) {
            $staff_id = get_staff_user_id();
        } elseif ($this->input->post('member')) {
            $staff_id = $this->input->post('member');
        } else {
            $staff_id = '';
        }

        $month = ($this->input->post('month') ? $this->input->post('month') : date('m'));
        if ($this->input->post() && $this->input->post('month') == '') {
            $month = '';
        }

        $status = $this->input->post('status');

        $fetch_month_from = 'startdate';

        $year       = ($this->input->post('year') ? $this->input->post('year') : date('Y'));
        $project_id = $this->input->get('project_id');

        for ($m = 1; $m <= 12; $m++) {
            if ($month != '' && $month != $m) {
                continue;
            }

            // Task rel_name
            $sqlTasksSelect = '*,' . tasks_rel_name_select_query() . ' as rel_name';

            // Task logged time
            $selectLoggedTime = get_sql_calc_task_logged_time('tmp-task-id');
            // Replace tmp-task-id to be the same like tblstafftasks.id
            $selectLoggedTime = str_replace('tmp-task-id', 'tblstafftasks.id', $selectLoggedTime);

            if (is_numeric($staff_id)) {
                $selectLoggedTime .= ' AND staff_id=' . $staff_id;
                $sqlTasksSelect .= ',(' . $selectLoggedTime . ')';
            } else {
                $sqlTasksSelect .= ',(' . $selectLoggedTime . ')';
            }

            $sqlTasksSelect .= ' as total_logged_time';

            // Task checklist items
            $sqlTasksSelect .= ',' . get_sql_select_task_total_checklist_items();

            if (is_numeric($staff_id)) {
                $sqlTasksSelect .= ',(SELECT COUNT(id) FROM tbltaskchecklists WHERE taskid=tblstafftasks.id AND finished=1 AND finished_from=' . $staff_id . ') as total_finished_checklist_items';
            } else {
                $sqlTasksSelect .= ',' . get_sql_select_task_total_finished_checklist_items();
            }

            // Task total comment and total files
            $selectTotalComments = ',(SELECT COUNT(id) FROM tblstafftaskcomments WHERE taskid=tblstafftasks.id';
            $selectTotalFiles    = ',(SELECT COUNT(id) FROM tblfiles WHERE rel_id=tblstafftasks.id AND rel_type="task"';

            if (is_numeric($staff_id)) {
                $sqlTasksSelect .= $selectTotalComments . ' AND staffid=' . $staff_id . ') as total_comments_staff';
                $sqlTasksSelect .= $selectTotalFiles . ' AND staffid=' . $staff_id . ') as total_files_staff';
            }

            $sqlTasksSelect .= $selectTotalComments . ') as total_comments';
            $sqlTasksSelect .= $selectTotalFiles . ') as total_files';

            // Task assignees
            $sqlTasksSelect .= ',' . get_sql_select_task_asignees_full_names() . ' as assignees' . ',' . get_sql_select_task_assignees_ids() . ' as assignees_ids';

            $this->db->select($sqlTasksSelect);

            $this->db->where('MONTH(' . $fetch_month_from . ')', $m);
            $this->db->where('YEAR(' . $fetch_month_from . ')', $year);

            if ($project_id && $project_id != '') {
                $this->db->where('rel_id', $project_id);
                $this->db->where('rel_type', 'project');
            }

            if (!$has_permission_view) {
                $sqlWhereStaff = '(id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid=' . $staff_id . ')';

                // User dont have permission for view but have for create
                // Only show tasks createad by this user.
                if ($has_permission_create) {
                    $sqlWhereStaff .= ' OR addedfrom=' . get_staff_user_id();
                }

                $sqlWhereStaff .= ')';
                $this->db->where($sqlWhereStaff);
            } elseif ($has_permission_view) {
                if (is_numeric($staff_id)) {
                    $this->db->where('(id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid=' . $staff_id . '))');
                }
            }

            if ($status) {
                $this->db->where('status', $status);
            }

            $this->db->order_by($fetch_month_from, 'ASC');
            array_push($overview, $m);
            $overview[$m] = $this->db->get('tblstafftasks')->result_array();
        }

        unset($overview[0]);

        $overview = [
            'staff_id' => $staff_id,
            'detailed' => $overview,
        ];

        $data['members']  = $this->staff_model->get();
        $data['overview'] = $overview['detailed'];
        $data['years']    = $this->tasks_model->get_distinct_tasks_years(($this->input->post('month_from') ? $this->input->post('month_from') : 'startdate'));
        $data['staff_id'] = $overview['staff_id'];
        $data['title']    = _l('detailed_overview');
        $this->load->view('admin/tasks/detailed_overview', $data);
    }

    public function init_relation_tasks($rel_id, $rel_type)
    {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('tasks_relations', [
                'rel_id'   => $rel_id,
                'rel_type' => $rel_type, 
            ]);
        }
    }

    /* Add new task or update existing */
    public function task($id = '')
    {
        if (!has_permission('tasks', '', 'edit') && !has_permission('tasks', '', 'create')) {
            access_denied('Tasks');
        }

        $data = [];
        // FOr new task add directly from the projects milestones
        if ($this->input->get('milestone_id')) {
            $this->db->where('id', $this->input->get('milestone_id'));
            $milestone = $this->db->get('tblmilestones')->row();
            if ($milestone) {
                $data['_milestone_selected_data'] = [
                    'id'       => $milestone->id,
                    'due_date' => _d($milestone->due_date),
                ];
            }
        }
        if ($this->input->get('start_date')) {
            $data['start_date'] = $this->input->get('start_date');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            $data['description'] = $this->input->post('description', false);
            if ($id == '') {
                if (!has_permission('tasks', '', 'create')) {
                    header('HTTP/1.0 400 Bad error');
                    echo json_encode([
                        'success' => false,
                        'message' => _l('access_denied'),
                    ]);
                    die;
                }
                $id      = $this->tasks_model->add($data);
                $_id     = false;
                $success = false;
                $message = '';
                if ($id) {
                    $success       = true;
                    $_id           = $id;
                    $message       = _l('added_successfully', _l('task'));
                    $uploadedFiles = handle_task_attachments_array($id);
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'task', [$file]);
                        }
                    }
                }
                echo json_encode([
                    'success' => $success,
                    'id'      => $_id,
                    'message' => $message,
                ]);
            } else {
                if (!has_permission('tasks', '', 'edit')) {
                    header('HTTP/1.0 400 Bad error');
                    echo json_encode([
                        'success' => false,
                        'message' => _l('access_denied'),
                    ]);
                    die;
                }
                $success = $this->tasks_model->update($data, $id);
                $message = '';
                if ($success) {
                    $message = _l('updated_successfully', _l('task'));
                }
                echo json_encode([
                    'success' => $success,
                    'message' => $message,
                    'id'      => $id,
                ]);
            }
            die;
        }

        $data['milestones']         = [];
        $data['checklistTemplates'] = $this->tasks_model->get_checklist_templates();
        if ($id == '') {
            $title = _l('add_new', _l('task_lowercase'));
        } else {
            $data['task'] = $this->tasks_model->get($id);
            if ($data['task']->rel_type == 'project') {
                $data['milestones'] = $this->projects_model->get_milestones($data['task']->rel_id);
            }
            $title = _l('edit', _l('task_lowercase')) . ' ' . $data['task']->name;
        }
        $data['project_end_date_attrs'] = [];
        if ($this->input->get('rel_type') == 'project' && $this->input->get('rel_id')) {
            $project = $this->projects_model->get($this->input->get('rel_id'));
            if ($project->deadline) {
                $data['project_end_date_attrs'] = [
                    'data-date-end-date' => $project->deadline,
                ];
            }
        }
        $data['id']    = $id;
        $data['title'] = $title;
        $this->load->view('admin/tasks/task', $data);
    }

    public function copy()
    {
        if (has_permission('tasks', '', 'create')) {
            $new_task_id = $this->tasks_model->copy($this->input->post());
            $response    = [
                'new_task_id' => '',
                'alert_type'  => 'warning',
                'message'     => _l('failed_to_copy_task'),
                'success'     => false,
            ];
            if ($new_task_id) {
                $response['message']     = _l('task_copied_successfully');
                $response['new_task_id'] = $new_task_id;
                $response['success']     = true;
                $response['alert_type']  = 'success';
            }
            echo json_encode($response);
        }
    }

    public function get_billable_task_data($task_id)
    {
        $task              = $this->tasks_model->get_billable_task_data($task_id);
        $task->description = seconds_to_time_format($task->total_seconds) . ' ' . _l('hours');
        echo json_encode($task);
    }

    /**
     * Task ajax request modal
     * @param  mixed $taskid
     * @return mixed
     */
    public function get_task_data($taskid, $return = false)
    {
        $tasks_where = [];

        if (!has_permission('tasks', '', 'view')) {
            $tasks_where = get_tasks_where_string(false);
        }

        $task = $this->tasks_model->get($taskid, $tasks_where);

        if (!$task) {
            header('HTTP/1.0 404 Not Found');
            echo 'Task not found';
            die();
        }

        $data['checklistTemplates'] = $this->tasks_model->get_checklist_templates();
        $data['task']               = $task;
        $data['id']                 = $task->id;
        $data['staff']              = $this->staff_model->get('', ['active'=>1]);
        $data['task_is_billed']     = $this->tasks_model->is_task_billed($taskid);
        if ($return == false) {
            $this->load->view('admin/tasks/view_task_template', $data);
        } else {
            return $this->load->view('admin/tasks/view_task_template', $data, true);
        }
    }

    public function get_staff_started_timers($return = false)
    {
        $data['startedTimers'] = $this->misc_model->get_staff_started_timers();
        $_data['html']         = $this->load->view('admin/tasks/started_timers', $data, true);
        $_data['total_timers'] = count($data['startedTimers']);

        $timers = json_encode($_data);
        if ($return) {
            return $timers;
        }

        echo $timers;
    }

    public function save_checklist_item_template()
    {
        if (has_permission('checklist_templates', '', 'create')) {
            $id = $this->tasks_model->add_checklist_template($this->input->post('description'));
            echo json_encode(['id' => $id]);
        }
    }

    public function remove_checklist_item_template($id)
    {
        if (has_permission('checklist_templates', '', 'delete')) {
            $success = $this->tasks_model->remove_checklist_item_template($id);
            echo json_encode(['success' => $success]);
        }
    }

    public function init_checklist_items()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $post_data          = $this->input->post();
                $data['task_id']    = $post_data['taskid'];
                $data['checklists'] = $this->tasks_model->get_checklist_items($post_data['taskid']);
                $this->load->view('admin/tasks/checklist_items_template', $data);
            }
        }
    }

    public function task_tracking_stats($task_id)
    {
        $data['stats'] = json_encode($this->tasks_model->task_tracking_stats($task_id));
        $this->load->view('admin/tasks/tracking_stats', $data);
    }

    public function checkbox_action($listid, $value)
    {
        $this->db->where('id', $listid);
        $this->db->update('tbltaskchecklists', [
            'finished' => $value,
        ]);

        if ($this->db->affected_rows() > 0) {
            if ($value == 1) {
                $this->db->where('id', $listid);
                $this->db->update('tbltaskchecklists', [
                    'finished_from' => get_staff_user_id(),
                ]);
                do_action('task_checklist_item_finished', $listid);
            }
        }
    }

    public function add_checklist_item()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                echo json_encode([
                    'success' => $this->tasks_model->add_checklist_item($this->input->post()),
                ]);
            }
        }
    }

    public function update_checklist_order()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $this->tasks_model->update_checklist_order($this->input->post());
            }
        }
    }

    public function delete_checklist_item($id)
    {
        $list = $this->tasks_model->get_checklist_item($id);
        if (has_permission('tasks', '', 'delete') || $list->addedfrom == get_staff_user_id()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode([
                    'success' => $this->tasks_model->delete_checklist_item($id),
                ]);
            }
        }
    }

    public function update_checklist_item()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $desc = $this->input->post('description');
                $desc = trim($desc);
                $this->tasks_model->update_checklist_item($this->input->post('listid'), $desc);
                echo json_encode(['can_be_template' => (total_rows('tblcheckliststemplates', ['description' => $desc]) == 0)]);
            }
        }
    }

    public function make_public($task_id)
    {
        if (!has_permission('tasks', '', 'edit')) {
            json_encode([
                'success' => false,
            ]);
            die;
        }
        echo json_encode([
            'success'  => $this->tasks_model->make_public($task_id),
            'taskHtml' => $this->get_task_data($task_id, true),
        ]);
    }

    public function add_external_attachment()
    {
        if ($this->input->post()) {
            $this->tasks_model->add_attachment_to_database($this->input->post('task_id'), $this->input->post('files'), $this->input->post('external'));
        }
    }

    /* Add new task comment / ajax */
    public function add_task_comment()
    {
        $data            = $this->input->post();
        $data['content'] = $this->input->post('content', false);
        if($this->input->post('no_editor')) {
            $data['content'] = nl2br($this->input->post('content'));
        }
        $comment_id      = false;
        if ($data['content'] != ''
            || (isset($_FILES['file']['name']) && is_array($_FILES['file']['name']) && count($_FILES['file']['name']) > 0)) {
            $comment_id = $this->tasks_model->add_task_comment($data);
            if ($comment_id) {
                $commentAttachments = handle_task_attachments_array($data['taskid'], 'file');
                if ($commentAttachments && is_array($commentAttachments)) {
                    foreach ($commentAttachments as $file) {
                        $file['task_comment_id'] = $comment_id;
                        $this->misc_model->add_attachment_to_database($data['taskid'], 'task', [$file]);
                    }

                    if (count($commentAttachments) > 0) {
                        $this->db->query("UPDATE tblstafftaskcomments SET content = CONCAT(content, '[task_attachment]')
                            WHERE id = " . $comment_id);
                    }
                }
            }
        }
        echo json_encode([
            'success'  => $comment_id ? true : false,
            'taskHtml' => $this->get_task_data($data['taskid'], true),
        ]);
    }

    public function download_comment_files($task_id, $comment_id)
    {
        $files = $this->tasks_model->get_task_attachments($task_id, 'task_comment_id=' . $comment_id);

        $path = get_upload_path_by_type('task') . $task_id;

        $this->load->library('zip');

        foreach ($files as $file) {
            $this->zip->read_file($path . '/' . $file['file_name']);
        }

        $this->zip->download('files.zip');
        $this->zip->clear_data();
    }

    /* Add new task follower / ajax */
    public function add_task_followers()
    {
        if (has_permission('tasks', '', 'edit') || has_permission('tasks', '', 'create')) {
            echo json_encode([
                'success'  => $this->tasks_model->add_task_followers($this->input->post()),
                'taskHtml' => $this->get_task_data($this->input->post('taskid'), true),
            ]);
        }
    }

    /* Add task assignees / ajax */
    public function add_task_assignees()
    {
        if (has_permission('tasks', '', 'edit') || has_permission('tasks', '', 'create')) {
            echo json_encode([
                'success'  => $this->tasks_model->add_task_assignees($this->input->post()),
                'taskHtml' => $this->get_task_data($this->input->post('taskid'), true),
            ]);
        }
    }

    public function edit_comment()
    {
        if ($this->input->post()) {
            $data            = $this->input->post();
            $data['content'] = $this->input->post('content', false);
            if($this->input->post('no_editor')) {
                $data['content'] = nl2br(clear_textarea_breaks($this->input->post('content')));
            }
            $success         = $this->tasks_model->edit_comment($data);
            $message         = '';
            if ($success) {
                $message = _l('task_comment_updated');
            }
            echo json_encode([
                'success'  => $success,
                'message'  => $message,
                'taskHtml' => $this->get_task_data($data['task_id'], true),
            ]);
        }
    }

    /* Remove task comment / ajax */
    public function remove_comment($id)
    {
        echo json_encode([
            'success' => $this->tasks_model->remove_comment($id),
        ]);
    }

    /* Remove assignee / ajax */
    public function remove_assignee($id, $taskid)
    {
        if (has_permission('tasks', '', 'edit') && has_permission('tasks', '', 'create')) {
            $success = $this->tasks_model->remove_assignee($id, $taskid);
            $message = '';
            if ($success) {
                $message = _l('task_assignee_removed');
            }
            echo json_encode([
                'success'  => $success,
                'message'  => $message,
                'taskHtml' => $this->get_task_data($taskid, true),
            ]);
        }
    }

    /* Remove task follower / ajax */
    public function remove_follower($id, $taskid)
    {
        if (has_permission('tasks', '', 'edit') && has_permission('tasks', '', 'create')) {
            $success = $this->tasks_model->remove_follower($id, $taskid);
            $message = '';
            if ($success) {
                $message = _l('task_follower_removed');
            }
            echo json_encode([
                'success'  => $success,
                'message'  => $message,
                'taskHtml' => $this->get_task_data($taskid, true),
            ]);
        }
    }

    /* Unmark task as complete / ajax*/
    public function unmark_complete($id)
    {
        if ($this->tasks_model->is_task_assignee(get_staff_user_id(), $id)
            || $this->tasks_model->is_task_creator(get_staff_user_id(), $id)
            || is_admin()) {
            $success = $this->tasks_model->unmark_complete($id);

            // Don't do this query if the action is not performed via task single
            $taskHtml = $this->input->get('single_task') === 'true' ? $this->get_task_data($id, true) : '';

            $message = '';
            if ($success) {
                $message = _l('task_unmarked_as_complete');
            }
            echo json_encode([
                'success'  => $success,
                'message'  => $message,
                'taskHtml' => $taskHtml,
            ]);
        } else {
            echo json_encode([
                'success'  => false,
                'message'  => '',
                'taskHtml' => $taskHtml,
            ]);
        }
    }

    public function mark_as($status, $id)
    {
        if ($this->tasks_model->is_task_assignee(get_staff_user_id(), $id)
            || $this->tasks_model->is_task_creator(get_staff_user_id(), $id)
            || is_admin()) 
        {
            $success = $this->tasks_model->mark_as($status, $id);
            
            // Don't do this query if the action is not performed via task single
            $taskHtml = $this->input->get('single_task') === 'true' ? $this->get_task_data($id, true) : '';

            $message = '';
            $mail_status = 'not attemp';

            if ($success) {
                $message = _l('task_marked_as_success', format_task_status($status, true, true));

                $status_of_mail = $this->send_task_status_mail($id);
                if ($status_of_mail) 
                {
                 $mail_status = 'success';  
                }
                else
                {
                    $mail_status = 'error'; 
                }
            }

            echo json_encode([
                'success'  => $success,
                'message'  => $message,
                'taskHtml' => $taskHtml,
                'mail_status' => $mail_status,
            ]);
        } 
        else 
        {
            echo json_encode([
                'success'  => false,
                'message'  => '',
                'taskHtml' => $taskHtml,
            ]);
        }
    }

    public function send_task_status_mail($task_id)
    {

        $task_data = $this->tasks_model->get_task_by_id($task_id);
        if(empty($task_data))
        {
            return false;
        }

        $client_data = $this->tasks_model->get_client_by_id($task_data->addedfrom);

        if(empty($client_data))
        {
            return false;
        }

        $email = $client_data->email ? $client_data->email : $client_data->company;
        // $this->load->model->('emails_model');


        $task_name = $task_data->name;
        $templet = NULL;
        $subject= NULL;
        $mail_template = $task_data->mail_template;

        if($mail_template)
        {
            switch ($mail_template) 
            {
                case "permit":
                    $templet = $this->load->view('admin/tasks/email/templet/permit','',true);
                    $subject = $task_name;
                break;

                case "order-processing":
                    $templet = $this->load->view('admin/tasks/email/templet/order-processing','',true);
                    $subject = $task_name;
                break;

                case "city-approved":
                    $templet = $this->load->view('admin/tasks/email/templet/city-approved','',true);
                    $subject = $task_name;
                break;

                case "order-arrived":
                    $templet = $this->load->view('admin/tasks/email/templet/order-arrived','',true);
                    $subject = $task_name;
                break;

                case "order-completed":
                    $templet = $this->load->view('admin/tasks/email/templet/order-completed','',true);
                    $subject = $task_name;
                break;
              
            }


            if(empty($templet) || empty($email) || empty($subject))
            {
                return false;
            }

            $sent = $this->send_email_for_task($email, $subject, $templet);
            if($sent) 
            {
               return true;
            } 
            else 
            {
                return false;
            }

        }
        else
        {
            return false;
        }
    }


    public function send_email_for_task($email, $subject, $bodymessage)
    {
        $this->load->config('email');
        // Simulate fake template to be parsed
        $template = new StdClass();
        $template->message = $bodymessage;

        $fromname = get_option('companyname').' | CRM ';
        $template->fromname = $fromname; //we use fromname because client name is not available
        $template->subject  = $subject;

        $template = parse_email_template($template);
        $this->email->initialize();
        if (get_option('mail_engine') == 'phpmailer') {
            $this->email->set_debug_output(function ($err) {
                if (!isset($GLOBALS['debug'])) {
                    $GLOBALS['debug'] = '';
                }
                $GLOBALS['debug'] .= $err . '<br />';
                return $err;
            });
            $this->email->set_smtp_debug(3);
        }

        $this->email->set_newline(config_item('newline'));
        $this->email->set_crlf(config_item('crlf'));
        $this->email->from(get_option('smtp_email'), $template->fromname);
        // p($email);

        $this->email->to($email); // client email addres
        $this->email->subject($template->subject);
        $this->email->message($template->message);

        if ($this->email->send(true)) 
        {
            return true;
        } 
        else 
        {
            // p( $this->email->set_smtp_debug(3));
            return false;
        }
    }

    public function change_priority($priority_id, $id)
    {
        if (has_permission('tasks', '', 'edit')) {
            $this->db->where('id', $id);
            $this->db->update('tblstafftasks', ['priority' => $priority_id]);

            $success = $this->db->affected_rows() > 0 ? true : false;

            // Don't do this query if the action is not performed via task single
            $taskHtml = $this->input->get('single_task') === 'true' ? $this->get_task_data($id, true) : '';
            echo json_encode([
                'success'  => $success,
                'taskHtml' => $taskHtml,
            ]);
        } else {
            echo json_encode([
                'success'  => false,
                'taskHtml' => $taskHtml,
            ]);
        }
    }

    public function change_milestone($milestone_id, $id)
    {
        if (has_permission('tasks', '', 'edit')) {
            $this->db->where('id', $id);
            $this->db->update('tblstafftasks', ['milestone' => $milestone_id]);

            $success = $this->db->affected_rows() > 0 ? true : false;
            // Don't do this query if the action is not performed via task single
            $taskHtml = $this->input->get('single_task') === 'true' ? $this->get_task_data($id, true) : '';
            echo json_encode([
                'success'  => $success,
                'taskHtml' => $taskHtml,
            ]);
        } else {
            echo json_encode([
                'success'  => false,
                'taskHtml' => $taskHtml,
            ]);
        }
    }

    public function task_single_inline_update($task_id)
    {
        if (has_permission('tasks', '', 'edit')) {
            $post_data = $this->input->post();
            foreach ($post_data as $key => $val) {
                $this->db->where('id', $task_id);
                $this->db->update('tblstafftasks', [$key => to_sql_date($val)]);
            }
        }
    }

    /* Delete task from database */
    public function delete_task($id)
    {
        if (!has_permission('tasks', '', 'delete')) {
            access_denied('tasks');
        }
        $success = $this->tasks_model->delete_task($id);
        $message = _l('problem_deleting', _l('task_lowercase'));
        if ($success) {
            $message = _l('deleted', _l('task'));
            set_alert('success', $message);
        } else {
            set_alert('warning', $message);
        }

        if (strpos($_SERVER['HTTP_REFERER'], 'tasks/index') !== false || strpos($_SERVER['HTTP_REFERER'], 'tasks/view') !== false) {
            redirect(admin_url('tasks'));
        } elseif (preg_match("/projects\/view\/[1-9]+/", $_SERVER['HTTP_REFERER'])) {
            $project_url = explode('?', $_SERVER['HTTP_REFERER']);
            redirect($project_url[0] . '?group=project_tasks');
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Remove task attachment
     * @since  Version 1.0.1
     * @param  mixed $id attachment it
     * @return json
     */
    public function remove_task_attachment($id)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->tasks_model->remove_task_attachment($id));
        }
    }

    /**
     * Upload task attachment
     * @since  Version 1.0.1
     */
    public function upload_file()
    {
        if ($this->input->post()) {
            $taskid  = $this->input->post('taskid');
            $files   = handle_task_attachments_array($taskid, 'file');
            $success = false;

            if ($files) {
                $i   = 0;
                $len = count($files);
                foreach ($files as $file) {
                    $success = $this->tasks_model->add_attachment_to_database($taskid, [$file], false, ($i == $len - 1 ? true : false));
                    $i++;
                }
            }

            echo json_encode([
                'success'  => $success,
                'taskHtml' => $this->get_task_data($taskid, true),
            ]);
        }
    }

    public function timer_tracking()
    {
        $task_id = $this->input->post('task_id');
        echo json_encode([
            'success'  => $this->tasks_model->timer_tracking($task_id, $this->input->post('timer_id'), nl2br($this->input->post('note'))),
            'taskHtml' => $this->input->get('single_task') === 'true' ? $this->get_task_data($task_id, true) : '',
            'timers'   => $this->get_staff_started_timers(true),
        ]);
    }

    public function delete_user_unfinished_timesheet($id)
    {
        $this->db->where('id', $id);
        $timesheet = $this->db->get('tbltaskstimers')->row();
        if ($timesheet && $timesheet->end_time == null && $timesheet->staff_id == get_staff_user_id()) {
            $this->db->where('id', $id);
            $this->db->delete('tbltaskstimers');
        }
        echo json_encode(['timers' => $this->get_staff_started_timers(true)]);
    }

    public function delete_timesheet($id)
    {
        if (has_permission('tasks', '', 'delete') || has_permission('projects', '', 'delete') || total_rows('tbltaskstimers', ['staff_id' => get_staff_user_id(), 'id' => $id]) > 0) {
            $alert_type = 'warning';
            $success    = $this->tasks_model->delete_timesheet($id);
            if ($success) {
                $this->session->set_flashdata('task_single_timesheets_open', true);
                $message = _l('deleted', _l('project_timesheet'));
                set_alert('success', $message);
            }
            if (!$this->input->is_ajax_request()) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function log_time()
    {
        $success = $this->tasks_model->timesheet($this->input->post());
        if ($success === true) {
            $this->session->set_flashdata('task_single_timesheets_open', true);
            $message = _l('added_successfully', _l('project_timesheet'));
        } elseif (is_array($success) && isset($success['end_time_smaller'])) {
            $message = _l('failed_to_add_project_timesheet_end_time_smaller');
        } else {
            $message = _l('project_timesheet_not_updated');
        }

        echo json_encode([
            'success' => $success,
            'message' => $message,
        ]);
        die;
    }

    public function update_tags()
    {
        if (has_permission('tasks', '', 'create') || has_permission('tasks', '', 'edit')) {
            handle_tags_save($this->input->post('tags'), $this->input->post('task_id'), 'task');
        }
    }

    public function bulk_action()
    {
        do_action('before_do_bulk_action_for_tasks');
        $total_deleted = 0;
        if ($this->input->post()) {
            $status    = $this->input->post('status');
            $ids       = $this->input->post('ids');
            $tags      = $this->input->post('tags');
            $assignees = $this->input->post('assignees');
            $milestone = $this->input->post('milestone');
            $priority  = $this->input->post('priority');
            $is_admin  = is_admin();
            if (is_array($ids)) {
                foreach ($ids as $id) {
                    if ($this->input->post('mass_delete')) {
                        if (has_permission('tasks', '', 'delete')) {
                            if ($this->tasks_model->delete_task($id)) {
                                $total_deleted++;
                            }
                        }
                    } else {
                        if ($status) {
                            if ($this->tasks_model->is_task_creator(get_staff_user_id(), $id)
                                || $is_admin
                                || $this->tasks_model->is_task_assignee(get_staff_user_id(), $id)) {
                                $this->tasks_model->mark_as($status, $id);
                            }
                        }
                        if ($priority || $milestone) {
                            $update = [];
                            if ($priority) {
                                $update['priority'] = $priority;
                            }
                            if ($milestone) {
                                $update['milestone'] = $milestone;
                            }
                            $this->db->where('id', $id);
                            $this->db->update('tblstafftasks', $update);
                        }
                        if ($tags) {
                            handle_tags_save($tags, $id, 'task');
                        }
                        if ($assignees) {
                            $notifiedUsers = [];
                            foreach ($assignees as $user_id) {
                                if (!$this->tasks_model->is_task_assignee($user_id, $id)) {
                                    $this->db->select('rel_type,rel_id');
                                    $this->db->where('id', $id);
                                    $task = $this->db->get('tblstafftasks')->row();
                                    if ($task->rel_type == 'project') {
                                        // User is we are trying to assign the task is not project member
                                        if (total_rows('tblprojectmembers', ['project_id' => $task->rel_id, 'staff_id' => $user_id]) == 0) {
                                            $this->db->insert('tblprojectmembers', ['project_id' => $task->rel_id, 'staff_id' => $user_id]);
                                        }
                                    }
                                    $this->db->insert('tblstafftaskassignees', [
                                        'staffid'       => $user_id,
                                        'taskid'        => $id,
                                        'assigned_from' => get_staff_user_id(),
                                        ]);
                                    if ($user_id != get_staff_user_id()) {
                                        $notification_data = [
                                        'description' => 'not_task_assigned_to_you',
                                        'touserid'    => $user_id,
                                        'link'        => '#taskid=' . $id,
                                        ];

                                        $notification_data['additional_data'] = serialize([
                                            get_task_subject_by_id($id),
                                        ]);
                                        if (add_notification($notification_data)) {
                                            array_push($notifiedUsers, $user_id);
                                        }
                                    }
                                }
                            }
                            pusher_trigger_notification($notifiedUsers);
                        }
                    }
                }
            }
            if ($this->input->post('mass_delete')) {
                set_alert('success', _l('total_tasks_deleted', $total_deleted));
            }
        }
    }


    public function hoa_details_for_task($task_id = NULL)
    {

        close_setup_menu();
        $staff_id = get_staff_user_id();

        $staff_data = $this->tasks_model->get_staff_by_id($staff_id);
        if(empty($staff_data))
        {
             set_alert('warning', 'Sorry Access Denied..');
             return redirect(base_url('admin/tasks'));
        }
        $task_data_array = array();

        if($task_id)
        {
            $task_data_array = $this->tasks_model->get_hoa_task_by_id($task_id);

            if(empty($task_data_array))
            {
                 set_alert('warning', 'Sorry Hoa Approvel Task Is Not Exist For This Task Id');
                 return redirect(base_url('admin/tasks'));
            }

            $task_hoa_data = $this->tasks_model->get_task_hoa_by_taskid_user_id($task_id,$staff_id);

            if($task_hoa_data)
            {
                set_alert('warning', 'Task Hoa Details Are Already Exist You Can Update Them');
                return redirect(base_url('admin/tasks/view_hoa_details_for_task/'.$task_hoa_data->id));
            }

        }

        // If passed from url

        $this->form_validation->set_rules('task_id', 'Task Name', 'required|trim');
        $this->form_validation->set_rules('hoa_payment', 'Hoa Payment', 'required|trim');

        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {
            $hoa_content = array();

            $post_task_id = $this->input->post('task_id',TRUE);

            $chek_task_hoa_data = $this->tasks_model->get_task_hoa_by_taskid_user_id($post_task_id,$staff_id);

            if($chek_task_hoa_data)
            {
                set_alert('warning', 'Task Hoa Details Are Already Exist You Can Update Them');
                return redirect(base_url('admin/tasks/view_hoa_details_for_task/'.$chek_task_hoa_data->id));
            }

            if (empty($_FILES['architectural_modification']['name'])) 
            {
                $architectural_modification = NULL;
            }
            else
            {

                $config['upload_path'] = "./assets/images/";
                $config['allowed_types'] = 'jpg|png|bmp|jpeg';
                $new_name = time().$_FILES["architectural_modification"]['name'];
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('architectural_modification')) 
                {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    $this->form_validation->set_rules('architectural_modification', 'Upload Architectural Modification', 'required|trim');
                }

                $file = $this->upload->data();
                $architectural_modification = $file['file_name'];
            
            }

            $post_hoa_payment = $this->input->post('hoa_payment',TRUE);
            $hoa_approve = $this->input->post('is_hoa', TRUE) ? 1 : 0;
            $pay_task_status = $this->task_on_hoa_payment_mode($post_hoa_payment, $post_task_id, $hoa_approve);

            $hoa_content['task_id'] = $this->input->post('task_id',TRUE);
            $hoa_content['staff_id'] = $staff_id;
            $hoa_content['is_hoa'] = $this->input->post('is_hoa',TRUE) ? 1 : 0;
            $hoa_content['architectural_modification'] = $architectural_modification;
            $hoa_content['hoa_contact_info'] = $this->input->post('hoa_contact_info',TRUE);
            $hoa_content['hoa_payment'] = $this->input->post('hoa_payment',TRUE);
            $hoa_content['permit'] = $this->input->post('permit',TRUE) ? 1 : 0;
            $hoa_content['modification'] = $this->input->post('modification',TRUE) ? 1 : 0;
            $hoa_content['engineering'] = $this->input->post('engineering',TRUE) ? 1 : 0;
            $hoa_content['information_to_engineer'] = $this->input->post('information_to_engineer',TRUE) ? $this->input->post('information_to_engineer',TRUE) : NULL;

            $hoa_content['added'] =  date('Y-m-d H:i:s');
            // P($hoa_content);
            $hoa_detail = $this->tasks_model->insert_hoa_detail($hoa_content);

            if($hoa_detail)
            {                
                 set_alert('success', 'Hoa Data Inserted Successfully');
                // $this->session->set_flashdata('message', 'Data Inserted Successfully');                  
            }
            else
            {
                 set_alert('warning', 'Hoa Data Insert Error');
                // $this->session->set_flashdata('error', 'Data Insert Error'); 
            }
             redirect(base_url('admin/tasks'));
        }

        $data['custom_view'] = $this->input->get('custom_view') ? $this->input->get('custom_view') : '';
        $data['staff_id']      = $staff_id;

        if ($this->input->get('kanban')) {
            $this->switch_kanban(0, true);
        }

        $data['switch_kanban'] = false;
        $data['bodyclass']     = 'hoa-details-task-page';

        if ($this->session->userdata('tasks_kanban_view') == 'true') {
            $data['switch_kanban'] = true;
            $data['bodyclass']     = 'hoa-details-task-page kan-ban-body';
        }

        $task_aval_id_array = $this->tasks_model->get_task_aval_hoa_by_user_id($staff_id);
        $all_task_array = $this->Tasks_model->get_tasks_assign_by_staff_id($staff_id, $task_aval_id_array); 

        $data['all_task_array'] = $all_task_array;
        $data['title'] = _l('Hoa Details For Tasks Page');
        $data['task_id'] = $task_id;
        $data['task_data_array'] = $task_data_array;
        $data['hoa_task_detail_id'] = NULL;

        // p($task_data_array);

        $this->load->view('admin/tasks/hoa-details', $data);
    }




    public function view_hoa_details_for_task($hoa_task_detail_id = NULL)
    {

        close_setup_menu();
        $staff_id = get_staff_user_id();

        $staff_data = $this->tasks_model->get_staff_by_id($staff_id);
        if(empty($staff_data))
        {
             set_alert('warning', 'Sorry Access Denied..');
             return redirect(base_url('admin/tasks'));
        }
  
        $task_hoa_data_array = $this->tasks_model->get_task_hoa_detail_by_id($hoa_task_detail_id);

        if(empty($task_hoa_data_array))
        {
             set_alert('warning', 'Sorry Task Hoa Detail Are Exist For This Id');
             return redirect(base_url('admin/tasks'));
        }

        $task_id = $task_hoa_data_array ->task_id;
        $task_data_array =array();
        
        $task_data_array = $this->tasks_model->get_hoa_task_by_id($task_id);

        if(empty($task_data_array))
        {
             set_alert('warning', 'Sorry Hoa Approvel Task Is Not Exist For This Task Id');
             return redirect(base_url('admin/tasks'));
        }

        // If passed from url

        $this->form_validation->set_rules('task_id', 'Task Name', 'required|trim');
        $this->form_validation->set_rules('hoa_payment', 'Hoa Payment', 'required|trim');

        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        elseif('ram' == 'shyam') 
        {
            $hoa_content = array();


            if (empty($_FILES['architectural_modification']['name'])) 
            {
                $architectural_modification = NULL;
            }
            else
            {

                $config['upload_path'] = "./assets/images/";
                $config['allowed_types'] = 'jpg|png|bmp|jpeg';
                $new_name = time().$_FILES["architectural_modification"]['name'];
                $config['file_name'] = $new_name;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('architectural_modification')) 
                {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    $this->form_validation->set_rules('architectural_modification', 'Upload Architectural Modification', 'required|trim');
                }

                $file = $this->upload->data();
                $architectural_modification = $file['file_name'];
            }

            $hoa_content['staff_id'] = $staff_id;
            $hoa_content['task_id'] = $this->input->post('task_id',TRUE);
            $hoa_content['is_hoa'] = $this->input->post('is_hoa',TRUE) ? 1 : 0;
            if($architectural_modification)
            {
                $hoa_content['architectural_modification'] = $architectural_modification;
            }
            $hoa_content['hoa_contact_info'] = $this->input->post('hoa_contact_info',TRUE);
            $hoa_content['hoa_payment'] = $this->input->post('hoa_payment',TRUE);
            $hoa_content['permit'] = $this->input->post('permit',TRUE) ? 1 : 0;
            $hoa_content['modification'] = $this->input->post('modification',TRUE) ? 1 : 0;
            $hoa_content['engineering'] = $this->input->post('engineering',TRUE) ? 1 : 0;
            $hoa_content['information_to_engineer'] = $this->input->post('information_to_engineer',TRUE) ? $this->input->post('information_to_engineer',TRUE) : NULL;

            $hoa_content['updated'] =  date('Y-m-d H:i:s');
            // P($hoa_content);
            $hoa_update = $this->tasks_model->update_hoa_detail($hoa_content,$hoa_task_detail_id);

            if($hoa_update)
            {                
                 set_alert('success', 'Hoa Data Update Successfully');
                // $this->session->set_flashdata('message', 'Data Inserted Successfully');                  
            }
            else
            {
                 set_alert('warning', 'Hoa Data Update Error');
                // $this->session->set_flashdata('error', 'Data Insert Error'); 
            }
             redirect(base_url('admin/tasks'));
        }

        $data['custom_view'] = $this->input->get('custom_view') ? $this->input->get('custom_view') : '';
        $data['staff_id']      = $staff_id;

        if ($this->input->get('kanban')) {
            $this->switch_kanban(0, true);
        }

        $data['switch_kanban'] = false;
        $data['bodyclass']     = 'update-hoa-details-task-page';

        if ($this->session->userdata('tasks_kanban_view') == 'true') {
            $data['switch_kanban'] = true;
            $data['bodyclass']     = 'update-hoa-details-task-page kan-ban-body';
        }

        $task_aval_id_array = $this->tasks_model->get_task_aval_hoa_by_user_id($staff_id);
        $all_task_array = $this->Tasks_model->get_tasks_assign_by_staff_id($staff_id, $task_aval_id_array); 

        $data['all_task_array'] = $all_task_array;
        $data['title'] = _l('Hoa Details For Tasks Page');
        $data['task_id'] = $task_id;
        $data['task_data_array'] = $task_data_array;
        $data['task_hoa_data_array'] = $task_hoa_data_array;
        $data['hoa_task_detail_id'] = $hoa_task_detail_id;

        // p($task_data_array);

        $this->load->view('admin/tasks/hoa-details', $data);
    }

    public function task_on_hoa_payment_mode($payment_mode,  $post_task_id, $hoa_approve)
    {
        if($payment_mode == 'Check')
        {
            $title =  "'Payment: Check (Collect Deposits 50% Deposit & 30% Prior To Delivery)";

            $this->create_custom_task($title ,$post_task_id);
            $response['msg'] = 'Insert Task For Hoa Payment '.$payment_mode;

        }
        elseif ($payment_mode == 'Ygrene') 
        {
            $title = "Finance (Upload Notice To Proceed)";
            $this->create_custom_task($title ,$post_task_id);

        }

        if($hoa_approve == 1)
        {
            $title = "Upload HOA Approval If Needed";
            $this->create_custom_task($title ,$post_task_id);
        }

        return true;

    }


    public function create_custom_task($title, $task_id)
    {
            $task_value_array =  $this->tasks_model->get_tasks_by_task_id($task_id);

            $staff_id = get_staff_user_id();

            $task_array = array();
            $task_array['name'] = $title;
            $task_array['description'] = $title;
            $task_array['priority'] = 1;
            $task_array['dateadded'] = date('Y-m-d H:i:s');
            $task_array['startdate'] = date('Y-m-d H:i:s');;
            $task_array['addedfrom'] = $staff_id;
            $task_array['is_added_from_contact'] = 0;
            $task_array['status'] = 1;
            $task_array['repeat_every'] = 0;
            $task_array['recurring'] = 0;
            $task_array['cycles'] = 0;
            $task_array['total_cycles'] = 0;
            $task_array['custom_recurring'] = 0;
            $task_array['rel_id'] = $task_value_array['rel_id'];
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

            $this->db->insert('tblstafftasks', $task_array);
            $tsk_id = $this->db->insert_id();



            $tblstaff_user = $this->db->where('role',3)->get('tblstaff')->result(); 

            foreach ($tblstaff_user as $user_array) 
            {
                $task_asign_array = array();
                $task_asign_array['staffid'] = $user_array->staffid; 
                $task_asign_array['taskid'] = $tsk_id; 
                $task_asign_array['assigned_from'] = $staff_id; 
                $task_asign_array['is_assigned_from_contact'] = 0; 
                $this->db->insert('tblstafftaskassignees', $task_asign_array);



                $tbltaskstimers_array =  array( 'start_time'  => time(),
                                    'staff_id'    => $staff_id,
                                    'task_id'     => $tsk_id,
                                    'hourly_rate' => $user_array->hourly_rate,
                                    'note'        => NULL, 
                                );

                $this->db->insert('tbltaskstimers',$tbltaskstimers_array);
                $new_insert_id = $this->db->insert_id();
                               
            }
            return true;
    }


    public function check_list()
    {
        close_setup_menu();
        $staff_id = get_staff_user_id();
       
        $this->form_validation->set_rules('client_name', 'Clent Name', 'required|trim');
        $this->form_validation->set_rules('date', 'Date', 'required|trim|date');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'required|trim|numeric');
        $this->form_validation->set_rules('city', 'City', 'required|trim');
        $this->form_validation->set_rules('state', 'State', 'required|trim');
        $this->form_validation->set_rules('zip', 'Zip Code', 'required|trim|numeric');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('manufacturer_1', 'Manufacturer', 'required|trim');
        $this->form_validation->set_rules('manufacturer_2', 'Manufacturer', 'required|trim');
        $this->form_validation->set_rules('po_1', 'Po', 'required|trim');
        $this->form_validation->set_rules('po_2', 'Po', 'required|trim');
        $this->form_validation->set_rules('pr_notes', 'Project Notes ', 'required|trim');
        $this->form_validation->set_rules('project_manager', 'Project Manager', 'required|trim');
        $this->form_validation->set_rules('sign_client_name', 'Client Name', 'required|trim');
        // $this->form_validation->set_rules('manager_signature', 'Manager Signature', 'required|trim');
        // $this->form_validation->set_rules('client_signature', 'Clientr Signature', 'required|trim');

        $open_close = $this->input->post('open_close[]');
        $open_close  = $open_close ? $open_close : array();

        $lock = $this->input->post('lock[]');
        $lock  = $lock ? $lock : array();

        $screws = $this->input->post('screws[]');
        $screws  = $screws ? $screws : array();

        $int_caulking = $this->input->post('int_caulking[]');
        $int_caulking  = $int_caulking ? $int_caulking : array();

        $stickers = $this->input->post('stickers[]');
        $stickers  = $stickers ? $stickers : array();

        $ext_caulking = $this->input->post('ext_caulking[]');
        $ext_caulking  = $ext_caulking ? $ext_caulking : array();

        $screens = $this->input->post('screens[]');
        $screens  = $screens ? $screens : array();

        $covers = $this->input->post('covers[]');
        $covers  = $covers ? $covers : array();

        $no_of_option = sizeof($open_close);


        $option_array = array();

        if($open_close)
        {
            foreach ($open_close as $key => $value) 
            {
                $option_value_array['open_close'] = $value; 
                $option_value_array['lock'] = $lock[$key]; 
                $option_value_array['screws'] = $screws[$key];
                $option_value_array['int_caulking'] = $int_caulking[$key];
                $option_value_array['stickers'] =$stickers[$key];
                $option_value_array['ext_caulking'] = $ext_caulking[$key];
                $option_value_array['screens'] = $screens[$key];
                $option_value_array['covers'] = $covers[$key];
                $option_array[] = $option_value_array;
            }
        }

        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {

            $check_list_content = array();

            $check_list_content['client_name'] = $this->input->post('client_name',TRUE);
            $check_list_content['date'] = $this->input->post('date',TRUE);
            $check_list_content['city'] = $this->input->post('city',TRUE);
            $check_list_content['state'] = $this->input->post('state',TRUE);
            $check_list_content['zip'] = $this->input->post('zip',TRUE);
            $check_list_content['address'] = $this->input->post('address',TRUE);
            $check_list_content['contact_no'] = $this->input->post('contact_no',TRUE);
            $check_list_content['email'] = $this->input->post('email',TRUE);
            $check_list_content['manufacturer_1'] = $this->input->post('manufacturer_1',TRUE);
            $check_list_content['po_1'] = $this->input->post('po_1',TRUE);
            $check_list_content['manufacturer_2'] = $this->input->post('manufacturer_2',TRUE);
            $check_list_content['po_2'] = $this->input->post('po_2',TRUE);
            $check_list_content['pr_notes'] = $this->input->post('pr_notes',TRUE);
            $check_list_content['project_manager'] = $this->input->post('project_manager',TRUE);
            $check_list_content['sign_client_name'] = $this->input->post('sign_client_name',TRUE);
            $check_list_content['task_chek_data'] = json_encode($option_array);
            $check_list_content['added'] =  date('Y-m-d H:i:s');
            // P($check_list_content);
            $check_list_detail = $this->tasks_model->insert_check_list($check_list_content);

            if($check_list_detail)
            {                
                 set_alert('success', 'Check List Data Inserted Successfully');
            }
            else
            {
                 set_alert('warning', 'Check List Data Insert Error');
            }
             redirect(base_url('admin/tasks'));
        }
        $data['title'] = _l('Check List');
        $data['no_of_option'] = $no_of_option;
        $data['option_array'] = $option_array;
        $data['bodyclass']     = 'check-list';
        $this->load->view('admin/tasks/check_list', $data);    
    }


    public function update_check_list($check_list_id)
    {
        close_setup_menu();
        $staff_id = get_staff_user_id();

        if(empty($check_list_id))
        {
            set_alert('warning', 'Invalid Link Address !');
            return redirect(base_url('admin/task'));
        }

        $check_list_data = $this->tasks_model->get_check_list_data_by_id($check_list_id); 
        if(empty($check_list_data))
        {
            set_alert('warning', 'Invalid Check List Id !');
            return redirect(base_url('admin/task'));
        }
       
        $this->form_validation->set_rules('client_name', 'Clent Name', 'required|trim');
        $this->form_validation->set_rules('date', 'Date', 'required|trim|date');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'required|trim|numeric');
        $this->form_validation->set_rules('city', 'City', 'required|trim');
        $this->form_validation->set_rules('state', 'State', 'required|trim');
        $this->form_validation->set_rules('zip', 'Zip Code', 'required|trim|numeric');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('manufacturer_1', 'Manufacturer', 'required|trim');
        $this->form_validation->set_rules('manufacturer_2', 'Manufacturer', 'required|trim');
        $this->form_validation->set_rules('po_1', 'Po', 'required|trim');
        $this->form_validation->set_rules('po_2', 'Po', 'required|trim');
        $this->form_validation->set_rules('pr_notes', 'Project Notes ', 'required|trim');
        $this->form_validation->set_rules('project_manager', 'Project Manager', 'required|trim');
        $this->form_validation->set_rules('sign_client_name', 'Client Name', 'required|trim');
        // $this->form_validation->set_rules('manager_signature', 'Manager Signature', 'required|trim');
        // $this->form_validation->set_rules('client_signature', 'Clientr Signature', 'required|trim');

        $open_close = $this->input->post('open_close[]');
        $open_close  = $open_close ? $open_close : array();

        $lock = $this->input->post('lock[]');
        $lock  = $lock ? $lock : array();

        $screws = $this->input->post('screws[]');
        $screws  = $screws ? $screws : array();

        $int_caulking = $this->input->post('int_caulking[]');
        $int_caulking  = $int_caulking ? $int_caulking : array();

        $stickers = $this->input->post('stickers[]');
        $stickers  = $stickers ? $stickers : array();

        $ext_caulking = $this->input->post('ext_caulking[]');
        $ext_caulking  = $ext_caulking ? $ext_caulking : array();

        $screens = $this->input->post('screens[]');
        $screens  = $screens ? $screens : array();

        $covers = $this->input->post('covers[]');
        $covers  = $covers ? $covers : array();

        $no_of_option = sizeof($open_close);


        $option_array = array();

        if($open_close)
        {
            foreach ($open_close as $key => $value) 
            {
                $option_value_array['open_close'] = $value; 
                $option_value_array['lock'] = $lock[$key]; 
                $option_value_array['screws'] = $screws[$key];
                $option_value_array['int_caulking'] = $int_caulking[$key];
                $option_value_array['stickers'] =$stickers[$key];
                $option_value_array['ext_caulking'] = $ext_caulking[$key];
                $option_value_array['screens'] = $screens[$key];
                $option_value_array['covers'] = $covers[$key];
                $option_array[] = $option_value_array;
            }
        }
        else
        {
           $option_array = json_decode($check_list_data->task_chek_data); 
           $option_array = json_decode(json_encode($option_array), true);
           $no_of_option = sizeof($option_array);
        }

        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {

            $check_list_content = array();

            $check_list_content['client_name'] = $this->input->post('client_name',TRUE);
            $check_list_content['date'] = $this->input->post('date',TRUE);
            $check_list_content['city'] = $this->input->post('city',TRUE);
            $check_list_content['state'] = $this->input->post('state',TRUE);
            $check_list_content['zip'] = $this->input->post('zip',TRUE);
            $check_list_content['address'] = $this->input->post('address',TRUE);
            $check_list_content['contact_no'] = $this->input->post('contact_no',TRUE);
            $check_list_content['email'] = $this->input->post('email',TRUE);
            $check_list_content['manufacturer_1'] = $this->input->post('manufacturer_1',TRUE);
            $check_list_content['po_1'] = $this->input->post('po_1',TRUE);
            $check_list_content['manufacturer_2'] = $this->input->post('manufacturer_2',TRUE);
            $check_list_content['po_2'] = $this->input->post('po_2',TRUE);
            $check_list_content['pr_notes'] = $this->input->post('pr_notes',TRUE);
            $check_list_content['project_manager'] = $this->input->post('project_manager',TRUE);
            $check_list_content['sign_client_name'] = $this->input->post('sign_client_name',TRUE);
            $check_list_content['task_chek_data'] = json_encode($option_array);
            $check_list_content['updated'] =  date('Y-m-d H:i:s');
            // P($check_list_content);
            $check_list_detail = $this->tasks_model->update_check_list($check_list_content,$check_list_id);

            if($check_list_detail)
            {                
                 set_alert('success', 'Check List Data Update Successfully');
            }
            else
            {
                 set_alert('warning', 'Check List Data Update Error');
            }
             redirect(base_url('admin/tasks'));
        }
        $data['title'] = _l('Check List');
        $data['no_of_option'] = $no_of_option;
        $data['option_array'] = $option_array;
        $data['check_list_data'] = $check_list_data;
        $data['check_list_id'] = $check_list_id;
        $data['bodyclass']     = 'check-list';
        $this->load->view('admin/tasks/check_list', $data);    
    }


    public function custom_task()
    {
        close_setup_menu();
        $staff_id = get_staff_user_id();
        $data['title'] = _l('Custom Task List');
        $data['custom_task_id'] = NULL;
        $data['bodyclass']     = 'custom_task';
        $this->load->view('admin/tasks/custom_task_list', $data);    
    }



    public function custom_task_table()
    {
        $this->app->get_table_data('tblcustomtask'); 
    }




    public function add_custom_task()
    {
        close_setup_menu();
        $staff_id = get_staff_user_id();

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('role_id', 'User Role', 'required|trim|numeric');
        $this->form_validation->set_rules('parent_task_id', 'parent Task', 'trim|numeric');
        $this->form_validation->set_rules('task_step_id', 'Task Step', 'required|trim|numeric');
        $this->form_validation->set_rules('staff_mail_templet', 'Staff Mail Templet', 'trim|numeric');
        $this->form_validation->set_rules('client_mail_templet', 'Client Mail Templet', 'trim|numeric');
        $this->form_validation->set_rules('input_type', 'Input Type', 'trim');
        $this->form_validation->set_rules('dropdown_options', 'Dropdown Options', 'trim');
        $this->form_validation->set_rules('input_type_label', 'Input Type Label', 'trim');
        $this->form_validation->set_rules('input_type_help_text', 'Input Type Help Text', 'trim');
        
        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {
            $custom_task = array();

            $custom_task['title'] = $this->input->post('title',TRUE);
            $custom_task['role_id'] = $this->input->post('role_id',TRUE);
            $custom_task['parent_task_id'] = $this->input->post('parent_task_id',TRUE);
            $custom_task['task_step_id'] = $this->input->post('task_step_id',TRUE);
            $custom_task['staff_mail_templet'] = $this->input->post('staff_mail_templet',TRUE);
            $custom_task['client_mail_templet'] = $this->input->post('client_mail_templet',TRUE);
            $custom_task['input_type'] = $this->input->post('input_type',TRUE);
            $custom_task['dropdown_options'] = $this->input->post('dropdown_options',TRUE);
            $custom_task['input_type_label'] = $this->input->post('input_type_label',TRUE);
            $custom_task['input_type_help_text'] = $this->input->post('input_type_help_text',TRUE);

            $check_list_detail = $this->tasks_model->insert_custom_task($custom_task);

            if($check_list_detail)
            {                
                 set_alert('success', 'Custom Task Inserted Successfully');
            }
            else
            {
                 set_alert('warning', 'Custom Task Insert Error');
            }
             redirect(base_url('admin/tasks/custom_task'));            
        }

        $all_role_array = $this->Tasks_model->all_role_array(); 
        $all_custom_task_array  = $this->Tasks_model->custom_task_array(); 
        $all_task_step_array =  $this->Tasks_model->task_step_array(); 
        $all_task_mail_templets = $this->Tasks_model->task_mail_templets(); 
        
        $data['all_role_array'] = $all_role_array;
        $data['all_custom_task_array'] = $all_custom_task_array;
        $data['all_task_step_array'] = $all_task_step_array;
        $data['all_task_mail_templets'] = $all_task_mail_templets;
        $data['title'] = _l('Custom Task List');
        $data['custom_task_id'] = NULL;
        $data['bodyclass']     = 'custom_task';
        $this->load->view('admin/tasks/custom_task', $data);    
    }

    public function update_custom_task($custom_task_id = NULL)
    {
        close_setup_menu();
        $staff_id = get_staff_user_id();

        $custom_task_data_array = $this->db->where('id',$custom_task_id)->get('tblcustomtask')->row();
        if(empty($custom_task_data_array))
        {
            set_alert('warning', 'Invalid Custom Task Id !');
            return redirect(base_url('admin/tasks/custom_task'));
        }

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('role_id', 'User Role', 'required|trim|numeric');
        $this->form_validation->set_rules('parent_task_id', 'parent Task', 'trim|numeric');
        $this->form_validation->set_rules('task_step_id', 'Task Step', 'required|trim|numeric');
        $this->form_validation->set_rules('staff_mail_templet', 'Staff Mail Templet', 'trim|numeric');
        $this->form_validation->set_rules('client_mail_templet', 'Client Mail Templet', 'trim|numeric');
        $this->form_validation->set_rules('input_type', 'Input Type', 'trim');
        $this->form_validation->set_rules('dropdown_options', 'Dropdown Options', 'trim');
        $this->form_validation->set_rules('input_type_label', 'Input Type Label', 'trim');
        $this->form_validation->set_rules('input_type_help_text', 'Input Type Help Text', 'trim');

        if ($this->form_validation->run() == false) 
        {
            $this->form_validation->error_array();
        } 
        else 
        {
            $custom_task = array();

            $custom_task['title'] = $this->input->post('title',TRUE);
            $custom_task['role_id'] = $this->input->post('role_id',TRUE);
            $custom_task['parent_task_id'] = $this->input->post('parent_task_id',TRUE);
            $custom_task['task_step_id'] = $this->input->post('task_step_id',TRUE);
            $custom_task['staff_mail_templet'] = $this->input->post('staff_mail_templet',TRUE);
            $custom_task['client_mail_templet'] = $this->input->post('client_mail_templet',TRUE);
            $custom_task['input_type'] = $this->input->post('input_type',TRUE);
            $custom_task['dropdown_options'] = $this->input->post('dropdown_options',TRUE);
            $custom_task['input_type_label'] = $this->input->post('input_type_label',TRUE);
            $custom_task['input_type_help_text'] = $this->input->post('input_type_help_text',TRUE);

            $status = $this->tasks_model->update_custom_task_data($custom_task, $custom_task_id);

            if($status)
            {                
                 set_alert('success', 'Custom Task Update Successfully');
            }
            else
            {
                 set_alert('warning', 'Custom Task Update Error');
            }

            redirect(base_url('admin/tasks/custom_task'));            
        }

        $all_role_array = $this->Tasks_model->all_role_array(); 
        $all_custom_task_array  = $this->Tasks_model->custom_task_array(); 
        $all_task_step_array =  $this->Tasks_model->task_step_array(); 
        $all_task_mail_templets = $this->Tasks_model->task_mail_templets(); 
        
        $data['all_role_array'] = $all_role_array;
        $data['all_custom_task_array'] = $all_custom_task_array;
        $data['all_task_step_array'] = $all_task_step_array;
        $data['all_task_mail_templets'] = $all_task_mail_templets;
        $data['custom_task_data_array'] = $custom_task_data_array;
        $data['title'] = _l('Custom Task List');
        $data['custom_task_id'] = $custom_task_id;
        $data['bodyclass']     = 'custom_task';
        $this->load->view('admin/tasks/custom_task', $data);    
    }


    private function task_progress_OLD($id, $task_step_slug ='welcome')
    {
        if ($this->projects_model->is_member($id) || has_permission('projects', '', 'view')) 
        {
            close_setup_menu();
            $project = $this->projects_model->get($id);
            $task_steps = $this->tasks_model->get_task_step_by_slug($task_step_slug);
            if (!$project) 
            {
                blank_page(_l('project_not_found'));
            }
            if (!$task_steps) 
            {
                blank_page(_l('Tast Step Not Found'));
            }

            $data['task_step_slug']  = $task_step_slug;
            $data['task_step_name']  = $task_steps->title;
            $data['project_id']  = $id;
            $data['project']  = $project;
            $data['title']          = $data['project']->name;
            $data['project_status'] = get_project_status_by_id($project->status);
            $clientid = $project->clientid;
            
            $client_db_data = $this->db->select('tblclients.*,tblcontacts.firstname,tblcontacts.lastname,tblcontacts.email')->where('tblclients.userid',$clientid)->join('tblcontacts','tblcontacts.userid = tblclients.userid', 'left')->get('tblclients')->row();

            $data['client_db_data'] = $client_db_data;

            $data['project_task_steps'] = $this->projects_model->get_progress_step($id,$task_step_slug);
            $this->load->view('admin/projects/task_progress', $data);

        } 
        else 
        {
            access_denied('Project View');
        }
    }



    public function task_progress($id, $task_step_slug ='welcome')
    {
        // return $this->load->view('admin/estimates/attachmentsecond', '');

        if ($this->projects_model->is_member($id) || has_permission('projects', '', 'view')) 
        {
            close_setup_menu();
            $project = $this->projects_model->get($id);
            $task_steps = $this->tasks_model->get_task_step_by_slug($task_step_slug);
            if (!$project) 
            {
                blank_page(_l('project_not_found'));
            }
            if (!$task_steps) 
            {
                blank_page(_l('Tast Step Not Found'));
            }

            $data['task_step_slug']  = $task_step_slug;
            $data['task_step_name']  = $task_steps->title;
            $data['project_id']  = $id;
            $data['project']  = $project;
            $data['title']          = $data['project']->name;
            $data['project_status'] = get_project_status_by_id($project->status);
            $clientid = $project->clientid;
            
            $client_db_data = $this->db->select('tblclients.*,tblcontacts.firstname,tblcontacts.lastname,tblcontacts.email')->where('tblclients.userid',$clientid)->join('tblcontacts','tblcontacts.userid = tblclients.userid', 'left')->get('tblclients')->row();

            $data['client_db_data'] = $client_db_data;

            //$data['project_task_steps'] = $this->projects_model->get_progress_step($id,$task_step_slug);

            $data['welcome'] = $this->projects_model->get_progress_step($id,'welcome');
            $data['permit'] = $this->projects_model->get_progress_step($id,'permit');
            $data['order_processing'] = $this->projects_model->get_progress_step($id,'order_processing');
            $data['city_approved'] = $this->projects_model->get_progress_step($id,'city_approved');
            $data['order_arrived'] = $this->projects_model->get_progress_step($id,'order_arrived');
            $data['order_completed'] = $this->projects_model->get_progress_step($id,'order_completed');

            $this->load->view('admin/projects/task_progress_page', $data);

        } 
        else 
        {
            access_denied('Project View');
        }
    }



    public function load_task_progress_fields($task_id, $task_step_slug)
    {
        $post_task_id = $this->input->post('task_id') ? $this->input->post('task_id') : NULL ;
        $project_id = $this->input->post('project_id') ? $this->input->post('project_id') : NULL ;
        $action_update = $this->input->post('task_action') ? $this->input->post('task_action') : NULL ;
        if(empty($post_task_id))
        {
            $response['status'] = 'error';
            $response['msg'] = 'Invalid Request From Server';
            $response['data'] = '';
            echo json_encode($response);
            exit;
        }
        
        $custom_task_data = $this->db->select('tblstafftasks.*, ,(select input_type from tblcustomtask where tblstafftasks.custom_task_id = tblcustomtask.id) as input_type,(select input_type_label from tblcustomtask where tblstafftasks.custom_task_id = tblcustomtask.id) as input_type_label,(select input_type_help_text from tblcustomtask where tblstafftasks.custom_task_id = tblcustomtask.id) as input_type_help_text,(select dropdown_options from tblcustomtask where tblstafftasks.custom_task_id = tblcustomtask.id) as dropdown_options,(select role_id from tblcustomtask where tblstafftasks.custom_task_id = tblcustomtask.id) as role_id')->where('id',$post_task_id)->get('tblstafftasks')->row();

        if(empty($custom_task_data))
        {
            $response['status'] = 'error';
            $response['msg'] = 'Invalid Task Id';
            $response['data'] = '';
            echo json_encode($response);
            exit;
        }

        $staff_id = get_staff_user_id();
        $role_id = staff_role($staff_id);


        if($custom_task_data->role_id != $role_id && is_admin(get_staff_user_id()) != 1)
        {
            set_alert('warning', _l('Action Not Permitted.! '));
            $response['status'] = 'error';
            $response['msg'] = 'Action Not Permitted';
            $response['data'] = '';
            echo json_encode($response);
            exit;
        }

        $data['task_step_slug'] =  $task_step_slug;
        $data['custom_task_data'] =  $custom_task_data;
        $data['task_id'] =  $task_id;
        $data['task_id'] =  $task_id;
        $data['project_id'] =  $project_id;
        $data['action_update'] =  $action_update;
       

        $response['status'] = 'success';
        $response['msg']    = 'success';
        $response['data']   = $this->load->view('admin/projects/task_progress_fields', $data, true);
        echo json_encode($response);
        exit;

    }





    public function task_progress_action($project_id, $task_step_slug)
    {
        if($this->input->post('project_id') && $this->input->post('task_id'))
        {
            $task_id = $this->input->post('task_id');
            $project_id = $this->input->post('project_id');
            $task_db_data =   $this->db->where('id',$task_id)->get('tblstafftasks')->row();

            if(empty($task_db_data))
            {
                set_alert('warning', _l('Sorry something went wrong .....! '));
                return redirect(admin_url('tasks/task_progress/').$project_id.'/'.$task_step_slug);
            }


            if($this->input->post('save'))
            {
                if($this->input->post('save') == 'Update')
                {
                    $this->delete_all_child_task($project_id, $task_db_data->custom_task_id);
                }

                $save = 'save';
            }
            elseif ($this->input->post('save_and_complete')) 
            {
                if($this->input->post('save_and_complete') == 'Update And Complete')
                {
                    $this->delete_all_child_task($project_id, $task_db_data->custom_task_id);
                }

                $save = 'save_and_complete';
            }
            else
            {
                set_alert('warning', _l('something went wrong ...! '));
                return redirect(admin_url('tasks/task_progress/').$project_id.'/'.$task_step_slug);
            }

            $task_data =   $this->db->where('id',$task_id)->where('custom_input_value',NULL)->get('tblstafftasks')->row();
            
            if(empty($task_data))
            {
                set_alert('warning', _l('Sorry Task Action Is Already Done .....! '));
                return redirect(admin_url('tasks/task_progress/').$project_id.'/'.$task_step_slug);
            }

            $content = array();
            
            if($this->input->post('yes_no'))
            {
                $content['custom_input_value'] = $this->input->post('yes_no');
            }

            if($this->input->post('dropdown'))
            {
                $content['custom_input_value'] = $this->input->post('dropdown');
            }
            
            if($this->input->post('textarea'))
            {
                $content['custom_input_value'] = $this->input->post('textarea');
            }


            if($this->input->post('is_hoa'))
            {   
                $is_hoa_array = array();
                $is_hoa = $this->input->post('is_hoa');

                if($is_hoa == 'YES')
                {
                    $contact_name = $this->input->post('contact_name');
                    $contact_email = $this->input->post('contact_email');
                    $contact_number = $this->input->post('contact_number');
                    $approval_latter = NULL;

                    if(empty($contact_name) OR empty($contact_email) OR empty($contact_number) )
                    {
                        set_alert('warning', _l('Plz Fill All Required Field First.....! '));
                        return redirect(admin_url('tasks/task_progress/').$project_id.'/'.$task_step_slug);
                    }
                   
                    if (isset($_FILES['approval_latter']['name']))
                    {
                        $uploadedFiles = handle_task_attachments_array($task_id,'approval_latter');
                        if ($uploadedFiles && is_array($uploadedFiles)) 
                        {
                            foreach ($uploadedFiles as $file) 
                            {
                                $approval_latter = $file['file_name'];  
                            }
                        }
                    }
                    if(empty($approval_latter))
                    {
                        set_alert('warning', _l('upload HOA For Approval Form.....! '));
                        return redirect(admin_url('tasks/task_progress/').$project_id.'/'.$task_step_slug);
                    }

                    $is_hoa_array['is_hoa'] = $is_hoa;
                    $is_hoa_array['hoa_details'] = array(
                                                            'is_hoa' => $is_hoa,
                                                            'contact_name' => $contact_name,
                                                            'contact_email' => $contact_email,
                                                            'contact_number' => $contact_number,
                                                            'approval_latter' => $approval_latter,
                                                        );
                    $is_hoa_array['hoa_html'] = $this->set_hoa_html($is_hoa_array['hoa_details'],$task_id);
                    // p("child task must be created now");

                }
                else
                {
                    $is_hoa_array['is_hoa'] = $is_hoa;
                    $is_hoa_array['hoa_html'] =  "<p class='p-3'><i class='fa fa-angle-right mr-3'></i> NO </p>";
                    
                }
                $content['custom_input_value'] = json_encode($is_hoa_array);
            }

            // p("end of if code");

            if (isset($_FILES['file']['name']))
            {
                $uploadedFiles = handle_task_attachments_array($task_id,'file');
                if ($uploadedFiles && is_array($uploadedFiles)) 
                {
                    foreach ($uploadedFiles as $file) 
                    {
                        $content['custom_input_value'] = $file['file_name'];  
                    }
                }

                
            }

            if (isset($_FILES['files']['name']))
            {
                $uploadedFiles = handle_task_attachments_array($task_id,'files');
                if ($uploadedFiles && is_array($uploadedFiles)) 
                {
                    foreach ($uploadedFiles as $file) 
                    {
                        $files[] = $file['file_name'];  
                    }
                    $content['custom_input_value'] = json_encode($files);  
                }
            }
            if($content OR $this->input->post('update_task'))
            {   
                $content['custom_input_value'] = $content['custom_input_value'] ? $content['custom_input_value']: NULL; 
                $content['status'] = 5;
                $this->db->where('id',$task_id)->update('tblstafftasks',$content);
                set_alert('success', _l('Task Status Update Successfully'));
                if($save == 'save_and_complete')
                {
                    $this->tasks_model->mark_as(5, $task_id);
                    $status_of_mail = $this->send_task_status_mail($task_id);
                    $this->create_dependend_task($task_id,$project_id);
                }
            }
            else
            {
                set_alert('warning', _l('Error During Update Status'));
            }          
        }
        else
        {
            set_alert('warning', _l('something went wrong .....! '));
        }

        return redirect(admin_url('tasks/task_progress/').$project_id.'/'.$task_step_slug);
    }


    public function mark_as_complete_task_action($project_id, $task_step_slug)
    {
        $response['url'] = admin_url('tasks/task_progress/').$project_id.'/'.$task_step_slug;
        $response['status'] = 'error'; 


        if($this->input->post('project_id') && $this->input->post('task_id'))
        {
            $task_id = $this->input->post('task_id');
            $task_db_data =   $this->db->where('id',$task_id)->get('tblstafftasks')->row();
            $response['url'] = admin_url('tasks/task_progress/').$project_id."/".$task_step_slug;
            $task_data =   $this->db->where('id',$task_id)->where('custom_input_value',NULL)->get('tblstafftasks')->row();
            $custom_task_data = $this->db->where('id',$task_db_data->custom_task_id)->get('tblcustomtask')->row();
            if($task_data && $custom_task_data->input_type != 'none' && $custom_task_data->input_type)
            {
               
                    set_alert('warning', _l('Sorry Task Do Action First On This Task .....! '));
                    $response['status'] = 'error'; 
                    $response['msg'] = 'Sorry Task Do Action First On This Task .....! '; 
                    echo json_encode($response);
                    exit;

            }

            $staff_id = get_staff_user_id();
            $role_id = staff_role($staff_id);

            if($custom_task_data->role_id != $role_id && is_admin(get_staff_user_id()) != 1)
            {
                set_alert('warning', _l('Action Not Permitted.! '));
                $response['status'] = 'error';
                $response['msg'] = 'Action Not Permitted';
                $response['data'] = '';
                echo json_encode($response);
                exit;
            }





            $content['status'] = 1;
            $this->db->where('id',$task_id)->update('tblstafftasks',$content);
            $success = $this->tasks_model->mark_as(5, $task_id);
            if ($success) 
            {
                $message = _l('task_marked_as_success', format_task_status(5, true, true));
                $status_of_mail = $this->send_task_status_mail($task_id);
                $this->create_dependend_task($task_id,$project_id);
            }

            set_alert('success', _l('Task Status Update Successfully'));
            $response['status'] = 'success'; 
            $response['msg'] = 'Task Status Update Successfully..'; 
        }
        else
        {
            set_alert('warning', _l('something went wrong .....! '));
            $response['status'] = 'error'; 
            $response['msg'] = 'something went wrong .....! '; 
               
        }

        echo json_encode($response);
        exit;
    }


    public function mark_as_incomplete_task_action($project_id, $task_step_slug)
    {
        $response['url'] = admin_url('tasks/task_progress/').$project_id.'/'.$task_step_slug;
        $response['status'] = 'error'; 


        if($this->input->post('project_id') && $this->input->post('task_id'))
        {
            $task_id = $this->input->post('task_id');
            $task_db_data =   $this->db->where('id',$task_id)->get('tblstafftasks')->row();
            $response['url'] = admin_url('tasks/task_progress/').$project_id."/".$task_step_slug;
            $task_data =   $this->db->where('id',$task_id)->where('custom_input_value',NULL)->get('tblstafftasks')->row();
            $custom_task_data = $this->db->where('id',$task_db_data->custom_task_id)->get('tblcustomtask')->row();
            if($task_data && $custom_task_data->input_type != 'none' && $custom_task_data->input_type)
            {
               
                    set_alert('warning', _l('Sorry Task Do Action First On This Task .....! '));
                    $response['status'] = 'error'; 
                    $response['msg'] = 'Sorry Task Do Action First On This Task .....! '; 
                    echo json_encode($response);
                    exit;

            }

            $staff_id = get_staff_user_id();
            $role_id = staff_role($staff_id);

            if($custom_task_data->role_id != $role_id && is_admin(get_staff_user_id()) != 1)
            {
                set_alert('warning', _l('Action Not Permitted.! '));
                $response['status'] = 'error';
                $response['msg'] = 'Action Not Permitted';
                $response['data'] = '';
                echo json_encode($response);
                exit;
            }
            
            $this->delete_all_child_task($project_id, $task_db_data->custom_task_id);
            set_alert('success', _l('Task Status Update Successfully'));
            $response['status'] = 'success'; 
            $response['msg'] = 'Task Status Update Successfully..'; 
        }
        else
        {
            set_alert('warning', _l('something went wrong .....! '));
            $response['status'] = 'error'; 
            $response['msg'] = 'something went wrong .....! '; 
               
        }

        echo json_encode($response);
        exit;
    }

    public function create_dependend_task($task_id, $project_id)
    {
            $db_task_array =  $this->tasks_model->get_tasks_by_task_id($task_id);
            $custom_task_id = $db_task_array['custom_task_id'];
            $parent_custom_task =  $this->db->select('input_type')->where('id',$custom_task_id)->get('tblcustomtask')->row();

            $is_hoa = $parent_custom_task->input_type == 'ci_view' ? json_decode($db_task_array['custom_input_value'])  : NULL;
            $db_task_array['custom_input_value'] = $is_hoa ? $is_hoa->is_hoa : $db_task_array['custom_input_value'];

            $project_data = $this->db->where('id', $project_id)->get('tblprojects')->row();
            $clientid = $project_data->clientid; 

            $custom_task_to_be_assigned = array();

            $relation_custom_task_child  = $this->db->where('parent_task_id',$custom_task_id)->get('custom_task_parent')->result_array();
            $child_task_ids = array_column($relation_custom_task_child,"custom_task_id");
            if(count($child_task_ids))
            {
                $custom_task_to_be_assigned =  $this->db->select('tblcustomtask.id as customtask_id,tblcustomtask.title,tblcustomtask.role_id,(select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name,(select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template,(select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name,(select input_type from tblcustomtask where tblcustomtask.id = '.$custom_task_id.') as input_type,parent_task_value,is_multiple_parent')
                ->where_in('tblcustomtask.id',$child_task_ids)              
                ->get('tblcustomtask')->result_array();
            }

           foreach ($custom_task_to_be_assigned as $key => $task_value_array) 
            {

                if($task_value_array['is_multiple_parent'] == 1)
                {
                    
                    if(isset($task_value_array['customtask_id']) && $task_value_array['customtask_id'] == 9)
                    {
                        $status = $this->create_custom_task_of_nine($db_task_array,$task_value_array,$clientid,$project_id);
                    }
                    else if (isset($task_value_array['customtask_id']) && $task_value_array['customtask_id'] == 11) 
                    {
                       $status = $this->create_custom_task_of_eleven($db_task_array,$task_value_array,$clientid,$project_id);
                    }
                    else if (isset($task_value_array['customtask_id']) && $task_value_array['customtask_id'] == 12) 
                    {
                       $status = $this->create_custom_task_of_twelve($db_task_array,$task_value_array,$clientid,$project_id);
                    }
                    else if (isset($task_value_array['customtask_id']) && $task_value_array['customtask_id'] == 13) 
                    {
                       $status = $this->create_custom_task_of_thirteen($db_task_array,$task_value_array,$clientid,$project_id);
                    }
                    // else if (isset($task_value_array['customtask_id']) && $task_value_array['customtask_id'] == 17) 
                    // {
                    //    $status = $this->create_custom_task_of_seventeen($db_task_array,$task_value_array,$clientid,$project_id);
                    // }
                    else if (isset($task_value_array['customtask_id']) && $task_value_array['customtask_id'] == 21) 
                    {
                       $status = $this->create_custom_task_of_twenty_one($db_task_array,$task_value_array,$clientid,$project_id);
                    }
                    else if (isset($task_value_array['customtask_id']) && $task_value_array['customtask_id'] == 23) 
                    {
                       $status = $this->create_custom_task_of_twenty_three($db_task_array,$task_value_array,$clientid,$project_id);
                    }
                    else if (isset($task_value_array['customtask_id']) && $task_value_array['customtask_id'] == 26) 
                    {
                       $status = $this->create_custom_task_of_twenty_six($db_task_array,$task_value_array,$clientid,$project_id);
                    }
                    else if (isset($task_value_array['customtask_id']) && $task_value_array['customtask_id'] == 28) 
                    {
                       $status = $this->create_custom_task_of_twenty_eight($db_task_array,$task_value_array,$clientid,$project_id);
                    }
                    else
                    {
                        $multiple_parent_task = $this->db->select('custom_task_parent.*,(select input_type from tblcustomtask where tblcustomtask.id = custom_task_parent.custom_task_id)as input_type')->where('custom_task_id',$task_value_array['customtask_id'])->get('custom_task_parent')->result();
                    
                        if(count($multiple_parent_task))
                        {
                            $where = [];
                            foreach ($multiple_parent_task as $custom_task_parent) 
                            {
                                $custom_task_parent->parent_task_value = $custom_task_parent->parent_task_value  ? $custom_task_parent->parent_task_value : '';

                                if($custom_task_parent->input_type == 'none' OR empty($custom_task_parent->input_type))
                                {

                                    $where[] = '(custom_task_id = '.$custom_task_parent->parent_task_id .' AND custom_input_value = "")';
                                }
                                else if($custom_task_parent->input_type == 'file' OR $custom_task_parent->input_type == 'files')
                                {
                                    $where[] = '(custom_task_id = '.$custom_task_parent->parent_task_id .' AND custom_input_value != "")';
                                }
                                else if($custom_task_parent->input_type == 'ci_view')
                                {

                                    $where[] = '(custom_task_id = '.$custom_task_parent->parent_task_id .' AND custom_input_value = "YES")';
                                }
                                else
                                {
                                    $where[] = '(custom_task_id = '.$custom_task_parent->parent_task_id .' AND custom_input_value = "'.$custom_task_parent->parent_task_value.'")';
                                }

                            }

                            $where_new = ' is_complete = 1 AND rel_id = '.$project_id.' AND ('.implode(' OR ', $where).') ';

                            $completed_tasks = $this->db->select('id, name')->from('tblstafftasks')->where($where_new)->get()->num_rows();

                           
                            if(count($multiple_parent_task) == $completed_tasks)
                            {
                                $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
                            }
                        }

                    } 

                }
                else
                {
                    $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
                }

            }
        return true;
    }

    private function insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id)
    {
        if(empty($task_value_array['parent_task_value']) OR strtolower($task_value_array['parent_task_value']) == strtolower($db_task_array['custom_input_value']))
        {

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

        }

        return true;
    }



    public function view_custom_task_value($project_id)
    {

        $response['status'] = 'error'; 
        $response['html'] = ''; 
        $response['msg'] = 'Not allowed .....! '; 

        if($this->input->post('project_id') && $this->input->post('task_id'))
        {
            $task_id = $this->input->post('task_id');
            $task_data =   $this->db->where('id',$task_id)->get('tblstafftasks')->row();
            $status = isset($task_data->status) ? $task_data->status : NULL;

            if(empty($task_data->status))
            {
                $response['status'] = 'error';
                $response['msg'] = 'Task Is Not  Available.. !'; 
                $response['html'] = '';
                echo json_encode($response);
                exit;
            }

            if($task_data->status != 5  && $task_data->is_complete != 1)
            {
                $response['status'] = 'error';
                $response['msg'] = 'Sorry Task Do Action First On This Task .....!'; 
                $response['html'] = '';
                echo json_encode($response);
                exit;
            }

            $custom_task_id = $task_data->custom_task_id;
            $task_custom_input_value = $task_data->custom_input_value;
            $custom_task_array =  $this->db->select('tblcustomtask.*,(select custom_input_value from tblstafftasks where tblstafftasks.custom_task_id = tblcustomtask.id AND tblstafftasks.id = '.$task_id.' LIMIT 1) as custom_input_value')
                ->where('id',$custom_task_id)
                ->get('tblcustomtask')->row();           
            $response['title'] = $custom_task_array->title;
            $html = '';
            if($custom_task_array->input_type == 'yes_no' OR $custom_task_array->input_type == 'dropdown' OR $custom_task_array->input_type == 'textarea' && $task_custom_input_value)
            {
                $html = "<p class='p-3'><i class='fa fa-angle-right mr-3'></i> $custom_task_array->custom_input_value </p>";
                $response['status'] = 'success'; 
            }
            else if($custom_task_array->input_type == 'file' && $task_custom_input_value)
            {
                $custom_input_value = $custom_task_array->custom_input_value;
                $src = base_url("uploads/tasks/$task_id/").$custom_input_value;
                $html = '<a href="'.$src.'" target="_blank">Download </a>';
                $response['status'] = 'success'; 
            }            
            else if($custom_task_array->input_type == 'files' && $task_custom_input_value)
            {

                $custom_input_value = $custom_task_array->custom_input_value;
                $custom_input_array = json_decode($custom_input_value);
                foreach ($custom_input_array as $key => $iamge) 
                {
                    $src = base_url("uploads/tasks/$task_id/").$iamge;
                    $html = '<a href="'.$src.'" target="_blank">Download </a><br>'; 
                }

                $response['status'] = 'success';                
            }
            else if($custom_task_array->input_type == 'ci_view' && $task_custom_input_value)
            {

                $custom_input_value = $custom_task_array->custom_input_value;
                $custom_input_array = json_decode($custom_input_value);
                $html = $custom_input_array->hoa_html; 
                $response['status'] = 'success';                
            }
            else if(empty($task_custom_input_value) && $custom_task_array->input_type == 'none' OR empty($custom_task_array->input_type))
            {
                $response['status'] = 'success';
                $response['msg'] = 'No Dependend Task On This Task';
                $html = "<p class='p-3'><i class='fa fa-angle-right mr-3'></i> None </p>";
            }
            else
            {
                $response['status'] = 'error';
                $response['msg'] = 'some Thing Went Wrong';
                $html = '';
            }

            $response['html'] = $html;
        }
        else
        {
            $response['status'] = 'error'; 
            $response['msg'] = 'something went wrong .....! '; 
            $response['html'] = '';        
        }

        echo json_encode($response);
        exit;

    }   


    private function set_hoa_html($hoa_detail_array,$task_id)
    {
        $src = base_url("uploads/tasks/$task_id/").$hoa_detail_array['approval_latter'];
        $html = "<p class='p-2'><i class='fa fa-angle-right mr-3'></i> Is Hoa  :  YES </p> </br>";
        $html .= "<p class='p-2'><i class='fa fa-angle-right mr-3'></i> Hoa Contact Name  :  ".$hoa_detail_array['contact_name'] ."</p></br>";
        $html .= "<p class='p-2'><i class='fa fa-angle-right mr-3'></i> Hoa Contact Email  : ". $hoa_detail_array['contact_email'] ."</p></br>";
        $html .= "<p class='p-2'><i class='fa fa-angle-right mr-3'></i> Hoa Contact Number  : ". $hoa_detail_array['contact_number'] ."</p></br>";
        $html .= "<p class='p-2'><i class='fa fa-angle-right mr-3'></i> :  <a href='".$src."' target='_blank'>Download </a>  </p></br>";

       return $html;
    }


    var $return_ids = [];
    private function delete_all_child_task($project_id, $custom_task_id)
    {
        // $this->return_ids[] = $custom_task_id;
        $chid_task_ids = $this->myRecursiveFunction(array($custom_task_id));
        if($this->return_ids)
        {
            $this->db->where_in('custom_task_id',$this->return_ids)->where('rel_id',$project_id)->delete('tblstafftasks');
        }
        $data['is_complete'] = NULL;
        $data['status'] = '1';
        $data['custom_input_value'] = NULL;
        $data['datefinished'] = NULL;
        $this->db->where('custom_task_id',$custom_task_id)->where('rel_id',$project_id)->update('tblstafftasks',$data);
        return TRUE;
    }



    private function myRecursiveFunction($parent_id=[]) 
    {

        $child_ids = $this->db->select('custom_task_id as id')->where_in('parent_task_id', $parent_id)->get('custom_task_parent')->result();


        if(count($child_ids)) {

            foreach ($child_ids as $key => $value) 
            {
                $current_ids[] = $this->return_ids[] = $value->id;
            }

            // continue the recursion
            $this->myRecursiveFunction($current_ids);

        } else {
            // end the recursion
            return $this->return_ids;            
        }        

    }


    private function all_child_task($custom_task_id)
    {
        $this->myRecursiveFunction(array($custom_task_id));
        p($this->return_ids);
       
    }

    private function create_custom_task_of_nine($db_task_array,$task_value_array,$clientid,$project_id)
    {
        $custom_task_to_be_create = 9;
        $parent_custom_task_ids = [12,6,27];

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',4)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1  OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }
        else if(strtolower($parent_staff_task->custom_input_value)=='yes')
        {

            $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',6)->get('tblstafftasks')->row();

            if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
            {
                return false;
            }

            $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',27)->get('tblstafftasks')->row();

            if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
            {
                return false;
            }
        }

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',12)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1 OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }

        $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
        return true;
    }

    private function create_custom_task_of_eleven($db_task_array,$task_value_array,$clientid,$project_id)
    {
        $custom_task_to_be_create = 11;
        $parent_custom_task_ids = [10,16,17,20,27]; //[10,[16||17],20,27]

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',10)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
        {
            return false;
        }

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',1)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1 OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }
        else
        {
            $is_hoa_array = json_decode($parent_staff_task->custom_input_value);
            $is_hoa = $is_hoa_array->is_hoa;

            if(strtolower($parent_staff_task->custom_input_value)=='yes')
            {

                $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',20)->get('tblstafftasks')->row();
                if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
                {
                    return false;
                }
            }
        }


        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',4)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1  OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }
        else if(strtolower($parent_staff_task->custom_input_value)=='yes')
        {

            $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',27)->get('tblstafftasks')->row();

            if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
            {
                return false;
            }
        }


        $parent_staff_task = $this->db->where('rel_id', $project_id)->where_in('custom_task_id',[16,17])->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
        {
            return false;
        }

        $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
        return true;
    }


    
    private function create_custom_task_of_twelve($db_task_array,$task_value_array,$clientid,$project_id)
    {
        $custom_task_to_be_create = 12;
        $parent_custom_task_ids = [16,17]; //[16||17]

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where_in('custom_task_id',[16,17])->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
        {
            return false;
        }

        $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
        return true;
    }

    private function create_custom_task_of_thirteen($db_task_array,$task_value_array,$clientid,$project_id)
    {
        $custom_task_to_be_create = 13;
        $parent_custom_task_ids = [8,12,6,27];


        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',8)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1  OR strtolower($parent_staff_task->custom_input_value) != 'yes')
        {
            return false;
        }

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',4)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1  OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }
        else if(strtolower($parent_staff_task->custom_input_value)=='yes')
        {

            $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',6)->get('tblstafftasks')->row();

            if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
            {
                return false;
            }

            $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',27)->get('tblstafftasks')->row();

            if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
            {
                return false;
            }
        }

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',12)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1 OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }

        $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
        return true;
    }



    private function create_custom_task_of_seventeen($db_task_array,$task_value_array,$clientid,$project_id)
    {
        $custom_task_to_be_create = 17;
        $parent_custom_task_ids = [2,20];


        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',2)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1  OR strtolower($parent_staff_task->custom_input_value) != 'ygrene')
        {
            return false;
        }

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',1)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1 OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }
        else
        {
            $is_hoa_array = json_decode($parent_staff_task->custom_input_value);
            $is_hoa = $is_hoa_array->is_hoa;

            if(strtolower($parent_staff_task->custom_input_value)=='yes')
            {

                $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',20)->get('tblstafftasks')->row();
                if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
                {
                    return false;
                }
            }
        }

        $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
        return true;

    }


    private function create_custom_task_of_twenty_one($db_task_array,$task_value_array,$clientid,$project_id)
    {
        $custom_task_to_be_create = 21;
        $parent_custom_task_ids = [16,19];


        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',16)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
        {
            return false;
        }


        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',19)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1 OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }

        $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
        return true;

    }


    private function create_custom_task_of_twenty_three($db_task_array,$task_value_array,$clientid,$project_id)
    {
        $custom_task_to_be_create = 23;
        $parent_custom_task_ids = [17,19];


        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',17)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
        {
            return false;
        }


        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',19)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1 OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }

        $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
        return true;

    }


    private function create_custom_task_of_twenty_six($db_task_array,$task_value_array,$clientid,$project_id)
    {
        $custom_task_to_be_create = 26;
        $parent_custom_task_ids = [25,6,20];


        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',25)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
        {
            return false;
        }

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',4)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1  OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }
        else if(strtolower($parent_staff_task->custom_input_value)=='yes')
        {

            $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',6)->get('tblstafftasks')->row();

            if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
            {
                return false;
            }
        }

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',1)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1 OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }
        else
        {
            $is_hoa_array = json_decode($parent_staff_task->custom_input_value);
            $is_hoa = $is_hoa_array->is_hoa;

            if(strtolower($parent_staff_task->custom_input_value)=='yes')
            {

                $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',20)->get('tblstafftasks')->row();
                if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
                {
                    return false;
                }
            }
        }



        $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
        return true;

    }

    private function create_custom_task_of_twenty_eight($db_task_array,$task_value_array,$clientid,$project_id)
    {
        $custom_task_to_be_create = 28;
        $parent_custom_task_ids = [27,31];



        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',31)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
        {
            return false;
        }

        $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',4)->get('tblstafftasks')->row();

        if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1  OR empty($parent_staff_task->custom_input_value))
        {
            return false;
        }
        else if(strtolower($parent_staff_task->custom_input_value)=='yes')
        {

            $parent_staff_task = $this->db->where('rel_id', $project_id)->where('custom_task_id',27)->get('tblstafftasks')->row();

            if(empty($parent_staff_task) OR $parent_staff_task->is_complete != 1)
            {
                return false;
            }
        }

        $this->insert_to_db_child_task($task_value_array,$db_task_array,$clientid,$project_id);
        return true;

    }


}
