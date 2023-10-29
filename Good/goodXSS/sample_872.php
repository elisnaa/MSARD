<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: is_int ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_javascript
- Sink: exit

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
if(is_int($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $pre = "<script>alert(\"Hello";
  $post = "\");</script>";
  $context = ($pre . ($dataflow . $post));
  exit($context);
}

?>