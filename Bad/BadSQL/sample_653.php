<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: settype_prm__<s>(string) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: sql_plain
- Sink: pdo_prepare_prm__<$>(pdo)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
if(settype($tainted, "string"))
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