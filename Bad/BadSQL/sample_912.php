<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_ADD_SLASHES) ==> Filters:[Escape[\](", ', \)]
- Sanitization: str_replace_prm__<array>(<ae>(<s>(")), <ae>(<s>(')), <ae>(<s>(\<)) , <ae>(<s>(\>)))_<s>() ==> Filters:[Filtered(", ', <, >)]
- Filters complete: Filters:[Filtered(", ', <, >), Escape[\](", ', \)]
- Dataflow: assignment
- Context: sql_plain
- Sink: sqlite3_query_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$db = new SQLite3("/var/www/db/database.db");


# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_ADD_SLASHES);
$sanitized = str_replace(["\"", "'", "<", ">"], "", $tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
$results = $db->query($context);
while(($row = $results->fetchArray()))
{
  echo(htmlentities(print_r($row, true)));
}

?>