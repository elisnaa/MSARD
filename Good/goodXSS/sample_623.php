<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: sizeof_prm__<c>(COUNT_NORMAL) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: vprintf_prm__<s>(This%s)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_POST;
$sanitized = sizeof($tainted, COUNT_NORMAL);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
vprintf("This%s", $context);

?>