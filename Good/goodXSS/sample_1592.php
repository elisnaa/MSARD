<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: settype_prm__<s>(int) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
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
$tainted = $tainted["t"];
if(settype($tainted, "int"))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("<a href=\"" . $dataflow) . "\">link</a>");
  vprintf("This%s", $context);
}

?>