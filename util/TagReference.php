<?php

class TagReference {

    function __construct() {
        
    }//End construct
    
    function sendGetSynonymous($entradas){
        
        $retorna = [];
        
        foreach ($entradas as $entrada) {
            
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
                array_push($retorna,$response);
            }//End if(!$response)
            
        }//End foreach ($entradas as $entrada)
        
        return $retorna;
        
    }//End sendGet
    
}//End class TagReference 