<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_UNSAFE_RAW) ==> Filters:[]
- Sanitization: fnmatch_prm__<s>(*)_<i>(0) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_plain
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>
-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_UNSAFE_RAW);
if(fnmatch("*", $tainted, 0))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = ("Hello" . $dataflow);
  trigger_error($context, E_USER_ERROR);
}

?>