<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: metaphone_prm__<i>(9) ==> Filters:[nums, specials, Filtered(c, d, v, w, g, h, x, y, z)]
- Filters complete: Filters:[nums, specials, Filtered(c, d, v, w, g, h, x, y, z)]
- Dataflow: assignment
- Context: sql_quotes
- Sink: mssql_sqlsrv_prepare_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

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
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = metaphone($tainted, 9);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$stmt = sqlsrv_prepare($db, $context);
$result = sqlsrv_execute($stmt);
while(($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)))
{
  echo(htmlentities(print_r($row, true)));
}

?>