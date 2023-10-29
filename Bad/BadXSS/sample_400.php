<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: str_getcsv_prm_ ==> Filters:[Filtered(,)]
- Filters complete: Filters:[Filtered(,)]
- Dataflow: assignment
- Context: xss_quotes
- Sink: user_error_prm_

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>
2. Quotes are useless inside plain html context for XSS
-->
<?php
# Init

# Sample
$tainted = apache_request_headers();
$tainted = $tainted["t"];
$sanitized = str_getcsv($tainted);
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
user_error($context);

?>