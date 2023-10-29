<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: ctype_alnum ==> Filters:[specials]
- Filters complete: Filters:[specials]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
- Sink: print_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
if(ctype_alnum($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $pre = "<script>alert(Hello";
  $post = ");</script>";
  $context = ($pre . ($dataflow . $post));
  print($context);
}

?>