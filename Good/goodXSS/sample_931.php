<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: intval ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_plain
- Sink: printf_func_prm__<s>(Print this: %d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = intval($tainted);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
printf("Print this: %d", $context);

?>