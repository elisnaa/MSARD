<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: json_encode_prm__<c>(JSON_PRETTY_PRINT)_<i>(512) ==> Filters:[Filtered(&), Escape[\](\)]
- Filters complete: Filters:[Filtered(&), Escape[\](\)]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: sqlsrv_query_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. Escape the apostrophe with '
3. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$info = ["Database" => "myDB", "UID" => "SA", "PWD" => "Msql12345678!"];
$db = sqlsrv_connect("mssql", $info);
if($db == false)
{
  die(print_r(sqlsrv_errors(), true));
}


# Sample
$tainted = getallheaders();
$sanitized = json_encode($tainted, JSON_PRETTY_PRINT, 512);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
$result = sqlsrv_query($db, $context);
while(($row = sqlsrv_fetch_object($result)))
{
  echo(htmlentities(print_r($row, true)));
}

?>