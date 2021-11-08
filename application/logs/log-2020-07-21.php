<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-07-21 07:25:59 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-07-21 07:25:59 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, tblleads.id as id, tblleads.name as name, company, tblleads.email as email, tblleads.phonenumber as phonenumber, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblleads.id and rel_type="lead" ORDER by tag_order ASC LIMIT 1) as tags, firstname as assigned_firstname, tblleadsstatus.name as status_name, tblleadssources.name as source_name, lastcontact, dateadded ,junk,lost,color,status,assigned,lastname as assigned_lastname,tblleads.addedfrom as addedfrom,(SELECT leadid FROM tblclients WHERE leadid=tblleads.id) as is_converted,zip
    FROM tblleads
    LEFT JOIN tblstaff ON tblstaff.staffid = tblleads.assigned LEFT JOIN tblleadsstatus ON tblleadsstatus.id = tblleads.status LEFT JOIN tblleadssources ON tblleadssources.id = tblleads.source
    
    WHERE  lost = 0 AND junk = 0 AND status IN (2,3,4)
    
    ORDER BY dateadded DESC
    LIMIT 0, 25
    
ERROR - 2020-07-21 08:04:12 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-07-21 08:04:12 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, tblleads.id as id, tblleads.name as name, company, tblleads.email as email, tblleads.phonenumber as phonenumber, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblleads.id and rel_type="lead" ORDER by tag_order ASC LIMIT 1) as tags, firstname as assigned_firstname, tblleadsstatus.name as status_name, tblleadssources.name as source_name, lastcontact, dateadded ,junk,lost,color,status,assigned,lastname as assigned_lastname,tblleads.addedfrom as addedfrom,(SELECT leadid FROM tblclients WHERE leadid=tblleads.id) as is_converted,zip
    FROM tblleads
    LEFT JOIN tblstaff ON tblstaff.staffid = tblleads.assigned LEFT JOIN tblleadsstatus ON tblleadsstatus.id = tblleads.status LEFT JOIN tblleadssources ON tblleadssources.id = tblleads.source
    
    WHERE  lost = 0 AND junk = 0 AND status IN (2,3,4)
    
    ORDER BY dateadded DESC
    LIMIT 0, 25
    
ERROR - 2020-07-21 09:53:17 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-07-21 09:53:17 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, tblleads.id as id, tblleads.name as name, company, tblleads.email as email, tblleads.phonenumber as phonenumber, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblleads.id and rel_type="lead" ORDER by tag_order ASC LIMIT 1) as tags, firstname as assigned_firstname, tblleadsstatus.name as status_name, tblleadssources.name as source_name, lastcontact, dateadded ,junk,lost,color,status,assigned,lastname as assigned_lastname,tblleads.addedfrom as addedfrom,(SELECT leadid FROM tblclients WHERE leadid=tblleads.id) as is_converted,zip
    FROM tblleads
    LEFT JOIN tblstaff ON tblstaff.staffid = tblleads.assigned LEFT JOIN tblleadsstatus ON tblleadsstatus.id = tblleads.status LEFT JOIN tblleadssources ON tblleadssources.id = tblleads.source
    
    WHERE  lost = 0 AND junk = 0 AND status IN (2,3,4)
    
    ORDER BY dateadded DESC
    LIMIT 0, 25
    
ERROR - 2020-07-21 09:55:17 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-07-21 09:55:17 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, tblleads.id as id, tblleads.name as name, company, tblleads.email as email, tblleads.phonenumber as phonenumber, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblleads.id and rel_type="lead" ORDER by tag_order ASC LIMIT 1) as tags, firstname as assigned_firstname, tblleadsstatus.name as status_name, tblleadssources.name as source_name, lastcontact, dateadded ,junk,lost,color,status,assigned,lastname as assigned_lastname,tblleads.addedfrom as addedfrom,(SELECT leadid FROM tblclients WHERE leadid=tblleads.id) as is_converted,zip
    FROM tblleads
    LEFT JOIN tblstaff ON tblstaff.staffid = tblleads.assigned LEFT JOIN tblleadsstatus ON tblleadsstatus.id = tblleads.status LEFT JOIN tblleadssources ON tblleadssources.id = tblleads.source
    
    WHERE  lost = 0 AND junk = 0 AND status IN (2,3,4)
    
    ORDER BY dateadded DESC
    LIMIT 0, 25
    
ERROR - 2020-07-21 09:55:39 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-07-21 09:55:39 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, tblleads.id as id, tblleads.name as name, company, tblleads.email as email, tblleads.phonenumber as phonenumber, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblleads.id and rel_type="lead" ORDER by tag_order ASC LIMIT 1) as tags, firstname as assigned_firstname, tblleadsstatus.name as status_name, tblleadssources.name as source_name, lastcontact, dateadded ,junk,lost,color,status,assigned,lastname as assigned_lastname,tblleads.addedfrom as addedfrom,(SELECT leadid FROM tblclients WHERE leadid=tblleads.id) as is_converted,zip
    FROM tblleads
    LEFT JOIN tblstaff ON tblstaff.staffid = tblleads.assigned LEFT JOIN tblleadsstatus ON tblleadsstatus.id = tblleads.status LEFT JOIN tblleadssources ON tblleadssources.id = tblleads.source
    
    WHERE  lost = 0 AND junk = 0 AND status IN (2,3,4)
    
    ORDER BY dateadded DESC
    LIMIT 0, 25
    
ERROR - 2020-07-21 10:12:16 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-07-21 10:12:16 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, tblleads.id as id, tblleads.name as name, company, tblleads.email as email, tblleads.phonenumber as phonenumber, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblleads.id and rel_type="lead" ORDER by tag_order ASC LIMIT 1) as tags, firstname as assigned_firstname, tblleadsstatus.name as status_name, tblleadssources.name as source_name, lastcontact, dateadded ,junk,lost,color,status,assigned,lastname as assigned_lastname,tblleads.addedfrom as addedfrom,(SELECT leadid FROM tblclients WHERE leadid=tblleads.id) as is_converted,zip
    FROM tblleads
    LEFT JOIN tblstaff ON tblstaff.staffid = tblleads.assigned LEFT JOIN tblleadsstatus ON tblleadsstatus.id = tblleads.status LEFT JOIN tblleadssources ON tblleadssources.id = tblleads.source
    
    WHERE  lost = 0 AND junk = 0 AND status IN (2,3,4)
    
    ORDER BY dateadded DESC
    LIMIT 0, 25
    
ERROR - 2020-07-21 10:13:07 --> Severity: Warning --> mysqli::query(): (21000/1242): Subquery returns more than 1 row C:\xampp\htdocs\signature\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2020-07-21 10:13:07 --> Query error: Subquery returns more than 1 row - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS 1, tblleads.id as id, tblleads.name as name, company, tblleads.email as email, tblleads.phonenumber as phonenumber, (SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblleads.id and rel_type="lead" ORDER by tag_order ASC LIMIT 1) as tags, firstname as assigned_firstname, tblleadsstatus.name as status_name, tblleadssources.name as source_name, lastcontact, dateadded ,junk,lost,color,status,assigned,lastname as assigned_lastname,tblleads.addedfrom as addedfrom,(SELECT leadid FROM tblclients WHERE leadid=tblleads.id) as is_converted,zip
    FROM tblleads
    LEFT JOIN tblstaff ON tblstaff.staffid = tblleads.assigned LEFT JOIN tblleadsstatus ON tblleadsstatus.id = tblleads.status LEFT JOIN tblleadssources ON tblleadssources.id = tblleads.source
    
    WHERE  lost = 0 AND junk = 0 AND status IN (2,3,4)
    
    ORDER BY dateadded DESC
    LIMIT 0, 25
    
ERROR - 2020-07-21 10:41:58 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\models\Projects_model.php 220
ERROR - 2020-07-21 10:41:58 --> Severity: Notice --> unserialize(): Error at offset 0 of 1 bytes C:\xampp\htdocs\signature\application\controllers\admin\Projects.php 130
ERROR - 2020-07-21 17:13:09 --> Severity: error --> Exception: syntax error, unexpected 'p' (T_STRING) C:\xampp\htdocs\signature\application\controllers\Proposal.php 172
ERROR - 2020-07-21 17:14:16 --> Severity: error --> Exception: syntax error, unexpected 'p' (T_STRING) C:\xampp\htdocs\signature\application\controllers\Proposal.php 172
ERROR - 2020-07-21 17:14:37 --> Severity: error --> Exception: syntax error, unexpected 'print_r' (T_STRING) C:\xampp\htdocs\signature\application\controllers\Proposal.php 172
ERROR - 2020-07-21 17:14:53 --> Severity: error --> Exception: syntax error, unexpected 'print_r' (T_STRING) C:\xampp\htdocs\signature\application\controllers\Proposal.php 172
ERROR - 2020-07-21 11:18:54 --> Severity: Notice --> Trying to get property 'hourly_rate' of non-object C:\xampp\htdocs\signature\application\controllers\Proposal.php 165
ERROR - 2020-07-21 11:18:54 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\signature\application\controllers\Proposal.php 169
ERROR - 2020-07-21 11:19:18 --> Severity: Notice --> Trying to get property 'hourly_rate' of non-object C:\xampp\htdocs\signature\application\controllers\Proposal.php 165
ERROR - 2020-07-21 11:21:49 --> Severity: Warning --> mkdir(): No such file or directory C:\xampp\htdocs\signature\application\helpers\upload_helper.php 935
ERROR - 2020-07-21 11:21:49 --> Severity: Warning --> fopen(C:\xampp\htdocs\signature\uploads/proposals/4/index.html): failed to open stream: No such file or directory C:\xampp\htdocs\signature\application\helpers\upload_helper.php 936
ERROR - 2020-07-21 11:21:50 --> Severity: Warning --> fopen(C:\xampp\htdocs\signature\uploads/proposals/4/signature.png): failed to open stream: No such file or directory C:\xampp\htdocs\signature\application\helpers\misc_helper.php 185
ERROR - 2020-07-21 11:21:50 --> Severity: Warning --> fwrite() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\signature\application\helpers\misc_helper.php 187
ERROR - 2020-07-21 11:21:50 --> Severity: Warning --> fclose() expects parameter 1 to be resource, boolean given C:\xampp\htdocs\signature\application\helpers\misc_helper.php 192
ERROR - 2020-07-21 11:21:50 --> Severity: Notice --> Undefined variable: systemBCC C:\xampp\htdocs\signature\application\controllers\Proposal.php 320
ERROR - 2020-07-21 11:21:53 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\signature\system\core\Exceptions.php:271) C:\xampp\htdocs\signature\system\helpers\url_helper.php 561
