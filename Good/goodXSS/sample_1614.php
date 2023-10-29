<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: preg_match_all_prm__<s>(_^[A-Za-z0-9]*$_) ==> Filters:[specials]
- Filters complete: Filters:[specials]
- Dataflow: assignment
- Context: xss_html_param
- Sink: printf_func_prm__<s>(Print this: %d)

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
if(preg_match_all("/^[A-Za-z0-9]*$/", $tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("<img src=\"" . $dataflow) . "\"/>");
  printf("Print this: %d", $context);
}

?>