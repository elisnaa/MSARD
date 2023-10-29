<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: str_ireplace_prm__<array>(<ae>(<s>(")), <ae>(<s>(')), <ae>(<s>(\<)) , <ae>(<s>(\>)))_<s>() ==> Filters:[Filtered(", ', <, >)]
- Filters complete: Filters:[Filtered(", ', <, >)]
- Dataflow: assignment
- Context: xss_quotes
- Sink: printf_func_prm__<s>(Print this: %s)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = str_ireplace(["\"", "'", "<", ">"], "", $tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
printf("Print this: %s", $context);

?>