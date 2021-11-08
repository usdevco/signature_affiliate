<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-08-27 02:05:51 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:05:51 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 02:37:40 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:37:46 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-27 02:37:46 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, name, status, startdate, duedate, (SELECT GROUP_CONCAT(CONCAT(firstname, ' ', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblstafftasks.id and rel_type="task" ORDER by tag_order ASC) as tags, priority ,tblstafftasks.id,tblstafftasks.mail_template,rel_type,rel_id,(CASE rel_type
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
        END) as rel_name,billed,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as is_assigned,(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids,(SELECT MAX(id) FROM tbltaskstimers WHERE task_id=tblstafftasks.id and staff_id=23 and end_time IS NULL) as not_finished_timer_by_current_staff,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned,(SELECT CASE WHEN addedfrom=23 AND is_added_from_contact=0 THEN 1 ELSE 0 END) as current_user_is_creator,(SELECT id FROM tbl_task_hoa_details WHERE task_id=tblstafftasks.id AND staff_id=23) as tbl_task_hoa_id
    FROM tblstafftasks
    
    
    WHERE  ( (tblstafftasks.id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid = 23)) AND status IN (1, 4, 3, 2)) AND CASE WHEN rel_type="project" AND rel_id IN (SELECT project_id FROM tblprojectsettings WHERE project_id=rel_id AND name="hide_tasks_on_main_tasks_table" AND value=1) THEN rel_type != "project" ELSE 1=1 END
    
    ORDER BY duedate IS NULL ASC, duedate ASC
    LIMIT 0, 25
    
ERROR - 2020-08-27 02:37:56 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:38:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:40:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:41:09 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:41:39 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:42:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:42:40 --> Query error: Unknown column 'nameeee' in 'field list' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, nameeee, status, startdate, duedate, (SELECT GROUP_CONCAT(CONCAT(firstname, ' ', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblstafftasks.id and rel_type="task" ORDER by tag_order ASC LIMIT 1) as tags, priority ,tblstafftasks.id,billed,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23 LIMIT 1) as is_assigned,(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids,(SELECT MAX(id) FROM tbltaskstimers WHERE task_id=tblstafftasks.id and staff_id=23 and end_time IS NULL LIMIT 1) as not_finished_timer_by_current_staff,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23 LIMIT 1) as current_user_is_assigned,(SELECT CASE WHEN addedfrom=23 AND is_added_from_contact=0 THEN 1 ELSE 0 END LIMIT 1) as current_user_is_creator
    FROM tblstafftasks
    
    
    WHERE  ( status IN (1, 4, 3, 2)) AND rel_id="2" AND rel_type="estimate"
    
    ORDER BY duedate IS NULL ASC, duedate ASC
    LIMIT 0, 25
    
ERROR - 2020-08-27 02:47:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:48:29 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:48:29 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 02:48:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:48:34 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 02:48:36 --> Query error: Unknown column 'nameeee' in 'field list' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, nameeee, status, startdate, duedate, (SELECT GROUP_CONCAT(CONCAT(firstname, ' ', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblstafftasks.id and rel_type="task" ORDER by tag_order ASC LIMIT 1) as tags, priority ,tblstafftasks.id,billed,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23 LIMIT 1) as is_assigned,(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids,(SELECT MAX(id) FROM tbltaskstimers WHERE task_id=tblstafftasks.id and staff_id=23 and end_time IS NULL LIMIT 1) as not_finished_timer_by_current_staff,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23 LIMIT 1) as current_user_is_assigned,(SELECT CASE WHEN addedfrom=23 AND is_added_from_contact=0 THEN 1 ELSE 0 END LIMIT 1) as current_user_is_creator
    FROM tblstafftasks
    
    
    WHERE  ( status IN (1, 4, 3, 2)) AND rel_id="2" AND rel_type="project"
    
    ORDER BY duedate IS NULL ASC, duedate ASC
    LIMIT 0, 25
    
ERROR - 2020-08-27 02:49:05 --> Query error: Unknown column 'nameeee' in 'field list' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, nameeee, status, startdate, duedate, (SELECT GROUP_CONCAT(CONCAT(firstname, ' ', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblstafftasks.id and rel_type="task" ORDER by tag_order ASC LIMIT 1) as tags, priority ,tblstafftasks.id,billed,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23 LIMIT 1) as is_assigned,(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids,(SELECT MAX(id) FROM tbltaskstimers WHERE task_id=tblstafftasks.id and staff_id=23 and end_time IS NULL LIMIT 1) as not_finished_timer_by_current_staff,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23 LIMIT 1) as current_user_is_assigned,(SELECT CASE WHEN addedfrom=23 AND is_added_from_contact=0 THEN 1 ELSE 0 END LIMIT 1) as current_user_is_creator
    FROM tblstafftasks
    
    
    WHERE  ( status IN (1, 4, 3, 2)) AND rel_id="1" AND rel_type="estimate"
    
    ORDER BY duedate IS NULL ASC, duedate ASC
    LIMIT 0, 25
    
ERROR - 2020-08-27 02:56:31 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 02:56:31 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 02:56:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:02:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:02:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:02:56 --> Could not find the language line "lead_add_edit_contected_today"
ERROR - 2020-08-27 03:03:40 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 03:03:40 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 03:03:45 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:04:04 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:05:00 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:06:03 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:06:57 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:06:57 --> Could not find the language line "settings_sales_heading_company"
ERROR - 2020-08-27 03:07:00 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:07:00 --> Could not find the language line "settings_sales_heading_company"
ERROR - 2020-08-27 03:07:30 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:07:30 --> Could not find the language line "settings_sales_heading_company"
ERROR - 2020-08-27 03:07:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:07:35 --> Could not find the language line "settings_sales_heading_company"
ERROR - 2020-08-27 03:07:39 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:07:39 --> Could not find the language line "settings_sales_heading_company"
ERROR - 2020-08-27 03:07:44 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:07:44 --> Could not find the language line "settings_sales_heading_company"
ERROR - 2020-08-27 03:09:28 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:10:24 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:12:01 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:14:22 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:15:45 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:15:45 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 03:15:47 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:15:47 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 03:32:52 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:32:57 --> Could not find the language line "lead_add_edit_contected_today"
ERROR - 2020-08-27 03:33:45 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 03:33:46 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 03:33:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:34:22 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:35:29 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:36:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:38:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:38:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 03:39:24 --> 404 Page Not Found: 
ERROR - 2020-08-27 03:47:51 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:00:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:00:35 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:03:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:03:13 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:03:13 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:03:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:03:20 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:03:30 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:03:38 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:03:38 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:03:42 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:03:42 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:03:46 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:03:46 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:03:57 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:04:57 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:04:57 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:04:58 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:04:58 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:04:59 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:04:59 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:04:59 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:05:00 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:05:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:05:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:05:07 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:05:08 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:05:08 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:05:10 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:05:10 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:05:54 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:06:40 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:06:53 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:06:54 --> Could not find the language line "Hoa Details"
ERROR - 2020-08-27 04:08:07 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:08:15 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:08:52 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:08:52 --> Could not find the language line "Hoa Details"
ERROR - 2020-08-27 04:09:32 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:09:32 --> Could not find the language line "Hoa Details"
ERROR - 2020-08-27 04:09:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:09:37 --> Could not find the language line "Hoa Details"
ERROR - 2020-08-27 04:11:18 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:11:23 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:11:23 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:11:25 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:13:36 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:13:46 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 04:14:05 --> Severity: Notice --> Undefined variable: status C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2141
ERROR - 2020-08-27 04:14:11 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:14:55 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 04:15:11 --> Severity: Notice --> Undefined variable: status C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2141
ERROR - 2020-08-27 04:15:16 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:15:23 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 04:15:24 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:15:32 --> Could not find the language line "Sorry Task Action Is Already Done .....!"
ERROR - 2020-08-27 04:15:33 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:19:07 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:19:18 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 04:19:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:20:48 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:21:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:26:09 --> 404 Page Not Found: 
ERROR - 2020-08-27 04:26:15 --> 404 Page Not Found: 
ERROR - 2020-08-27 04:39:55 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:40:15 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:40:33 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:40:33 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:40:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:40:51 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:41:00 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:41:00 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:41:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:41:05 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:41:14 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:41:14 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 04:42:04 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:43:01 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:43:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:43:22 --> Could not find the language line "Some Thing Went Wrong .....!"
ERROR - 2020-08-27 04:43:22 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:50:10 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:51:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:51:28 --> Could not find the language line "Some Thing Went Wrong .....!"
ERROR - 2020-08-27 04:51:28 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:51:43 --> Could not find the language line "Some Thing Went Wrong .....!"
ERROR - 2020-08-27 04:51:44 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:53:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:54:05 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:54:51 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:55:56 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:56:15 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:56:19 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 04:56:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:56:27 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 04:56:28 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:59:10 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 04:59:28 --> Severity: Notice --> Undefined variable: status C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2184
ERROR - 2020-08-27 04:59:33 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 05:03:03 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:03:03 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 05:04:09 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:05:46 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:05:55 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:06:10 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:06:19 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 05:06:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:07:08 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 05:07:09 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:11:27 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:17:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:22:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:24:27 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:24:38 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:24:53 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:26:08 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:26:29 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:27:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:34:08 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:34:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:34:56 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:36:57 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:37:31 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:37:53 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:40:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:40:31 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 05:40:31 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:40:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:41:46 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:42:47 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:45:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:46:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 05:46:30 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 05:46:30 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:30:04 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:32:10 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:32:15 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 06:32:16 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 06:32:19 --> Query error: Unknown column 'tblproposals.addedfrom' in 'where clause' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS number, total, total_tax, YEAR(date) as year, CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END as company, date, expirydate, reference_no, `tblestimates`.`status` AS `tblestimates.status` ,tblestimates.id,tblestimates.clientid,tblestimates.invoiceid,symbol,project_id,deleted_customer_name,hash
    FROM tblestimates
    LEFT JOIN tblclients ON tblclients.userid = tblestimates.clientid LEFT JOIN tblcurrencies ON tblcurrencies.id = tblestimates.currency LEFT JOIN tblprojects ON tblprojects.id = tblestimates.project_id
    
    WHERE  tblclients.leadid = 1 AND ((tblproposals.addedfrom=35 AND tblproposals.addedfrom IN (SELECT staffid FROM tblstaffpermissions JOIN tblpermissions ON tblpermissions.permissionid=tblstaffpermissions.permissionid WHERE tblpermissions.name = "proposals" AND can_view_own=1)))
    
    ORDER BY expirydate DESC
    LIMIT 0, 25
    
ERROR - 2020-08-27 06:32:39 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:32:49 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 06:32:50 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 06:32:52 --> Query error: Unknown column 'tblproposals.addedfrom' in 'where clause' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS number, total, total_tax, YEAR(date) as year, CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END as company, date, expirydate, reference_no, `tblestimates`.`status` AS `tblestimates.status` ,tblestimates.id,tblestimates.clientid,tblestimates.invoiceid,symbol,project_id,deleted_customer_name,hash
    FROM tblestimates
    LEFT JOIN tblclients ON tblclients.userid = tblestimates.clientid LEFT JOIN tblcurrencies ON tblcurrencies.id = tblestimates.currency LEFT JOIN tblprojects ON tblprojects.id = tblestimates.project_id
    
    WHERE  tblclients.leadid = 1 AND ((tblproposals.addedfrom=35 AND tblproposals.addedfrom IN (SELECT staffid FROM tblstaffpermissions JOIN tblpermissions ON tblpermissions.permissionid=tblstaffpermissions.permissionid WHERE tblpermissions.name = "proposals" AND can_view_own=1)))
    
    ORDER BY expirydate DESC
    LIMIT 0, 25
    
ERROR - 2020-08-27 06:34:15 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 06:34:15 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 06:34:15 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 06:34:15 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 06:34:15 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 06:34:15 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 06:34:15 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 06:34:15 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 06:34:15 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 06:34:15 --> Query error: Unknown column 'tblproposals.addedfrom' in 'where clause' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS number, total, total_tax, YEAR(date) as year, CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END as company, date, expirydate, reference_no, `tblestimates`.`status` AS `tblestimates.status` ,tblestimates.id,tblestimates.clientid,tblestimates.invoiceid,symbol,project_id,deleted_customer_name,hash
    FROM tblestimates
    LEFT JOIN tblclients ON tblclients.userid = tblestimates.clientid LEFT JOIN tblcurrencies ON tblcurrencies.id = tblestimates.currency LEFT JOIN tblprojects ON tblprojects.id = tblestimates.project_id
    
    WHERE  tblclients.leadid = 1 AND ((tblproposals.addedfrom=35 AND tblproposals.addedfrom IN (SELECT staffid FROM tblstaffpermissions JOIN tblpermissions ON tblpermissions.permissionid=tblstaffpermissions.permissionid WHERE tblpermissions.name = "proposals" AND can_view_own=1)))
    
    
    
    
ERROR - 2020-08-27 06:34:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\signature\system\core\Exceptions.php:271) C:\xampp\htdocs\signature\system\core\Common.php 570
ERROR - 2020-08-27 06:35:04 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:35:16 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:36:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:36:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:37:08 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:37:21 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:37:21 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 06:37:24 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:37:24 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 06:39:01 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:39:01 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 06:39:08 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:40:09 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:41:43 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:54:27 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 06:54:27 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 06:54:29 --> Query error: Unknown column 'tblproposals.addedfrom' in 'where clause' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS number, total, total_tax, YEAR(date) as year, CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END as company, date, expirydate, reference_no, `tblestimates`.`status` AS `tblestimates.status` ,tblestimates.id,tblestimates.clientid,tblestimates.invoiceid,symbol,project_id,deleted_customer_name,hash
    FROM tblestimates
    LEFT JOIN tblclients ON tblclients.userid = tblestimates.clientid LEFT JOIN tblcurrencies ON tblcurrencies.id = tblestimates.currency LEFT JOIN tblprojects ON tblprojects.id = tblestimates.project_id
    
    WHERE  tblclients.leadid = 1 AND ((tblproposals.addedfrom=35 AND tblproposals.addedfrom IN (SELECT staffid FROM tblstaffpermissions JOIN tblpermissions ON tblpermissions.permissionid=tblstaffpermissions.permissionid WHERE tblpermissions.name = "proposals" AND can_view_own=1)))
    
    ORDER BY expirydate DESC
    LIMIT 0, 25
    
ERROR - 2020-08-27 06:54:37 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 06:54:37 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 06:54:40 --> Query error: Unknown column 'tblproposals.addedfrom' in 'where clause' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS number, total, total_tax, YEAR(date) as year, CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END as company, date, expirydate, reference_no, `tblestimates`.`status` AS `tblestimates.status` ,tblestimates.id,tblestimates.clientid,tblestimates.invoiceid,symbol,project_id,deleted_customer_name,hash
    FROM tblestimates
    LEFT JOIN tblclients ON tblclients.userid = tblestimates.clientid LEFT JOIN tblcurrencies ON tblcurrencies.id = tblestimates.currency LEFT JOIN tblprojects ON tblprojects.id = tblestimates.project_id
    
    WHERE  tblclients.leadid = 1 AND ((tblproposals.addedfrom=35 AND tblproposals.addedfrom IN (SELECT staffid FROM tblstaffpermissions JOIN tblpermissions ON tblpermissions.permissionid=tblstaffpermissions.permissionid WHERE tblpermissions.name = "proposals" AND can_view_own=1)))
    
    ORDER BY expirydate DESC
    LIMIT 0, 25
    
ERROR - 2020-08-27 06:55:23 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 06:55:23 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 06:59:24 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 06:59:52 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 06:59:52 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 07:00:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 07:00:38 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 07:00:38 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 13:34:46 --> Severity: error --> Exception: syntax error, unexpected '$where' (T_VARIABLE) C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2217
ERROR - 2020-08-27 13:34:52 --> Severity: error --> Exception: syntax error, unexpected '$where' (T_VARIABLE) C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2217
ERROR - 2020-08-27 07:35:50 --> Query error: Unknown column 'custom_input_value' in 'where clause' - Invalid query: SELECT `tblcustomtask`.`id` as `customtask_id`, `tblcustomtask`.`title`, `tblcustomtask`.`role_id`, (select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name
FROM `tblcustomtask`
WHERE `parent_task_id` = '1'
AND (`custom_input_value` = `parent_task_value`)
ERROR - 2020-08-27 07:37:53 --> Query error: Unknown column 'custom_input_value' in 'field list' - Invalid query: SELECT `tblcustomtask`.`id` as `customtask_id`, `tblcustomtask`.`title`, `tblcustomtask`.`role_id`, `custom_input_value`, (select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name, (select parent_task_value from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as parent_task_value
FROM `tblcustomtask`
WHERE `parent_task_id` = '1'
AND (`custom_input_value` = `parent_task_value`)
ERROR - 2020-08-27 07:39:21 --> Query error: Unknown column 'custom_input_value' in 'field list' - Invalid query: SELECT `tblcustomtask`.`id` as `customtask_id`, `tblcustomtask`.`title`, `tblcustomtask`.`role_id`, `custom_input_value`, (select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name, (select parent_task_value from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as parent_task_value
FROM `tblcustomtask`
WHERE `parent_task_id` = '1'
AND (`custom_input_value` = `parent_task_value`)
ERROR - 2020-08-27 07:41:04 --> Severity: Notice --> Trying to get property 'tblcustomtask' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2217
ERROR - 2020-08-27 07:41:04 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')' at line 4 - Invalid query: SELECT `tblcustomtask`.`id` as `customtask_id`, `tblcustomtask`.`title`, `tblcustomtask`.`role_id`, `custom_input_value`, (select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name, (select parent_task_value from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as parent_task_value
FROM `tblcustomtask`
WHERE `parent_task_id` = '1'
AND (`parent_task_value` =)
ERROR - 2020-08-27 13:41:27 --> Severity: error --> Exception: syntax error, unexpected '' (T_ENCAPSED_AND_WHITESPACE), expecting '-' or identifier (T_STRING) or variable (T_VARIABLE) or number (T_NUM_STRING) C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2217
ERROR - 2020-08-27 13:42:21 --> Severity: error --> Exception: syntax error, unexpected '->' (T_OBJECT_OPERATOR) C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2217
ERROR - 2020-08-27 07:42:33 --> Query error: Unknown column 'custom_input_value' in 'field list' - Invalid query: SELECT `tblcustomtask`.`id` as `customtask_id`, `tblcustomtask`.`title`, `tblcustomtask`.`role_id`, `custom_input_value`, (select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name, (select parent_task_value from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as parent_task_value
FROM `tblcustomtask`
WHERE `parent_task_id` = '1'
ERROR - 2020-08-27 07:43:38 --> Query error: Unknown column 'custom_input_value' in 'field list' - Invalid query: SELECT `tblcustomtask`.`id` as `customtask_id`, `tblcustomtask`.`title`, `tblcustomtask`.`role_id`, `custom_input_value`, (select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name, (select parent_task_value from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as parent_task_value
FROM `tblcustomtask`
WHERE `parent_task_id` = '1'
ERROR - 2020-08-27 07:49:51 --> Severity: Notice --> Undefined variable: arr C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2227
ERROR - 2020-08-27 07:50:08 --> Severity: Notice --> Trying to get property 'custom_input_value' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2222
ERROR - 2020-08-27 07:50:08 --> Severity: Notice --> Trying to get property 'custom_input_value' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2222
ERROR - 2020-08-27 07:50:08 --> Severity: Notice --> Undefined variable: arr C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2227
ERROR - 2020-08-27 07:51:02 --> Severity: Notice --> Undefined index: custom_input_value C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2222
ERROR - 2020-08-27 07:51:02 --> Severity: Notice --> Undefined index: custom_input_value C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2222
ERROR - 2020-08-27 07:51:03 --> Severity: Notice --> Undefined variable: arr C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2227
ERROR - 2020-08-27 07:53:23 --> Severity: Notice --> Undefined variable: arr C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2227
ERROR - 2020-08-27 08:06:05 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 08:08:01 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 08:08:07 --> Could not find the language line "lead_add_edit_contected_today"
ERROR - 2020-08-27 08:08:51 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 08:08:51 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 08:08:57 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 08:09:15 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 08:10:30 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 08:10:48 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 08:10:55 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 08:10:55 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 08:10:59 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:02:42 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:02:49 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:02:50 --> Could not find the language line "No"
ERROR - 2020-08-27 09:02:50 --> Could not find the language line "Name"
ERROR - 2020-08-27 09:02:50 --> Could not find the language line "Action"
ERROR - 2020-08-27 09:03:11 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:03:14 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:06:50 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:06:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:06:50 --> Could not find the language line "No"
ERROR - 2020-08-27 09:06:50 --> Could not find the language line "Name"
ERROR - 2020-08-27 09:06:50 --> Could not find the language line "Action"
ERROR - 2020-08-27 09:06:55 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:06:55 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:08:08 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:08:08 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:08:08 --> Could not find the language line "No"
ERROR - 2020-08-27 09:08:08 --> Could not find the language line "Name"
ERROR - 2020-08-27 09:08:08 --> Could not find the language line "Action"
ERROR - 2020-08-27 09:08:18 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:08:18 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:09:48 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:09:48 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:09:48 --> Could not find the language line "No"
ERROR - 2020-08-27 09:09:48 --> Could not find the language line "Name"
ERROR - 2020-08-27 09:09:48 --> Could not find the language line "Action"
ERROR - 2020-08-27 09:15:59 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:15:59 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:16:23 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:16:23 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:17:06 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:17:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:18:52 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:18:52 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:19:06 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:19:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:27:40 --> Could not find the language line "Custom Task List"
ERROR - 2020-08-27 09:27:40 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 15:30:48 --> 404 Page Not Found: Mail/index
ERROR - 2020-08-27 15:30:55 --> 404 Page Not Found: Task/mail
ERROR - 2020-08-27 15:30:59 --> 404 Page Not Found: Tasks/mail
ERROR - 2020-08-27 09:53:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:55:58 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:56:06 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 09:56:08 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 09:56:08 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 09:56:08 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 09:57:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:57:47 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 09:57:47 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 09:57:52 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:58:13 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:58:43 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 09:59:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:01:14 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:01:44 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:01:44 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:02:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:02:02 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:09:09 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:10:36 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:10:36 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:10:39 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:10:39 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:13:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:13:35 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:26:23 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:26:23 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:26:23 --> Severity: Notice --> Undefined property: stdClass::$active C:\xampp\htdocs\signature\application\views\admin\projects\view.php 36
ERROR - 2020-08-27 10:26:26 --> Severity: error --> Exception: syntax error, unexpected ''billed'' (T_CONSTANT_ENCAPSED_STRING), expecting ']' C:\xampp\htdocs\signature\application\views\admin\tables\tasks_relations.php 81
ERROR - 2020-08-27 10:26:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:26:42 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:26:42 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:26:46 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:26:46 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:26:48 --> Severity: error --> Exception: syntax error, unexpected ''billed'' (T_CONSTANT_ENCAPSED_STRING), expecting ']' C:\xampp\htdocs\signature\application\views\admin\tables\tasks_relations.php 81
ERROR - 2020-08-27 10:27:28 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:27:28 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:28:05 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:28:05 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:28:11 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:28:11 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:29:58 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:30:17 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 10:30:17 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 10:30:17 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 10:30:17 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 10:30:17 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 10:30:17 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 10:30:17 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 10:30:17 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 10:30:18 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 10:30:18 --> Severity: Notice --> Undefined index: draw C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 224
ERROR - 2020-08-27 10:30:18 --> 404 Page Not Found: 
ERROR - 2020-08-27 10:30:21 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:31:27 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:31:36 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:31:44 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:32:26 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:32:26 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:35:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:37:10 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:37:10 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:37:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:37:35 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:37:39 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:37:49 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 10:37:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:38:09 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 10:38:10 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:38:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:38:19 --> Could not find the language line "Hoa Details"
ERROR - 2020-08-27 10:38:27 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:38:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:38:41 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:38:46 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:38:46 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:38:53 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:39:02 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 10:39:03 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:39:23 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 10:39:24 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:39:28 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:39:28 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:49:08 --> Query error: Unknown column 'tblcustomtask.customtask_id' in 'where clause' - Invalid query: SELECT `tblcustomtask`.`id` as `customtask_id`, `tblcustomtask`.`title`, `tblcustomtask`.`role_id`, (select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name, (select parent_task_value from tblcustomtask where tblcustomtask.id = tblcustomtask.customtask_id) as parent_task_value
FROM `tblcustomtask`
WHERE `parent_task_id` = '1'
ERROR - 2020-08-27 10:49:49 --> Query error: Unknown column 'tblstafftasks.customtask_id' in 'where clause' - Invalid query: SELECT `tblcustomtask`.`id` as `customtask_id`, `tblcustomtask`.`title`, `tblcustomtask`.`role_id`, (select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name, (select parent_task_value from tblcustomtask where tblcustomtask.id = tblstafftasks.customtask_id) as parent_task_value
FROM `tblcustomtask`
WHERE `parent_task_id` = '1'
ERROR - 2020-08-27 10:50:51 --> Query error: Unknown column 'tblstafftasks.custom_task_id' in 'where clause' - Invalid query: SELECT `tblcustomtask`.`id` as `customtask_id`, `tblcustomtask`.`title`, `tblcustomtask`.`role_id`, (select slug from tbltaskstep where tbltaskstep.id = tblcustomtask.task_step_id) as step_name, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.client_mail_templet) as mail_template, (select mail_templet from tblmailtemplet where tblmailtemplet.id = tblcustomtask.staff_mail_templet) as staff_mail_templet_name, (select parent_task_value from tblcustomtask where tblcustomtask.id = tblstafftasks.custom_task_id) as parent_task_value
FROM `tblcustomtask`
WHERE `parent_task_id` = '1'
ERROR - 2020-08-27 10:54:33 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:54:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:54:35 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 10:54:36 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:54:46 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 10:55:01 --> Query error: Duplicate entry '8' for key 'PRIMARY' - Invalid query: INSERT INTO `tblstafftasks` (`id`, `name`, `description`, `priority`, `dateadded`, `startdate`, `duedate`, `datefinished`, `addedfrom`, `is_added_from_contact`, `status`, `recurring_type`, `repeat_every`, `recurring`, `is_recurring_from`, `cycles`, `total_cycles`, `custom_recurring`, `last_recurring_date`, `rel_id`, `rel_type`, `is_public`, `billable`, `billed`, `invoice_id`, `hourly_rate`, `milestone`, `kanban_order`, `milestone_order`, `visible_to_client`, `deadline_notified`, `mail_template`, `progress_step`, `custom_task_id`, `custom_input_value`, `is_complete`) VALUES ('8', 'Upload Architectural Modification Documents', 'Upload Architectural Modification Documents', 1, '2020-08-27 10:55:01', '2020-08-27 10:55:01', NULL, NULL, '1', 0, 1, NULL, 0, 0, NULL, 0, 0, 0, NULL, '7', 'project', 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, NULL, 'permit', '6', 'yes', NULL)
ERROR - 2020-08-27 10:56:52 --> Could not find the language line "Sorry Task Action Is Already Done .....!"
ERROR - 2020-08-27 10:56:53 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:57:13 --> Query error: Duplicate entry '8' for key 'PRIMARY' - Invalid query: INSERT INTO `tblstafftasks` (`id`, `name`, `description`, `priority`, `dateadded`, `startdate`, `duedate`, `datefinished`, `addedfrom`, `is_added_from_contact`, `status`, `recurring_type`, `repeat_every`, `recurring`, `is_recurring_from`, `cycles`, `total_cycles`, `custom_recurring`, `last_recurring_date`, `rel_id`, `rel_type`, `is_public`, `billable`, `billed`, `invoice_id`, `hourly_rate`, `milestone`, `kanban_order`, `milestone_order`, `visible_to_client`, `deadline_notified`, `mail_template`, `progress_step`, `custom_task_id`, `custom_input_value`, `is_complete`) VALUES ('8', 'Upload Architectural Modification Documents', 'Upload Architectural Modification Documents', 1, '2020-08-27 10:57:13', '2020-08-27 10:57:13', NULL, '2020-08-27 10:56:58', '1', 0, 1, NULL, 0, 0, NULL, 0, 0, 0, NULL, '7', 'project', 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, NULL, 'permit', '6', 'yes', '1')
ERROR - 2020-08-27 10:57:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:57:42 --> Could not find the language line "Error During Update Status"
ERROR - 2020-08-27 10:57:43 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 10:57:52 --> Could not find the language line "Error During Update Status"
ERROR - 2020-08-27 10:57:52 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:02:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:02:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:02:53 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:03:01 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:03:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:03:23 --> Could not find the language line "lead_add_edit_contected_today"
ERROR - 2020-08-27 11:04:04 --> Could not find the language line "Estimate"
ERROR - 2020-08-27 11:04:05 --> Could not find the language line "New Estimate"
ERROR - 2020-08-27 11:04:17 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:04:25 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:04:28 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:04:43 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:04:44 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:04:49 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:05:00 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:05:18 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:05:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:05:31 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:05:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:06:13 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:06:22 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:06:27 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:06:27 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 11:06:31 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:06:43 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:06:47 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:06:47 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 11:06:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:07:07 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:07:14 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:07:14 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 11:07:17 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:07:17 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 11:07:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:07:44 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:07:44 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 11:07:48 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:07:54 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 11:07:54 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:08:13 --> Query error: Duplicate entry '1' for key 'PRIMARY' - Invalid query: INSERT INTO `tblstafftasks` (`id`, `name`, `description`, `priority`, `dateadded`, `startdate`, `duedate`, `datefinished`, `addedfrom`, `is_added_from_contact`, `status`, `recurring_type`, `repeat_every`, `recurring`, `is_recurring_from`, `cycles`, `total_cycles`, `custom_recurring`, `last_recurring_date`, `rel_id`, `rel_type`, `is_public`, `billable`, `billed`, `invoice_id`, `hourly_rate`, `milestone`, `kanban_order`, `milestone_order`, `visible_to_client`, `deadline_notified`, `mail_template`, `progress_step`, `custom_task_id`, `custom_input_value`, `is_complete`) VALUES ('1', 'Upload Architectural Modification Documents', 'Upload Architectural Modification Documents', 1, '2020-08-27 11:08:13', '2020-08-27 11:08:13', NULL, '2020-08-27 11:07:58', '1', 0, 1, NULL, 0, 0, NULL, 0, 0, 0, NULL, '1', 'project', 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, NULL, 'permit', '6', 'yes', '1')
ERROR - 2020-08-27 11:09:14 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:10:39 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:11:51 --> 404 Page Not Found: 
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: columns C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 134
ERROR - 2020-08-27 11:12:16 --> Severity: Notice --> Undefined index: draw C:\xampp\htdocs\signature\application\helpers\datatables_helper.php 224
ERROR - 2020-08-27 11:12:27 --> Severity: Notice --> Undefined variable: task_array C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2212
ERROR - 2020-08-27 11:12:27 --> Severity: Notice --> Undefined variable: task_array C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2212
ERROR - 2020-08-27 11:12:36 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:12:44 --> Could not find the language line "Error During Update Status"
ERROR - 2020-08-27 11:12:45 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:13:01 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:13:15 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:13:15 --> Could not find the language line "Hoa Details"
ERROR - 2020-08-27 11:13:28 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:13:31 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:13:32 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 11:13:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:13:41 --> Could not find the language line "Error During Update Status"
ERROR - 2020-08-27 11:13:42 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 17:15:00 --> Severity: error --> Exception: syntax error, unexpected ',' C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2120
ERROR - 2020-08-27 11:15:14 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:16:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:17:05 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:17:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:18:35 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 11:18:36 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:18:57 --> Severity: Notice --> Undefined variable: task_array C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2212
ERROR - 2020-08-27 11:18:58 --> Severity: Notice --> Undefined variable: task_array C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2212
ERROR - 2020-08-27 11:18:58 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 11:19:03 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:19:27 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 11:19:28 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:19:47 --> Severity: Notice --> Undefined variable: task_array C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2212
ERROR - 2020-08-27 11:19:48 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 11:20:24 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:20:32 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 11:20:32 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:20:52 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 11:20:53 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:23:52 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:23:59 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 11:24:14 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:25:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:25:06 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 11:25:14 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:25:14 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 11:26:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:26:58 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-27 11:27:13 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-27 11:27:13 --> Could not find the language line "Task Progress"
ERROR - 2020-08-27 11:27:13 --> Could not find the language line "Custom Tasks"
