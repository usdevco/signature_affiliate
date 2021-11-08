<?php

defined('BASEPATH') or exit('No direct script access allowed');

$hasPermissionEdit   = has_permission('tasks', '', 'edit');
$hasPermissionDelete = has_permission('tasks', '', 'delete');

$aColumns = [
    '1', // bulk actions
    'title',
    'task_step_id',
    'role_id',
    'parent_task_id',
    'id', 
];

$sIndexColumn = 'id';
$sTable       = 'tblcustomtask';

$where = [];
$join  = [];

$custom_fields = get_table_custom_fields('tblcustomtask');

foreach ($custom_fields as $key => $field) {
    $selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
    array_push($customFieldsColumns, $selectAs);
    array_push($aColumns, '(SELECT value FROM tblcustomfieldsvalues WHERE tblcustomfieldsvalues.relid=tblstafftasks.id AND tblcustomfieldsvalues.fieldid=' . $field['id'] . ' AND tblcustomfieldsvalues.fieldto="' . $field['fieldto'] . '" LIMIT 1) as ' . $selectAs);
}

$aColumns = do_action('tblcustomtask', $aColumns);

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}

$result = data_tables_init(
    $aColumns,
    $sIndexColumn,
    $sTable,
    $join,
    $where,
    ['id','title','(SELECT name from tblroles where tblroles.roleid=tblcustomtask.role_id) as role_name','(SELECT title from tbltaskstep where tbltaskstep.id=tblcustomtask.task_step_id) as step_title','(SELECT title from tblcustomtask where tblcustomtask.id = tblcustomtask.parent_task_id) as parent_task_name']
);



$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $key => $aRow) 
{
    $i = $key + 1;
    $row = [];

    $row[] = $i;

    $row[] = $aRow['title'];
    $row[] = $aRow['step_title'];
    $row[] = $aRow['role_name'];
    $row[] = $aRow['parent_task_id'] > 0 ? $aRow['parent_task_id'] : '-' ;

    $row[] = '<a href="'.base_url("admin/tasks/update_custom_task/").$aRow["id"].'" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i> </a>';

    $output['aaData'][] = $row;
}
