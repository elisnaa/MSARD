<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: password_hash_prm__<c>(PASSWORD_DEFAULT) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_plain
- Sink: print_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = apache_request_headers();
$tainted = $tainted["t"];
$sanitized = password_hash($tainted, PASSWORD_DEFAULT);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
print($context);

?>