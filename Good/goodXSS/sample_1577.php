<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: is_double ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
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
if(is_double($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $pre = "<script>alert(Hello";
  $post = ");</script>";
  $context = ($pre . ($dataflow . $post));
  trigger_error($context, E_USER_ERROR);
}

?>