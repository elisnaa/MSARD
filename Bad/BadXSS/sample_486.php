<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: settype_prm__<s>(string) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
- Sink: print_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. The ; can be used to chain commands
-->
<?php
# Init

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
if(settype($tainted, "string"))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $pre = "<script>alert(Hello";
  $post = ");</script>";
  $context = ($pre . ($dataflow . $post));
  print($context);
}

?>