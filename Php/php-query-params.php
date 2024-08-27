<?php 
function getQueryParams($param) {
  parse_str($_SERVER['QUERY_STRING'], $queries);
  return $queries[$param];
}

?>
