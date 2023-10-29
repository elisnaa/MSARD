<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: ctype_cntrl ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: sql_plain
- Sink: pdo_prepare_prm__<$>(pdo)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = $_COOKIE;
$tainted = $tainted["t"];
if(ctype_cntrl($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
  $stmt = $pdo->prepare($context);
  $results = $stmt->execute([]);
  foreach ($stmt->fetchAll() as $row){
    echo(htmlentities(print_r($row, true)));
  }
}

?>