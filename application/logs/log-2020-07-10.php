<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-07-10 01:39:14 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-07-10 01:39:15 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, tblleads.id as id, tblleads.name as name, company, tblleads.email as email, tblleads.phonenumber as phonenumber, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblleads.id and rel_type="lead" ORDER by tag_order ASC LIMIT 1) as tags, firstname as assigned_firstname, tblleadsstatus.name as status_name, tblleadssources.name as source_name, lastcontact, dateadded ,junk,lost,color,status,assigned,lastname as assigned_lastname,tblleads.addedfrom as addedfrom,(SELECT leadid FROM tblclients WHERE leadid=tblleads.id) as is_converted,zip
    FROM tblleads
    LEFT JOIN tblstaff ON tblstaff.staffid = tblleads.assigned LEFT JOIN tblleadsstatus ON tblleadsstatus.id = tblleads.status LEFT JOIN tblleadssources ON tblleadssources.id = tblleads.source
    
    WHERE  lost = 0 AND junk = 0
    
    ORDER BY dateadded DESC
    LIMIT 0, 25
    
ERROR - 2020-07-10 01:43:16 --> Could not find the language line "lead_add_edit_contected_today"
ERROR - 2020-07-10 02:10:02 --> Could not find the language line "lead_add_edit_contected_today"
ERROR - 2020-07-10 02:34:29 --> Could not find the language line "lead_add_edit_contected_today"
ERROR - 2020-07-10 02:44:59 --> Severity: Warning --> mkdir(): No such file or directory C:\xampp\htdocs\signature\application\helpers\upload_helper.php 935
ERROR - 2020-07-10 02:44:59 --> Severity: Warning --> fopen(C:\xampp\htdocs\signature\uploads/proposals/1/index.html): failed to open stream: No such file or directory C:\xampp\htdocs\signature\application\helpers\upload_helper.php 936
ERROR - 2020-07-10 02:44:59 --> Severity: Warning --> fopen(C:\xampp\htdocs\signature\uploads/proposals/1/signature.png): failed to open stream: No such file or directory C:\xampp\htdocs\signature\application\helpers\misc_helper.php 185
ERROR - 2020-07-10 02:44:59 --> Severity: Warning --> fwrite() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\signature\application\helpers\misc_helper.php 187
ERROR - 2020-07-10 02:44:59 --> Severity: Warning --> fclose() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\signature\application\helpers\misc_helper.php 192
ERROR - 2020-07-10 02:45:00 --> Severity: Notice --> Undefined variable: systemBCC C:\xampp\htdocs\signature\application\controllers\Proposal.php 305
ERROR - 2020-07-10 02:45:04 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\signature\system\core\Exceptions.php:271) C:\xampp\htdocs\signature\system\helpers\url_helper.php 561
ERROR - 2020-07-10 02:45:46 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 130
ERROR - 2020-07-10 02:45:53 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 220
ERROR - 2020-07-10 02:45:53 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 130
ERROR - 2020-07-10 03:58:42 --> Severity: Notice --> Undefined variable: id C:\xampp\htdocs\signature\application\libraries\App.php 204
ERROR - 2020-07-10 04:03:22 --> Severity: Notice --> Undefined variable: id C:\xampp\htdocs\signature\application\libraries\App.php 185
ERROR - 2020-07-10 04:03:32 --> Severity: Notice --> Undefined variable: id C:\xampp\htdocs\signature\application\libraries\App.php 185
ERROR - 2020-07-10 04:03:49 --> Severity: Notice --> Undefined variable: id C:\xampp\htdocs\signature\application\libraries\App.php 189
ERROR - 2020-07-10 04:04:10 --> Severity: Notice --> Undefined variable: id C:\xampp\htdocs\signature\application\libraries\App.php 193
ERROR - 2020-07-10 04:04:13 --> Severity: Notice --> Undefined variable: id C:\xampp\htdocs\signature\application\libraries\App.php 193
