<?php

class TagReference {

    function __construct() {
        
    }//End construct
    
    function sendGetSynonymous($entradas){
        
        $retorna = [];
        
        foreach ($entradas as $entrada) {
            
            $data = array("a" => "a");
        
            $ch = curl_init("http://sesat.fdi.ucm.es:8080/servicios/rest/sinonimos/json/".$entrada->getTagword());

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            
            $response = curl_exec($ch);
            
            curl_close($ch);
            
            if(!$response) {
                return false;
            }else{
                foreach (json_decode($response,true) as $value) {
                    foreach ($value as $v){
                        foreach ($v as $va){
                            array_push($retorna,$va );
                        }                        
                    }                    
                }                
            }//End if(!$response)
            
        }//End foreach ($entradas as $entrada)
        
        return $retorna;
        
    }//End sendGet
    
     public function sendGetConcepts($entradas)
        {
             $retorna = [];
        
        foreach ($entradas as $entrada) {
            
            $data = array("a" => "a");
        
            $ch = curl_init("http://sesat.fdi.ucm.es:8080/servicios/rest/definicion/json/".$entrada->getTagword());

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            
            $response = curl_exec($ch);
            
            curl_close($ch);
            
            if(!$response) {
                return false;
            }else{
                foreach (json_decode($response,true) as $value) {
                    foreach ($value as $v){
                        foreach ($v as $va){
                            array_push($retorna,$va );
                        }                        
                    }                    
                }                
            }//End if(!$response)
            
        }//End foreach ($entradas as $entrada)
        return $retorna;
        }

    
}//End class TagReference 