<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-09-08 05:41:07 --> Could not find the language line "Custom Tasks"
ERROR - 2020-09-08 11:41:46 --> 404 Page Not Found: admin/Tasks/create_dependend_task
ERROR - 2020-09-08 12:40:41 --> Severity: error --> Exception: syntax error, unexpected '->' (T_OBJECT_OPERATOR) C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2406
ERROR - 2020-09-08 06:40:54 --> Severity: Notice --> Trying to get property 'parent_task_id' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2402
ERROR - 2020-09-08 06:40:54 --> Severity: Notice --> Trying to get property 'parent_task_value' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2402
ERROR - 2020-09-08 06:40:54 --> Severity: Notice --> Trying to get property 'parent_task_id' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2402
ERROR - 2020-09-08 06:40:54 --> Severity: Notice --> Trying to get property 'parent_task_value' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2402
ERROR - 2020-09-08 06:40:54 --> Severity: Notice --> Trying to get property 'parent_task_id' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2402
ERROR - 2020-09-08 06:40:54 --> Severity: Notice --> Trying to get property 'parent_task_value' of non-object C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2402
ERROR - 2020-09-08 06:40:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND `custom_input_value` =)
OR  (`custom_task_id` =  AND `custom_input_value` =)' at line 4 - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks`
WHERE `is_complete` = 1
OR  (`custom_task_id` =  AND `custom_input_value` =)
OR  (`custom_task_id` =  AND `custom_input_value` =)
OR  (`custom_task_id` =  AND `custom_input_value` =)
ERROR - 2020-09-08 06:41:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')
OR  (`custom_task_id` = 2 AND `custom_input_value` =)
OR  (`custom_task_id` = ' at line 4 - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks`
WHERE `is_complete` = 1
OR  (`custom_task_id` = 1 AND `custom_input_value` =)
OR  (`custom_task_id` = 2 AND `custom_input_value` =)
OR  (`custom_task_id` = 6 AND `custom_input_value` =)
ERROR - 2020-09-08 06:44:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')  (custom_task_id = 2 AND `custom_input_value` = )  (custom_task_id = 6 AND `cu' at line 3 - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks`
WHERE `is_complete` = 1 AND ((custom_task_id = 1 AND `custom_input_value` = )  (custom_task_id = 2 AND `custom_input_value` = )  (custom_task_id = 6 AND `custom_input_value` = ) )
ERROR - 2020-09-08 06:46:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '(custom_task_id = 2 AND `custom_input_value` IS NULL )  (custom_task_id = 6 AND ' at line 3 - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks`
WHERE `is_complete` = 1 AND ((custom_task_id = 1 AND `custom_input_value` IS NULL )  (custom_task_id = 2 AND `custom_input_value` IS NULL )  (custom_task_id = 6 AND `custom_input_value` IS NULL ) )
ERROR - 2020-09-08 06:47:39 --> Query error: Table 'signature.tblstafftasks1' doesn't exist - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks1`
WHERE 0 = ' (custom_task_id = 1 AND custom_input_value IS NULL) '
AND 1 = ' (custom_task_id = 2 AND custom_input_value IS NULL) '
AND 2 = ' (custom_task_id = 6 AND custom_input_value IS NULL) '
ERROR - 2020-09-08 06:47:55 --> Query error: Table 'signature.tblstafftasks1' doesn't exist - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks1`
WHERE `is_complete` = 1 AND ((custom_task_id = 1 AND `custom_input_value` IS NULL)  AND  (`custom_task_id` = 2 AND `custom_input_value` IS NULL)  AND  (`custom_task_id` = 6 AND `custom_input_value` IS NULL ) )
ERROR - 2020-09-08 06:48:13 --> Query error: Table 'signature.tblstafftasks1' doesn't exist - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks1`
WHERE `is_complete` = 1 AND ((custom_task_id = 1 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` = 2 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` = 6 AND `custom_input_value` IS NULL ) )
ERROR - 2020-09-08 06:49:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '( (custom_task_id = 1 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` =' at line 3 - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks`
WHERE `is_complete` = 1 AND rel_id = 2 ( (custom_task_id = 1 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` = 2 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` = 6 AND `custom_input_value` IS NULL ) )
ERROR - 2020-09-08 06:49:48 --> Query error: Table 'signature.tblstafftasks1' doesn't exist - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks1`
WHERE `is_complete` = 1 AND `rel_id` = 2 AND ((custom_task_id = 1 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` = 2 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` = 6 AND `custom_input_value` IS NULL ) )
ERROR - 2020-09-08 12:51:12 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF) C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2410
ERROR - 2020-09-08 06:51:16 --> Query error: Table 'signature.tblstafftasks1' doesn't exist - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks1`
WHERE `is_complete` = 1 AND `rel_id` = 2 AND ((custom_task_id = 1 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` = 2 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` = 6 AND `custom_input_value` IS NULL ) )
ERROR - 2020-09-08 06:53:05 --> Query error: Unknown column 'Ygrene' in 'where clause' - Invalid query: SELECT `id`, `name`
FROM `tblstafftasks`
WHERE `is_complete` = 1 AND `rel_id` = 2 AND ((custom_task_id = 1 AND `custom_input_value` IS NULL)  OR  (`custom_task_id` = 2 AND `custom_input_value` = `Ygrene`)  OR  (`custom_task_id` = 6 AND `custom_input_value` IS NULL ) )
ERROR - 2020-09-08 08:08:07 --> Severity: Notice --> Undefined variable: custom_task_id C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2640
ERROR - 2020-09-08 08:09:30 --> Severity: Notice --> Undefined property: stdClass::$id C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2646
ERROR - 2020-09-08 08:09:30 --> Severity: Notice --> Undefined property: stdClass::$id C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2646
ERROR - 2020-09-08 08:09:30 --> Severity: Notice --> Undefined property: stdClass::$id C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2646
ERROR - 2020-09-08 08:09:30 --> Severity: Notice --> Undefined property: stdClass::$id C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2646
ERROR - 2020-09-08 08:11:03 --> Severity: Notice --> Undefined property: stdClass::$id C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2646
ERROR - 2020-09-08 08:11:03 --> Severity: Notice --> Undefined property: stdClass::$id C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2646
ERROR - 2020-09-08 08:11:03 --> Severity: Notice --> Undefined property: stdClass::$id C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2646
ERROR - 2020-09-08 08:11:03 --> Severity: Notice --> Undefined property: stdClass::$id C:\xampp\htdocs\signature\application\controllers\admin\Tasks.php 2646
ERROR - 2020-09-08 14:34:03 --> 404 Page Not Found: admin/Tasks/all_child_task
