<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: is_float ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: sql_plain
- Sink: pg_query_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$db = pg_pconnect("host=postgres-server port=5432 user=postgres password=postgres123 dbname=myDB");


# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
if(is_float($tainted))
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