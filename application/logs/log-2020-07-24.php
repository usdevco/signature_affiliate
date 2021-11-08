<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-07-24 02:28:22 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 02:41:32 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 02:41:38 --> Could not find the language line "Hoa Details For Tasks Page"
ERROR - 2020-07-24 02:41:48 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 02:41:53 --> Could not find the language line "Hoa Details For Tasks Page"
ERROR - 2020-07-24 02:45:43 --> Could not find the language line "lead_add_edit_contected_today"
ERROR - 2020-07-24 02:47:30 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 220
ERROR - 2020-07-24 02:47:31 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 220
ERROR - 2020-07-24 02:49:25 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 220
ERROR - 2020-07-24 02:49:25 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 220
ERROR - 2020-07-24 02:52:40 --> Could not find the language line "Hoa Details For Tasks Page"
ERROR - 2020-07-24 03:00:25 --> Could not find the language line "Hoa Details For Tasks Page"
ERROR - 2020-07-24 03:07:18 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 03:07:27 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 03:12:00 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 03:12:02 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-07-24 03:12:02 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, name, status, startdate, duedate, (SELECT GROUP_CONCAT(CONCAT(firstname, ' ', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblstafftasks.id and rel_type="task" ORDER by tag_order ASC) as tags, priority ,tblstafftasks.id,rel_type,rel_id,(CASE rel_type
        WHEN "contract" THEN (SELECT subject FROM tblcontracts WHERE tblcontracts.id = tblstafftasks.rel_id)
        WHEN "estimate" THEN (SELECT id FROM tblestimates WHERE tblestimates.id = tblstafftasks.rel_id)
        WHEN "proposal" THEN (SELECT id FROM tblproposals WHERE tblproposals.id = tblstafftasks.rel_id)
        WHEN "invoice" THEN (SELECT id FROM tblinvoices WHERE tblinvoices.id = tblstafftasks.rel_id)
        WHEN "ticket" THEN (SELECT CONCAT(CONCAT("#",tbltickets.ticketid), " - ", tbltickets.subject) FROM tbltickets WHERE tbltickets.ticketid=tblstafftasks.rel_id)
        WHEN "lead" THEN (SELECT CASE tblleads.email WHEN "" THEN tblleads.name ELSE CONCAT(tblleads.name, " - ", tblleads.email) END FROM tblleads WHERE tblleads.id=tblstafftasks.rel_id)
        WHEN "customer" THEN (SELECT CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END FROM tblclients WHERE tblclients.userid=tblstafftasks.rel_id)
        WHEN "project" THEN (SELECT CONCAT(CONCAT(CONCAT("#",tblprojects.id)," - ",tblprojects.name), " - ", (SELECT CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END FROM tblclients WHERE userid=tblprojects.clientid)) FROM tblprojects WHERE tblprojects.id=tblstafftasks.rel_id)
        WHEN "expense" THEN (SELECT CASE expense_name WHEN "" THEN tblexpensescategories.name ELSE
         CONCAT(tblexpensescategories.name, ' (',tblexpenses.expense_name,')') END FROM tblexpenses JOIN tblexpensescategories ON tblexpensescategories.id = tblexpenses.category WHERE tblexpenses.id=tblstafftasks.rel_id)
        ELSE NULL
        END) as rel_name,billed,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=35) as is_assigned,(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids,(SELECT MAX(id) FROM tbltaskstimers WHERE task_id=tblstafftasks.id and staff_id=35 and end_time IS NULL) as not_finished_timer_by_current_staff,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=35) as current_user_is_assigned,(SELECT CASE WHEN addedfrom=35 AND is_added_from_contact=0 THEN 1 ELSE 0 END) as current_user_is_creator,(SELECT id FROM tbl_task_hoa_details WHERE task_id=tblstafftasks.id AND staff_id=35) as tbl_task_hoa_id,(SELECT mail_template FROM tblstafftasks WHERE id=tblstafftasks.id ) as mail_template
    FROM tblstafftasks
    
    
    WHERE  ( status IN (1, 4, 3, 2)) AND CASE WHEN rel_type="project" AND rel_id IN (SELECT project_id FROM tblprojectsettings WHERE project_id=rel_id AND name="hide_tasks_on_main_tasks_table" AND value=1) THEN rel_type != "project" ELSE 1=1 END
    
    ORDER BY duedate IS NULL ASC, duedate ASC
    LIMIT 0, 25
    
ERROR - 2020-07-24 03:13:10 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 03:13:13 --> Query error: Unknown column 'staff_id' in 'where clause' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, name, status, startdate, duedate, (SELECT GROUP_CONCAT(CONCAT(firstname, ' ', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblstafftasks.id and rel_type="task" ORDER by tag_order ASC) as tags, priority ,tblstafftasks.id,rel_type,rel_id,mail_template,(CASE rel_type
        WHEN "contract" THEN (SELECT subject FROM tblcontracts WHERE tblcontracts.id = tblstafftasks.rel_id)
        WHEN "estimate" THEN (SELECT id FROM tblestimates WHERE tblestimates.id = tblstafftasks.rel_id)
        WHEN "proposal" THEN (SELECT id FROM tblproposals WHERE tblproposals.id = tblstafftasks.rel_id)
        WHEN "invoice" THEN (SELECT id FROM tblinvoices WHERE tblinvoices.id = tblstafftasks.rel_id)
        WHEN "ticket" THEN (SELECT CONCAT(CONCAT("#",tbltickets.ticketid), " - ", tbltickets.subject) FROM tbltickets WHERE tbltickets.ticketid=tblstafftasks.rel_id)
        WHEN "lead" THEN (SELECT CASE tblleads.email WHEN "" THEN tblleads.name ELSE CONCAT(tblleads.name, " - ", tblleads.email) END FROM tblleads WHERE tblleads.id=tblstafftasks.rel_id)
        WHEN "customer" THEN (SELECT CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END FROM tblclients WHERE tblclients.userid=tblstafftasks.rel_id)
        WHEN "project" THEN (SELECT CONCAT(CONCAT(CONCAT("#",tblprojects.id)," - ",tblprojects.name), " - ", (SELECT CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END FROM tblclients WHERE userid=tblprojects.clientid)) FROM tblprojects WHERE tblprojects.id=tblstafftasks.rel_id)
        WHEN "expense" THEN (SELECT CASE expense_name WHEN "" THEN tblexpensescategories.name ELSE
         CONCAT(tblexpensescategories.name, ' (',tblexpenses.expense_name,')') END FROM tblexpenses JOIN tblexpensescategories ON tblexpensescategories.id = tblexpenses.category WHERE tblexpenses.id=tblstafftasks.rel_id)
        ELSE NULL
        END) as rel_name,billed,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=35) as is_assigned,(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids,(SELECT MAX(id) FROM tbltaskstimers WHERE task_id=tblstafftasks.id and staff_id=35 and end_time IS NULL) as not_finished_timer_by_current_staff,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=35) as current_user_is_assigned,(SELECT CASE WHEN addedfrom=35 AND is_added_from_contact=0 THEN 1 ELSE 0 END) as current_user_is_creator,(SELECT id FROM tbl_task_hoa_details WHERE task_id=tblstafftasks.id AND staff_id=35) as tbl_task_hoa_id,(SELECT mail_template FROM tblstafftasks WHERE id=tblstafftasks.id AND staff_id=35) as tbl_task_hoa_id
    FROM tblstafftasks
    
    
    WHERE  ( status IN (1, 4, 3, 2)) AND CASE WHEN rel_type="project" AND rel_id IN (SELECT project_id FROM tblprojectsettings WHERE project_id=rel_id AND name="hide_tasks_on_main_tasks_table" AND value=1) THEN rel_type != "project" ELSE 1=1 END
    
    ORDER BY duedate IS NULL ASC, duedate ASC
    LIMIT 0, 25
    
ERROR - 2020-07-24 03:13:48 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 03:14:14 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 03:17:08 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 03:32:04 --> Could not find the language line "Hoa Details For Tasks Page"
ERROR - 2020-07-24 03:32:04 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 03:32:57 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 03:33:01 --> Could not find the language line "Hoa Details For Tasks Page"
ERROR - 2020-07-24 03:35:46 --> Could not find the language line "Hoa Details For Tasks Page"
ERROR - 2020-07-24 11:01:02 --> 404 Page Not Found: admin/Tasks/check_list
ERROR - 2020-07-24 05:11:32 --> Could not find the language line "Tasks List"
ERROR - 2020-07-24 05:11:33 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 39
ERROR - 2020-07-24 05:11:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 39
ERROR - 2020-07-24 05:18:52 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:18:53 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 39
ERROR - 2020-07-24 05:18:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 39
ERROR - 2020-07-24 05:22:58 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:22:58 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 56
ERROR - 2020-07-24 05:22:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 56
ERROR - 2020-07-24 05:24:02 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:24:02 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 56
ERROR - 2020-07-24 05:24:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 56
ERROR - 2020-07-24 05:24:19 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:24:19 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 56
ERROR - 2020-07-24 05:24:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 56
ERROR - 2020-07-24 05:25:36 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:25:36 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 69
ERROR - 2020-07-24 05:25:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 69
ERROR - 2020-07-24 05:26:02 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:26:02 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 69
ERROR - 2020-07-24 05:26:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 69
ERROR - 2020-07-24 05:28:39 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:28:39 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 86
ERROR - 2020-07-24 05:28:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 86
ERROR - 2020-07-24 05:28:46 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:28:46 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 86
ERROR - 2020-07-24 05:28:46 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 86
ERROR - 2020-07-24 05:28:52 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:28:52 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 86
ERROR - 2020-07-24 05:28:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 86
ERROR - 2020-07-24 05:37:10 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:37:10 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 216
ERROR - 2020-07-24 05:37:10 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 216
ERROR - 2020-07-24 05:38:34 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:38:34 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 215
ERROR - 2020-07-24 05:38:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 215
ERROR - 2020-07-24 05:48:07 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:48:08 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 299
ERROR - 2020-07-24 05:48:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 299
ERROR - 2020-07-24 05:49:21 --> Could not find the language line "Check List"
ERROR - 2020-07-24 05:49:21 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 301
ERROR - 2020-07-24 05:49:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 301
ERROR - 2020-07-24 06:32:34 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 06:42:43 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:42:43 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 339
ERROR - 2020-07-24 06:42:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 339
ERROR - 2020-07-24 06:43:16 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:43:16 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 339
ERROR - 2020-07-24 06:43:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 339
ERROR - 2020-07-24 06:43:56 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:43:56 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 339
ERROR - 2020-07-24 06:43:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 339
ERROR - 2020-07-24 06:45:59 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:45:59 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 304
ERROR - 2020-07-24 06:45:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 304
ERROR - 2020-07-24 06:46:33 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:46:33 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:46:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:47:07 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:47:08 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:47:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:47:58 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:47:59 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:47:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:50:14 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:50:14 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:50:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:50:17 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:50:17 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:50:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:51:10 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:51:10 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:51:10 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:52:33 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:52:33 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:52:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:54:13 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:54:13 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:54:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:54:39 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:54:39 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:54:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 342
ERROR - 2020-07-24 06:56:12 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:56:12 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:56:12 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:56:33 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:56:33 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:56:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:57:08 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:57:08 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 367
ERROR - 2020-07-24 06:57:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 367
ERROR - 2020-07-24 06:58:41 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:58:41 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:58:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:58:47 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:58:47 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:58:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:59:29 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:59:29 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:59:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:59:49 --> Could not find the language line "Check List"
ERROR - 2020-07-24 06:59:49 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 06:59:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:01:14 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:01:14 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:01:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:11:15 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 07:11:43 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:11:45 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:11:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:11:58 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:11:58 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:11:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:37:21 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:37:21 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:37:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:38:24 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:38:24 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:38:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:38:35 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:38:35 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:38:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:41:07 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:41:07 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:41:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:42:12 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:42:12 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:42:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:42:27 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:42:27 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:42:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:43:54 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:43:55 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:43:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:44:27 --> Could not find the language line "Check List"
ERROR - 2020-07-24 07:44:27 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 07:44:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:15:47 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:15:47 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:15:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:20:35 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:20:35 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:20:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:21:31 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:21:31 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:21:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:22:57 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:22:57 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:22:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:24:55 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:24:56 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:24:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 370
ERROR - 2020-07-24 08:26:12 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:26:12 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 371
ERROR - 2020-07-24 08:26:12 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 371
ERROR - 2020-07-24 08:27:51 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:27:52 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 371
ERROR - 2020-07-24 08:27:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 371
ERROR - 2020-07-24 08:30:09 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:30:09 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 371
ERROR - 2020-07-24 08:30:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 371
ERROR - 2020-07-24 08:39:28 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:39:28 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 374
ERROR - 2020-07-24 08:39:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 374
ERROR - 2020-07-24 08:40:06 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:40:06 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 374
ERROR - 2020-07-24 08:40:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 374
ERROR - 2020-07-24 08:41:33 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:41:33 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 374
ERROR - 2020-07-24 08:41:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 374
ERROR - 2020-07-24 08:42:28 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:42:28 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 374
ERROR - 2020-07-24 08:42:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 374
ERROR - 2020-07-24 08:45:42 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:45:42 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:45:42 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:46:02 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:46:02 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:46:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:46:11 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:46:11 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:46:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:46:31 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:46:31 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:46:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:46:50 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:46:50 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:46:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:49:04 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:49:04 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:49:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:50:11 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:50:11 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:50:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:51:51 --> Could not find the language line "Check List"
ERROR - 2020-07-24 08:51:51 --> Severity: Notice --> Undefined variable: all_task_array C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 08:51:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 377
ERROR - 2020-07-24 09:14:30 --> Could not find the language line "Check List"
ERROR - 2020-07-24 09:21:20 --> Could not find the language line "Check List"
ERROR - 2020-07-24 09:22:50 --> Could not find the language line "Check List"
ERROR - 2020-07-24 09:25:24 --> Could not find the language line "Check List"
ERROR - 2020-07-24 09:40:56 --> Could not find the language line "Check List"
ERROR - 2020-07-24 09:46:52 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:13:55 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 10:14:09 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 10:14:18 --> Could not find the language line "Hoa Details For Tasks Page"
ERROR - 2020-07-24 10:14:22 --> Could not find the language line "Hoa Details"
ERROR - 2020-07-24 10:19:10 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:19:10 --> Severity: Notice --> Undefined variable: no_of_option C:\xampp\htdocs\signature\application\views\admin\tasks\check_list.php 2
ERROR - 2020-07-24 10:20:17 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:21:10 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:21:34 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:25:25 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:27:40 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:28:24 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:28:44 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:31:25 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:31:28 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:31:33 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:31:40 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:33:56 --> Could not find the language line "Check List"
ERROR - 2020-07-24 10:34:22 --> Could not find the language line "Check List"
ERROR - 2020-07-24 16:44:07 --> Severity: error --> Exception: syntax error, unexpected '$option_value_array' (T_VARIABLE) C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 1584
ERROR - 2020-07-24 10:45:34 --> Could not find the language line "Check List"
