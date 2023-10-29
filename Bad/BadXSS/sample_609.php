<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: json_encode_prm__<c>(JSON_PRETTY_PRINT)_<i>(512) ==> Filters:[Filtered(&), Escape[\](\)]
- Filters complete: Filters:[Filtered(&), Escape[\](\)]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: echo_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. It is possible to create a javascript context with: javascript:alert(1)
-->
<?php
# Init

# Sample
$tainted = $_GET;
$sanitized = json_encode($tainted, JSON_PRETTY_PRINT, 512);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
echo($context);

?>