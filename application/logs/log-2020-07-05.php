<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-07-05 02:12:47 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:12:47 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:12:47 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:12:47 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:12:47 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:12:47 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 06:12:47 --> 404 Page Not Found: Uploads/company
ERROR - 2020-07-05 02:13:45 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:13:45 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:13:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`tblcontacts`.`lastname` as `user_lastname`, `tblstaff`.`firstname` as `staff_f' at line 1 - Invalid query: SELECT *, `tbltickets`.`userid`, `tbltickets`.`name` as `from_name`, `tbltickets`.`email` as `ticket_email`, `tbldepartments`.`name` as `department_name`, `tblpriorities`.`name` as `priority_name`, `statuscolor`, `tbltickets`.`admin`, `tblservices`.`name` as `service_name`, `service`, `tblticketstatus`.`name` as `status_name`, `tbltickets`.`ticketid`, `subject`, `tblcontacts`.`firstname` as `user_firstname`, .`tblcontacts`.`lastname` as `user_lastname`, `tblstaff`.`firstname` as `staff_firstname`, `tblstaff`.`lastname` as `staff_lastname`, `lastreply`, `message`, `tbltickets`.`status`, `subject`, `department`, `priority`, `tblcontacts`.`email`, `adminread`, `clientread`, `date`
FROM `tbltickets`
LEFT JOIN `tbldepartments` ON `tbldepartments`.`departmentid` = `tbltickets`.`department`
LEFT JOIN `tblticketstatus` ON `tblticketstatus`.`ticketstatusid` = `tbltickets`.`status`
LEFT JOIN `tblservices` ON `tblservices`.`serviceid` = `tbltickets`.`service`
LEFT JOIN `tblclients` ON `tblclients`.`userid` = `tbltickets`.`userid`
LEFT JOIN `tblcontacts` ON `tblcontacts`.`id` = `tbltickets`.`contactid`
LEFT JOIN `tblstaff` ON `tblstaff`.`staffid` = `tbltickets`.`admin`
LEFT JOIN `tblpriorities` ON `tblpriorities`.`priorityid` = `tbltickets`.`priority`
WHERE `tbltickets`.`userid` = '957'
AND `status` = 1
ORDER BY `lastreply` ASC
ERROR - 2020-07-05 02:14:31 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:14:31 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:14:31 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:14:31 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 06:14:32 --> 404 Page Not Found: Uploads/company
ERROR - 2020-07-05 02:16:39 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:16:39 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:16:39 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:16:39 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 06:16:39 --> 404 Page Not Found: Uploads/company
ERROR - 2020-07-05 02:16:49 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:16:49 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:16:49 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:16:49 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 06:16:50 --> 404 Page Not Found: Uploads/company
ERROR - 2020-07-05 02:16:54 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:16:54 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:16:54 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:16:54 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 06:16:54 --> 404 Page Not Found: Uploads/company
ERROR - 2020-07-05 02:17:41 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:41 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:41 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:41 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 06:17:41 --> 404 Page Not Found: Uploads/company
ERROR - 2020-07-05 02:17:42 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:42 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:42 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:42 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:43 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 06:17:43 --> 404 Page Not Found: Uploads/company
ERROR - 2020-07-05 06:17:43 --> 404 Page Not Found: Uploads/company
ERROR - 2020-07-05 02:17:45 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:45 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:45 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
ERROR - 2020-07-05 02:17:45 --> Severity: Notice --> Trying to access array offset on value of type null /Users/prashantshukla/Sites/Projects/Eric/avacrm/application/helpers/action_hooks_helper.php 112
