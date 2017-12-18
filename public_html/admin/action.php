<?php 

include 'feacturesclass.php';

$action = $_POST['featstatus'];




if (isset($_POST['action'])){
    switch ($_POST['action']) {
        case 'featupdate':
                
                $url = $POST['featurl'];
                $caption = $POST['featcaption'];
                $file = $POST['featfile:file'];
                $fid =$POST['featid'];

                $feact = new feacture();

                //if ($fid > 0 ){
                $feact->insertFeact($url , $file , $caption);
                //}else {
                //$feact->updateFeact() ;

                return true ;
                }


    
    
    }//end switch




}


?>