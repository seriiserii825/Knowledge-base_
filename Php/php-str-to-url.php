function strToUrl($value){
   return strtolower(preg_replace('/\s+/', '_', $value));
}
