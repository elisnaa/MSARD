<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: gettype_check_prm__<s>(string) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: sql_plain
- Sink: pg_query_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$db = pg_pconnect("host=postgres-server port=5432 user=postgres password=postgres123 dbname=myDB");


# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
if(gettype($tainted) == "string")
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
  $result = pg_query($db, $context);
  while(($row = pg_fetch_row($result)))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>