<?php

class TagSynonymous {

    function __construct() {
//        $new = new TagsSynonymous();
//        $resultado = $new ->sendGet("casa");
//        var_dump($resultado);
    }//End construct
    
    function sendGet($entrada){
        
        $data = array("a" => "a");
        
        $ch = curl_init("http://sesat.fdi.ucm.es:8080/servicios/rest/sinonimos/json/".$entrada);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        
        $response = curl_exec($ch);
        
        curl_close($ch);
        
        if(!$response) {
            return false;
        }else{
            var_dump($response);
        }//End if(!$response) 
        
    }//End sendGet
    
}//End class TagsSynonymous