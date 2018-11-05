<?PHP
require_once("./include/registration.php");

$configuration = new Configuration();

$configuration->SetWebsiteName('Accordingly.com');

$configuration->SetAdminEmail('thares96@gmail.com');

$configuration->InDB(/*hostname*/'capstonedb.cmste82q8owq.us-east-1.rds.amazonaws.com:3306',
                      /*username*/'thares96',
                      /*password*/'Guitars6',
                      /*database name*/'projectdb',
                      /*table name*/'users');
?>