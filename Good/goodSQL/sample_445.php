<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: cast_prm__TYPE_DOUBLE ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
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
$sanitized = (double)($tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$stmt = sqlsrv_prepare($db, $context);
$result = sqlsrv_execute($stmt);
while(($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)))
{
  echo(htmlentities(print_r($row, true)));
}

?>