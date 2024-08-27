ENT_QUOTES - Quote style: Convert double-quotes and single-quotes to html entities
$immobili = htmlentities(json_encode(array_merge($immobiliPortaParma, $immobiliBellavista, $immobiliIlSole, $immobiliRiviera)), ENT_QUOTES);
