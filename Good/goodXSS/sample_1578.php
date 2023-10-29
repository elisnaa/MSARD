<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: cast_sortof_prm__<i>(0.0) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: echo_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = ($tainted + 0.0);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
echo($context);

?>