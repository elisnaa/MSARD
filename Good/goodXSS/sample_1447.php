<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: is_real ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
- Sink: vprintf_prm__<s>(This%s)

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
if(is_real($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $pre = "<script>alert(Hello";
  $post = ");</script>";
  $context = ($pre . ($dataflow . $post));
  vprintf("This%s", $context);
}

?>