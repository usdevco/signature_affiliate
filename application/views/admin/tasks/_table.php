<?php

 $staff_role = staff_role(get_staff_user_id());

if($staff_role == 2)
{
    $table_data = [
        _l('tasks_dt_name'),
        _l('task_status'),
        _l('tasks_dt_datestart'),
        [
            'name'     => _l('task_duedate'),
            'th_attrs' => ['class' => 'duedate'],
        ],
        _l('task_assigned'),
        _l('tags'),
        _l('tasks_list_priority'),
        _l('Hoa Details'),
    ];
}
else
{
    $table_data = [
    _l('tasks_dt_name'),
    _l('task_status'),
    _l('tasks_dt_datestart'),
    [
        'name'     => _l('task_duedate'),
        'th_attrs' => ['class' => 'duedate'],
    ],
    _l('task_assigned'),
    _l('tags'),
    _l('tasks_list_priority'),
];
}

array_unshift($table_data, [
    'name'     => '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="tasks"><label></label></div>',
    'th_attrs' => ['class' => (isset($bulk_actions) ? '' : 'not_visible')],
]);

$custom_fields = get_custom_fields('tasks', [
    'show_on_table' => 1,
]);
foreach ($custom_fields as $field) {
    array_push($table_data, $field['name']);
}

$table_data = do_action(
    'tasks_table_columns',
    $table_data
);

render_datatable($table_data, 'tasks', [], [
        'data-last-order-identifier' => 'tasks',
        'data-default-order'         => get_table_last_order('tasks'),
]);
