 <?php

   $table_data = array();
   $_table_data = array(
     _l('No'),
    _l('Name'),
    _l('Task Step'),
    _l('Role'),
    _l('Parent Task'),
    _l('Action'),
    );

   foreach($_table_data as $_t){
    array_push($table_data,$_t);
}

$custom_fields = get_custom_fields('tblcustomtask',array('show_on_table'=>1));
foreach($custom_fields as $field){
    array_push($table_data,$field['name']);
}

$table_data = do_action('tblcustomtask',$table_data);

render_datatable($table_data,'tblcustomtask',[],[
         'data-last-order-identifier' => 'tblcustomtask',
         'data-default-order'         => get_table_last_order('tblcustomtask'),
]);
?>
