<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: gettype_check_prm__<s>(double) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
if(gettype($tainted) == "double")
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("Hello to '" . $dataflow) . "'");
  trigger_error($context, E_USER_ERROR);
}

?>