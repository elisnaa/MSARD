<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: http_build_query_prm_ ==> Filters:[Filtered( , , , , , , , , , 	, 
, , , , , , , , , , , , , , , , , , , , , ,  , !, ", #, $, %, &, ', (, ), *, +, ,, /, :, ;, <, =, >, ?, @, [, \, ], ^, `, {, |, }, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ,  , ¡, ¢, £, ¤, ¥, ¦, §, ¨, ©, «, ¬, ­, ®, ¯, °, ±, ², ³, ´, ¶, ·, ¸, ¹, », ¼, ½, ¾, ¿, ×, ÷)]
- Filters complete: Filters:[Filtered( , , , , , , , , , 	, 
, , , , , , , , , , , , , , , , , , , , , ,  , !, ", #, $, %, &, ', (, ), *, +, ,, /, :, ;, <, =, >, ?, @, [, \, ], ^, `, {, |, }, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ,  , ¡, ¢, £, ¤, ¥, ¦, §, ¨, ©, «, ¬, ­, ®, ¯, °, ±, ², ³, ´, ¶, ·, ¸, ¹, », ¼, ½, ¾, ¿, ×, ÷)]
- Dataflow: assignment
- Context: xss_javascript
- Sink: print_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = getallheaders();
$sanitized = http_build_query($tainted);
$dataflow = $sanitized;
$pre = "<script>alert(\"Hello";
$post = "\");</script>";
$context = ($pre . ($dataflow . $post));
print($context);

?>