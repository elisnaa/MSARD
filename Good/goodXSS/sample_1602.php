<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: sscanf_prm__<s>(foo %d) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
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
$sanitized = sscanf($tainted, "foo %d");
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
vprintf("This%s", $context);

?>