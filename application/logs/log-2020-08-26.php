<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-08-26 02:08:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:08:49 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 02:08:49 --> Query error: Subquery returns more than 1 row - Invalid query: 
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
    
ERROR - 2020-08-26 02:20:25 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:20:25 --> Could not find the language line "settings_sales_heading_company"
ERROR - 2020-08-26 08:20:33 --> 404 Page Not Found: Q/index
ERROR - 2020-08-26 02:20:38 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:20:42 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 02:20:42 --> Query error: Subquery returns more than 1 row - Invalid query: 
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
    
ERROR - 2020-08-26 02:20:44 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:20:44 --> Could not find the language line "settings_sales_heading_company"
ERROR - 2020-08-26 02:21:00 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:21:03 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 02:21:03 --> Query error: Subquery returns more than 1 row - Invalid query: 
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
    
ERROR - 2020-08-26 02:21:24 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:21:24 --> Could not find the language line "settings_sales_heading_company"
ERROR - 2020-08-26 02:21:40 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:21:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:43:38 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:44:59 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 02:46:55 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:02:58 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:03:06 --> Severity: error --> Exception: syntax error, unexpected 'action_status' (T_STRING) C:\xampp\htdocs\signature\application\controllers\Estimate.php 28
ERROR - 2020-08-26 03:03:10 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:03:17 --> Could not find the language line "Estimate"
ERROR - 2020-08-26 03:03:18 --> Could not find the language line "New Estimate"
ERROR - 2020-08-26 03:03:21 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:03:49 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:04:11 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:04:28 --> Severity: error --> Exception: syntax error, unexpected 'action_status' (T_STRING) C:\xampp\htdocs\signature\application\controllers\Estimate.php 28
ERROR - 2020-08-26 03:07:36 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:08:25 --> Severity: Warning --> mkdir(): No such file or directory C:\xampp\htdocs\signature\application\helpers\upload_helper.php 935
ERROR - 2020-08-26 03:08:26 --> Severity: Warning --> fopen(C:\xampp\htdocs\signature\uploads/estimates/2/index.html): failed to open stream: No such file or directory C:\xampp\htdocs\signature\application\helpers\upload_helper.php 936
ERROR - 2020-08-26 03:08:26 --> Severity: Warning --> fopen(C:\xampp\htdocs\signature\uploads/estimates/2/signature.png): failed to open stream: No such file or directory C:\xampp\htdocs\signature\application\helpers\misc_helper.php 185
ERROR - 2020-08-26 03:08:26 --> Severity: Warning --> fwrite() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\signature\application\helpers\misc_helper.php 187
ERROR - 2020-08-26 03:08:26 --> Severity: Warning --> fclose() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\signature\application\helpers\misc_helper.php 192
ERROR - 2020-08-26 03:08:26 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\signature\system\core\Exceptions.php:271) C:\xampp\htdocs\signature\system\helpers\url_helper.php 564
ERROR - 2020-08-26 03:11:52 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:12:58 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:13:12 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:13:12 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:21 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 242
ERROR - 2020-08-26 03:13:22 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:13:22 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `tblstafftasks`.`id`, `tblstafftasks`.`name`, `tblstafftasks`.`description`, `tblstafftasks`.`priority`, `tblstafftasks`.`dateadded`, `tblstafftasks`.`startdate`, `tblstafftasks`.`duedate`, `tblstafftasks`.`datefinished`, `tblstafftasks`.`addedfrom`, `tblstafftasks`.`is_added_from_contact`, `tblstafftasks`.`status`, `tblstafftasks`.`recurring_type`, `tblstafftasks`.`repeat_every`, `tblstafftasks`.`recurring`, `tblstafftasks`.`is_recurring_from`, `tblstafftasks`.`cycles`, `tblstafftasks`.`total_cycles`, `tblstafftasks`.`custom_recurring`, `tblstafftasks`.`last_recurring_date`, `tblstafftasks`.`rel_id`, `tblstafftasks`.`rel_type`, `tblstafftasks`.`is_public`, `tblstafftasks`.`billable`, `tblstafftasks`.`billed`, `tblstafftasks`.`invoice_id`, `tblstafftasks`.`hourly_rate`, `tblstafftasks`.`milestone`, `tblstafftasks`.`kanban_order`, `tblstafftasks`.`milestone_order`, `tblstafftasks`.`visible_to_client`, `tblstafftasks`.`deadline_notified`, `tblstafftasks`.`mail_template`, `tblstafftasks`.`progress_step`, `tblstafftasks`.`custom_task_id`, `tblstafftasks`.`custom_input_value`, `tblstafftasks`.`is_complete`, `tblmilestones`.`name` as `milestone_name`, (SELECT SUM(CASE
            WHEN end_time is NULL THEN 1598426002-start_time
            ELSE end_time-start_time
            END) FROM tbltaskstimers WHERE task_id=tblstafftasks.id) as total_logged_time, (SELECT GROUP_CONCAT(staffid SEPARATOR ", ") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids, (SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned
FROM `tblstafftasks`
LEFT JOIN `tblmilestones` ON `tblmilestones`.`id` = `tblstafftasks`.`milestone`
WHERE `rel_id` = '2'
AND `rel_type` = 'project'
AND `status` != 5 AND `billed` =0
ORDER BY `milestone_order` ASC
ERROR - 2020-08-26 03:13:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\signature\system\core\Exceptions.php:271) C:\xampp\htdocs\signature\system\core\Common.php 570
ERROR - 2020-08-26 03:15:38 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:15:38 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `tblstafftasks`.`id`, `tblstafftasks`.`name`, `tblstafftasks`.`description`, `tblstafftasks`.`priority`, `tblstafftasks`.`dateadded`, `tblstafftasks`.`startdate`, `tblstafftasks`.`duedate`, `tblstafftasks`.`datefinished`, `tblstafftasks`.`addedfrom`, `tblstafftasks`.`is_added_from_contact`, `tblstafftasks`.`status`, `tblstafftasks`.`recurring_type`, `tblstafftasks`.`repeat_every`, `tblstafftasks`.`recurring`, `tblstafftasks`.`is_recurring_from`, `tblstafftasks`.`cycles`, `tblstafftasks`.`total_cycles`, `tblstafftasks`.`custom_recurring`, `tblstafftasks`.`last_recurring_date`, `tblstafftasks`.`rel_id`, `tblstafftasks`.`rel_type`, `tblstafftasks`.`is_public`, `tblstafftasks`.`billable`, `tblstafftasks`.`billed`, `tblstafftasks`.`invoice_id`, `tblstafftasks`.`hourly_rate`, `tblstafftasks`.`milestone`, `tblstafftasks`.`kanban_order`, `tblstafftasks`.`milestone_order`, `tblstafftasks`.`visible_to_client`, `tblstafftasks`.`deadline_notified`, `tblstafftasks`.`mail_template`, `tblstafftasks`.`progress_step`, `tblstafftasks`.`custom_task_id`, `tblstafftasks`.`custom_input_value`, `tblstafftasks`.`is_complete`, `tblmilestones`.`name` as `milestone_name`, (SELECT SUM(CASE
            WHEN end_time is NULL THEN 1598426138-start_time
            ELSE end_time-start_time
            END) FROM tbltaskstimers WHERE task_id=tblstafftasks.id) as total_logged_time, (SELECT GROUP_CONCAT(staffid SEPARATOR ", ") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids, (SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned
FROM `tblstafftasks`
LEFT JOIN `tblmilestones` ON `tblmilestones`.`id` = `tblstafftasks`.`milestone`
WHERE `rel_id` = '2'
AND `rel_type` = 'project'
AND `status` != 5 AND `billed` =0
ORDER BY `milestone_order` ASC
ERROR - 2020-08-26 03:15:40 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:15:40 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `tblstafftasks`.`id`, `tblstafftasks`.`name`, `tblstafftasks`.`description`, `tblstafftasks`.`priority`, `tblstafftasks`.`dateadded`, `tblstafftasks`.`startdate`, `tblstafftasks`.`duedate`, `tblstafftasks`.`datefinished`, `tblstafftasks`.`addedfrom`, `tblstafftasks`.`is_added_from_contact`, `tblstafftasks`.`status`, `tblstafftasks`.`recurring_type`, `tblstafftasks`.`repeat_every`, `tblstafftasks`.`recurring`, `tblstafftasks`.`is_recurring_from`, `tblstafftasks`.`cycles`, `tblstafftasks`.`total_cycles`, `tblstafftasks`.`custom_recurring`, `tblstafftasks`.`last_recurring_date`, `tblstafftasks`.`rel_id`, `tblstafftasks`.`rel_type`, `tblstafftasks`.`is_public`, `tblstafftasks`.`billable`, `tblstafftasks`.`billed`, `tblstafftasks`.`invoice_id`, `tblstafftasks`.`hourly_rate`, `tblstafftasks`.`milestone`, `tblstafftasks`.`kanban_order`, `tblstafftasks`.`milestone_order`, `tblstafftasks`.`visible_to_client`, `tblstafftasks`.`deadline_notified`, `tblstafftasks`.`mail_template`, `tblstafftasks`.`progress_step`, `tblstafftasks`.`custom_task_id`, `tblstafftasks`.`custom_input_value`, `tblstafftasks`.`is_complete`, `tblmilestones`.`name` as `milestone_name`, (SELECT SUM(CASE
            WHEN end_time is NULL THEN 1598426140-start_time
            ELSE end_time-start_time
            END) FROM tbltaskstimers WHERE task_id=tblstafftasks.id) as total_logged_time, (SELECT GROUP_CONCAT(staffid SEPARATOR ", ") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids, (SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned
FROM `tblstafftasks`
LEFT JOIN `tblmilestones` ON `tblmilestones`.`id` = `tblstafftasks`.`milestone`
WHERE `rel_id` = '2'
AND `rel_type` = 'project'
AND `status` != 5 AND `billed` =0
ORDER BY `milestone_order` ASC
ERROR - 2020-08-26 03:16:09 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:16:09 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `tblstafftasks`.`id`, `tblstafftasks`.`name`, `tblstafftasks`.`description`, `tblstafftasks`.`priority`, `tblstafftasks`.`dateadded`, `tblstafftasks`.`startdate`, `tblstafftasks`.`duedate`, `tblstafftasks`.`datefinished`, `tblstafftasks`.`addedfrom`, `tblstafftasks`.`is_added_from_contact`, `tblstafftasks`.`status`, `tblstafftasks`.`recurring_type`, `tblstafftasks`.`repeat_every`, `tblstafftasks`.`recurring`, `tblstafftasks`.`is_recurring_from`, `tblstafftasks`.`cycles`, `tblstafftasks`.`total_cycles`, `tblstafftasks`.`custom_recurring`, `tblstafftasks`.`last_recurring_date`, `tblstafftasks`.`rel_id`, `tblstafftasks`.`rel_type`, `tblstafftasks`.`is_public`, `tblstafftasks`.`billable`, `tblstafftasks`.`billed`, `tblstafftasks`.`invoice_id`, `tblstafftasks`.`hourly_rate`, `tblstafftasks`.`milestone`, `tblstafftasks`.`kanban_order`, `tblstafftasks`.`milestone_order`, `tblstafftasks`.`visible_to_client`, `tblstafftasks`.`deadline_notified`, `tblstafftasks`.`mail_template`, `tblstafftasks`.`progress_step`, `tblstafftasks`.`custom_task_id`, `tblstafftasks`.`custom_input_value`, `tblstafftasks`.`is_complete`, `tblmilestones`.`name` as `milestone_name`, (SELECT SUM(CASE
            WHEN end_time is NULL THEN 1598426169-start_time
            ELSE end_time-start_time
            END) FROM tbltaskstimers WHERE task_id=tblstafftasks.id) as total_logged_time, (SELECT GROUP_CONCAT(staffid SEPARATOR ", ") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids, (SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned
FROM `tblstafftasks`
LEFT JOIN `tblmilestones` ON `tblmilestones`.`id` = `tblstafftasks`.`milestone`
WHERE `rel_id` = '2'
AND `rel_type` = 'project'
AND `status` != 5 AND `billed` =0
ORDER BY `milestone_order` ASC
ERROR - 2020-08-26 03:16:12 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:16:12 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:16:15 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:16:15 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:16:17 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:16:17 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, name, status, startdate, duedate, (SELECT GROUP_CONCAT(CONCAT(firstname, ' ', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblstafftasks.id and rel_type="task" ORDER by tag_order ASC) as tags, priority ,tblstafftasks.id,billed,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as is_assigned,(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids,(SELECT MAX(id) FROM tbltaskstimers WHERE task_id=tblstafftasks.id and staff_id=23 and end_time IS NULL) as not_finished_timer_by_current_staff,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned,(SELECT CASE WHEN addedfrom=23 AND is_added_from_contact=0 THEN 1 ELSE 0 END) as current_user_is_creator
    FROM tblstafftasks
    
    
    WHERE  ( status IN (1, 4, 3, 2)) AND rel_id="2" AND rel_type="project"
    
    ORDER BY duedate IS NULL ASC, duedate ASC
    LIMIT 0, 25
    
ERROR - 2020-08-26 03:16:20 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:16:20 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `tblstafftasks`.`id`, `tblstafftasks`.`name`, `tblstafftasks`.`description`, `tblstafftasks`.`priority`, `tblstafftasks`.`dateadded`, `tblstafftasks`.`startdate`, `tblstafftasks`.`duedate`, `tblstafftasks`.`datefinished`, `tblstafftasks`.`addedfrom`, `tblstafftasks`.`is_added_from_contact`, `tblstafftasks`.`status`, `tblstafftasks`.`recurring_type`, `tblstafftasks`.`repeat_every`, `tblstafftasks`.`recurring`, `tblstafftasks`.`is_recurring_from`, `tblstafftasks`.`cycles`, `tblstafftasks`.`total_cycles`, `tblstafftasks`.`custom_recurring`, `tblstafftasks`.`last_recurring_date`, `tblstafftasks`.`rel_id`, `tblstafftasks`.`rel_type`, `tblstafftasks`.`is_public`, `tblstafftasks`.`billable`, `tblstafftasks`.`billed`, `tblstafftasks`.`invoice_id`, `tblstafftasks`.`hourly_rate`, `tblstafftasks`.`milestone`, `tblstafftasks`.`kanban_order`, `tblstafftasks`.`milestone_order`, `tblstafftasks`.`visible_to_client`, `tblstafftasks`.`deadline_notified`, `tblstafftasks`.`mail_template`, `tblstafftasks`.`progress_step`, `tblstafftasks`.`custom_task_id`, `tblstafftasks`.`custom_input_value`, `tblstafftasks`.`is_complete`, `tblmilestones`.`name` as `milestone_name`, (SELECT SUM(CASE
            WHEN end_time is NULL THEN 1598426180-start_time
            ELSE end_time-start_time
            END) FROM tbltaskstimers WHERE task_id=tblstafftasks.id) as total_logged_time, (SELECT GROUP_CONCAT(staffid SEPARATOR ", ") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids, (SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned
FROM `tblstafftasks`
LEFT JOIN `tblmilestones` ON `tblmilestones`.`id` = `tblstafftasks`.`milestone`
WHERE `rel_id` = '2'
AND `rel_type` = 'project'
AND `status` != 5 AND `billed` =0
ORDER BY `milestone_order` ASC
ERROR - 2020-08-26 03:27:59 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:27:59 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `tblstafftasks`.`id`, `tblstafftasks`.`name`, `tblstafftasks`.`description`, `tblstafftasks`.`priority`, `tblstafftasks`.`dateadded`, `tblstafftasks`.`startdate`, `tblstafftasks`.`duedate`, `tblstafftasks`.`datefinished`, `tblstafftasks`.`addedfrom`, `tblstafftasks`.`is_added_from_contact`, `tblstafftasks`.`status`, `tblstafftasks`.`recurring_type`, `tblstafftasks`.`repeat_every`, `tblstafftasks`.`recurring`, `tblstafftasks`.`is_recurring_from`, `tblstafftasks`.`cycles`, `tblstafftasks`.`total_cycles`, `tblstafftasks`.`custom_recurring`, `tblstafftasks`.`last_recurring_date`, `tblstafftasks`.`rel_id`, `tblstafftasks`.`rel_type`, `tblstafftasks`.`is_public`, `tblstafftasks`.`billable`, `tblstafftasks`.`billed`, `tblstafftasks`.`invoice_id`, `tblstafftasks`.`hourly_rate`, `tblstafftasks`.`milestone`, `tblstafftasks`.`kanban_order`, `tblstafftasks`.`milestone_order`, `tblstafftasks`.`visible_to_client`, `tblstafftasks`.`deadline_notified`, `tblstafftasks`.`mail_template`, `tblstafftasks`.`progress_step`, `tblstafftasks`.`custom_task_id`, `tblstafftasks`.`custom_input_value`, `tblstafftasks`.`is_complete`, `tblmilestones`.`name` as `milestone_name`, (SELECT SUM(CASE
            WHEN end_time is NULL THEN 1598426879-start_time
            ELSE end_time-start_time
            END) FROM tbltaskstimers WHERE task_id=tblstafftasks.id) as total_logged_time, (SELECT GROUP_CONCAT(staffid SEPARATOR ", ") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids, (SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned
FROM `tblstafftasks`
LEFT JOIN `tblmilestones` ON `tblmilestones`.`id` = `tblstafftasks`.`milestone`
WHERE `rel_id` = '2'
AND `rel_type` = 'project'
AND `status` != 5 AND `billed` =0
ORDER BY `milestone_order` ASC
ERROR - 2020-08-26 03:28:12 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:28:12 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `tblstafftasks`.`id`, `tblstafftasks`.`name`, `tblstafftasks`.`description`, `tblstafftasks`.`priority`, `tblstafftasks`.`dateadded`, `tblstafftasks`.`startdate`, `tblstafftasks`.`duedate`, `tblstafftasks`.`datefinished`, `tblstafftasks`.`addedfrom`, `tblstafftasks`.`is_added_from_contact`, `tblstafftasks`.`status`, `tblstafftasks`.`recurring_type`, `tblstafftasks`.`repeat_every`, `tblstafftasks`.`recurring`, `tblstafftasks`.`is_recurring_from`, `tblstafftasks`.`cycles`, `tblstafftasks`.`total_cycles`, `tblstafftasks`.`custom_recurring`, `tblstafftasks`.`last_recurring_date`, `tblstafftasks`.`rel_id`, `tblstafftasks`.`rel_type`, `tblstafftasks`.`is_public`, `tblstafftasks`.`billable`, `tblstafftasks`.`billed`, `tblstafftasks`.`invoice_id`, `tblstafftasks`.`hourly_rate`, `tblstafftasks`.`milestone`, `tblstafftasks`.`kanban_order`, `tblstafftasks`.`milestone_order`, `tblstafftasks`.`visible_to_client`, `tblstafftasks`.`deadline_notified`, `tblstafftasks`.`mail_template`, `tblstafftasks`.`progress_step`, `tblstafftasks`.`custom_task_id`, `tblstafftasks`.`custom_input_value`, `tblstafftasks`.`is_complete`, `tblmilestones`.`name` as `milestone_name`, (SELECT SUM(CASE
            WHEN end_time is NULL THEN 1598426892-start_time
            ELSE end_time-start_time
            END) FROM tbltaskstimers WHERE task_id=tblstafftasks.id) as total_logged_time, (SELECT GROUP_CONCAT(staffid SEPARATOR ", ") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids, (SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned
FROM `tblstafftasks`
LEFT JOIN `tblmilestones` ON `tblmilestones`.`id` = `tblstafftasks`.`milestone`
WHERE `rel_id` = '2'
AND `rel_type` = 'project'
AND `status` != 5 AND `billed` =0
ORDER BY `milestone_order` ASC
ERROR - 2020-08-26 03:31:18 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:31:18 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:31:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:31:35 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:31:37 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:31:37 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, name, status, startdate, duedate, (SELECT GROUP_CONCAT(CONCAT(firstname, ' ', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblstafftasks.id and rel_type="task" ORDER by tag_order ASC) as tags, priority ,tblstafftasks.id,billed,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as is_assigned,(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids,(SELECT MAX(id) FROM tbltaskstimers WHERE task_id=tblstafftasks.id and staff_id=23 and end_time IS NULL) as not_finished_timer_by_current_staff,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned,(SELECT CASE WHEN addedfrom=23 AND is_added_from_contact=0 THEN 1 ELSE 0 END) as current_user_is_creator
    FROM tblstafftasks
    
    
    WHERE  ( status IN (1, 4, 3, 2)) AND rel_id="2" AND rel_type="project"
    
    ORDER BY duedate IS NULL ASC, duedate ASC
    LIMIT 0, 25
    
ERROR - 2020-08-26 03:31:47 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:31:47 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:31:49 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-08-26 03:31:49 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, name, status, startdate, duedate, (SELECT GROUP_CONCAT(CONCAT(firstname, ' ', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblstafftasks.id and rel_type="task" ORDER by tag_order ASC) as tags, priority ,tblstafftasks.id,billed,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as is_assigned,(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid) as assignees_ids,(SELECT MAX(id) FROM tbltaskstimers WHERE task_id=tblstafftasks.id and staff_id=23 and end_time IS NULL) as not_finished_timer_by_current_staff,(SELECT staffid FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id AND staffid=23) as current_user_is_assigned,(SELECT CASE WHEN addedfrom=23 AND is_added_from_contact=0 THEN 1 ELSE 0 END) as current_user_is_creator
    FROM tblstafftasks
    
    
    WHERE  ( status IN (1, 4, 3, 2)) AND rel_id="2" AND rel_type="project"
    
    ORDER BY duedate IS NULL ASC, duedate ASC
    LIMIT 0, 25
    
ERROR - 2020-08-26 03:41:49 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:41:49 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:41:57 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:41:57 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:42:56 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:42:56 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:43:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:43:02 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:43:08 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:43:08 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:43:14 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:43:14 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:43:18 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:43:18 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:47:03 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:47:03 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:50:11 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:50:11 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:50:26 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:50:26 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:50:49 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:50:59 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:50:59 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 03:51:33 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:52:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:58:08 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:08 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:09 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:10 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:11 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:12 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:13 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:14 --> Severity: Notice --> Undefined variable: aRow C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 31
ERROR - 2020-08-26 03:58:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:00:32 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:05:16 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:05:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:06:01 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:18:31 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:21:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:36:07 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:36:15 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:37:59 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:38:11 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:40:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:42:11 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:43:27 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:43:30 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:43:49 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:44:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:46:09 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 04:46:12 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 12:19:45 --> Severity: error --> Exception: syntax error, unexpected '$task_id' (T_VARIABLE) C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1171
ERROR - 2020-08-26 12:19:48 --> Severity: error --> Exception: syntax error, unexpected '$task_id' (T_VARIABLE) C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1171
ERROR - 2020-08-26 12:20:05 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ';' C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1183
ERROR - 2020-08-26 06:20:21 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:21:42 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:22:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:22:16 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 06:22:17 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:23:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 12:42:47 --> Severity: error --> Exception: syntax error, unexpected '{' C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1189
ERROR - 2020-08-26 06:43:09 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:45:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:47:36 --> Could not find the language line "Error During Update Status"
ERROR - 2020-08-26 06:47:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:49:03 --> Severity: Notice --> Undefined index: file C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1187
ERROR - 2020-08-26 06:53:50 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:55:42 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:55:47 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:57:12 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:57:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:57:30 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:57:30 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 06:57:46 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:57:46 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 06:59:23 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 06:59:43 --> Could not find the language line "Error During Update Status"
ERROR - 2020-08-26 06:59:43 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 07:08:11 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 07:08:18 --> Could not find the language line "Error During Update Status"
ERROR - 2020-08-26 07:08:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 07:08:58 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 13:11:21 --> Severity: error --> Exception: syntax error, unexpected '$status' (T_VARIABLE) C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1201
ERROR - 2020-08-26 07:33:33 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 07:33:34 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 07:34:18 --> Severity: Warning --> mkdir(): No such file or directory C:\xampp\htdocs\signature\application\helpers\upload_helper.php 935
ERROR - 2020-08-26 07:34:18 --> Severity: Warning --> fopen(C:\xampp\htdocs\signature\uploads/tasks/12/index.html): failed to open stream: No such file or directory C:\xampp\htdocs\signature\application\helpers\upload_helper.php 936
ERROR - 2020-08-26 07:34:18 --> Severity: Warning --> move_uploaded_file(C:\xampp\htdocs\signature\uploads/tasks/12/action-2277292_1920.jpg): failed to open stream: No such file or directory C:\xampp\htdocs\signature\application\helpers\upload_helper.php 310
ERROR - 2020-08-26 07:34:18 --> Severity: Warning --> move_uploaded_file(): Unable to move 'C:\xampp\tmp\php8F84.tmp' to 'C:\xampp\htdocs\signature\uploads/tasks/12/action-2277292_1920.jpg' C:\xampp\htdocs\signature\application\helpers\upload_helper.php 310
ERROR - 2020-08-26 07:44:08 --> Severity: error --> Exception: Too few arguments to function Projects::task_progress_action(), 0 passed in C:\xampp\htdocs\signature\system\core\CodeIgniter.php on line 532 and exactly 1 expected C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1165
ERROR - 2020-08-26 07:44:52 --> Could not find the language line "Some Thing Went Wrong .....!"
ERROR - 2020-08-26 07:44:52 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 07:49:45 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 07:49:46 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 07:53:35 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 07:56:15 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 07:56:16 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 07:57:22 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 07:57:36 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 07:57:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 08:04:38 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 08:04:41 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 08:06:04 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 08:06:05 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 08:10:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 08:57:59 --> Could not find the language line "Sorry Task Action Is Already Done .....!"
ERROR - 2020-08-26 08:58:00 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 08:58:47 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 08:58:58 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:06:58 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:07:01 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:07:08 --> Could not find the language line "Sorry Task Action Is Already Done .....!"
ERROR - 2020-08-26 09:07:08 --> Severity: Notice --> Undefined variable: project_id C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1203
ERROR - 2020-08-26 09:07:08 --> Severity: error --> Exception: Too few arguments to function Projects::task_progress(), 0 passed in C:\xampp\htdocs\signature\system\core\CodeIgniter.php on line 532 and exactly 1 expected C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1080
ERROR - 2020-08-26 09:08:02 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:08:31 --> Could not find the language line "Sorry Task Action Is Already Done .....!"
ERROR - 2020-08-26 09:08:32 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:08:46 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 09:08:46 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 15:24:55 --> Severity: error --> Exception: syntax error, unexpected ''save'' (T_CONSTANT_ENCAPSED_STRING) C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 1172
ERROR - 2020-08-26 09:25:45 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:25:59 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:25:59 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 09:26:09 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:26:09 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 15:38:23 --> 404 Page Not Found: admin/Projects/task_progress
ERROR - 2020-08-26 09:38:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:38:37 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 09:38:43 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:38:43 --> Could not find the language line "Task Progress"
ERROR - 2020-08-26 09:38:48 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 09:46:22 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 10:04:35 --> Severity: error --> Exception: Too few arguments to function Tasks::create_dependend_task(), 0 passed in C:\xampp\htdocs\signature\system\core\CodeIgniter.php on line 532 and exactly 1 expected C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2183
ERROR - 2020-08-26 10:07:26 --> Severity: Notice --> Trying to get property 'custom_task_id' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2186
ERROR - 2020-08-26 10:27:00 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 10:27:09 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 10:27:59 --> Severity: Notice --> Undefined variable: status C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2140
ERROR - 2020-08-26 16:28:03 --> 404 Page Not Found: admin/Projects/task_progress
ERROR - 2020-08-26 10:28:33 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 10:38:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 10:40:32 --> Could not find the language line "Sorry Task Action Is Already Done .....!"
ERROR - 2020-08-26 10:40:33 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 10:44:58 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 16:46:54 --> 404 Page Not Found: admin/Projects/task_progress
ERROR - 2020-08-26 10:47:20 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 10:48:15 --> Severity: Notice --> Undefined variable: status C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2140
ERROR - 2020-08-26 10:48:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 10:49:19 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:04:28 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:04:35 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 11:04:36 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:05:05 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 11:06:03 --> Severity: Notice --> Undefined variable: status C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2140
ERROR - 2020-08-26 11:06:08 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:06:18 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:07:59 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 11:08:00 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:08:29 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:08:36 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 11:08:37 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:09:46 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:09:52 --> Could not find the language line "Task Status Update Successfully"
ERROR - 2020-08-26 11:12:20 --> Could not find the language line "Some Thing Went Wrong .....!"
ERROR - 2020-08-26 11:12:21 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:16:06 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:16:06 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 42
ERROR - 2020-08-26 11:16:06 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:06 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:07 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:16:31 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:20:20 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:20:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:21 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:20:21 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:21:30 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:21:53 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:22:12 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:22:12 --> Severity: error --> Exception: syntax error, unexpected '=>' (T_DOUBLE_ARROW) C:\xampp\htdocs\signature\application\views\admin\projects\task_progress_table.php 59
ERROR - 2020-08-26 11:22:22 --> Could not find the language line "Custom Tasks"
ERROR - 2020-08-26 11:23:09 --> Could not find the language line "Custom Tasks"
