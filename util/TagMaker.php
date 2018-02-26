<?php

require_once '../domain/Tag.php';
require '../util/TagReference.php';
require '../util/TranslateEToS.php';
require '../util/TranslateSToE.php';

class TagMaker {

    function makeTags($entireWord, $activityId) {
        //////

        $tagReference = new TagReference();
        //separar las palabras del titulo y la descripcion 
        $allWords = explode(" ", $entireWord);
        $words = array();

        foreach ($allWords as $word) {
            if (strlen($word) >= 4) {
                $tag = new Tag();
                $tag->setTagactivityid($activityId);
                $tag->setTagword($word);
                $tag->setTagRelation($word);
                array_push($words, $tag);
            }
        }

        // funciones
        $synonymous = $this->synonymousExploder($words, $activityId);



        $concepts = $this->conceptsExploder($words, $activityId);

        //arreglo con: palabras, sus sinonimos y sus conceptos
        $entireArray = array_merge($words, $synonymous, $concepts);
        ////

        return $entireArray;
    }

    function synonymousExploder($words, $activityId) {
        $tagReference = new TagReference();
        $position = 0;


        //retorna los sinonimos de las palabra
        $allsynonymous = $tagReference->sendGetSynonymous($words);
        $synonymous = array();

        //relaciona los sinonimos con la actividad
        foreach ($allsynonymous as $synonym) {
            if (is_numeric($synonym)) {
                $position = $position + 1;
           
            } else {
                $tag = new Tag();
                $tag->setTagactivityid($activityId);
                $tag->setTagword($synonym);
                $tag->setTagrelation($words[$position - 1]->getTagRelation());
            }
        }

        return $synonymous;
    }

    function conceptsExploder($words, $activityId) {
        $tagReference = new TagReference();
        
        $position = 0;
        //retorna los conceptos de las palabras
        $entireConceptsWords = $tagReference->sendGetConcepts($words);
        $uniteConcepts = '|';
        
 

        foreach ($entireConceptsWords as $divConcepts) {
          
            if (strcmp($uniteConcepts, '|') == 0) {
       
                $uniteConcepts = $divConcepts;
            } else {
       
                $uniteConcepts = $uniteConcepts . '- ' . $divConcepts . " ";
            }
        }
        
            //separar y limpiar los conceptos en palabras
            $uniteConcepts = str_replace(',', ' ', $uniteConcepts);
            $uniteConcepts = str_replace('.', ' ', $uniteConcepts);
            $uniteConcepts = str_replace('-', ' ', $uniteConcepts);
            $uniteConcepts = str_replace(':', ' ', $uniteConcepts);
            $uniteConcepts = str_replace(';', ' ', $uniteConcepts);
            $uniteConcepts = str_replace("'", ' ', $uniteConcepts);
            $uniteConcepts = strtolower($uniteConcepts);
            $allConcepts = explode(" ", $uniteConcepts);

            $concepts = array();
            
            foreach ($allConcepts as $concept) {
                if (strlen($concept) >= 4 and ( strcmp($concept[0], '[') != 0) and ( strcmp($concept[strlen($concept) - 1], ']') != 0)) {
                    //relacionar los conceptos con la actividad
                 
                        $tag = new Tag();
                        $tag->setTagactivityid($activityId);
                        $tag->setTagword($concept);
                        $tag->setTagRelation($words[$position - 1]->getTagRelation());
                        array_push($concepts, $tag);
                    
                }else{
                    if(is_numeric($concept)){
                        $position = $position + 1;
                    }
                }
            }
            
        return $concepts;
        }
    

    function commentCoincidenceWithActivity($activityTags, $commentWords) {
        $activityTagMaxSize = count($activityTags);
        $commentTagCoincidence = 0;

        foreach ($commentWords as $commentWord) {

            foreach ($activityTags as $activityTag) {

                $currentWord = $activityTag[1];


                if (strcasecmp($commentWord, $currentWord) == 0) {
                    if ($commentTagCoincidence == 0) {
                        $commentTagCoincidence = 1;
                    } else {
                        $commentTagCoincidence = $commentTagCoincidence + 1;
                    }
                }
            }
        }

        return $commentTagCoincidence;
    }

}
