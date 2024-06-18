<?php 
    include ('models/mpef.php');

    $mpef = new Mpef();

    $idpef = isset($_REQUEST['idpef']) ? $_REQUEST['idpef']:NULL;
    $nompef = isset($_POST['nompef']) ? $_POST['nompef']:NULL;
    $idpag = isset($_POST['idpag']) ? $_POST['idpag']:NULL;
    $idmod = isset($_POST['idmod']) ? $_POST['idmod']:NULL;
    $chk = isset($_POST['chk']) ? $_POST['chk']:NULL;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

    $mpef->setIdpef($idpef);
    if($ope=="savepxp"){ 
        if($idpef) $mpef->delPXP();
        if($chk){ foreach($chk AS $ck){
            $mpef->setIdpag($ck);
            $mpef->savePxP();
        }}
        echo "<script>window.location='home.php?pg=4';</script>";
    }
    
    //guardar 
    if($ope=="save"){
        $mpef->setNompef($nompef);
        $mpef->setIdmod($idmod);
        $mpef->setIdpag($idpag);
        if(!$idpef) $mpef->save(); else $mpef->edit(); //si la variable esta vacia guarda sino edita
    }

    $datOne = NULL;
     //Insertar
    if($ope=="edi" && $idpef)  $datOne = $mpef->getOne();
    
//mostrar todos los datos
    $dat = $mpef->getAll();
    $datpag = $mpef->getPag();
    $datmod = $mpef->getMod();
    /*$datgraf = $mpef->getAllGraf();
    $datGrfa = $mpef->getGraphi(); */


//FUNCION GRAFICA
    /*$grfa= $datGrfa[COUNT($datGrfa)-1];
    $txt= "";
    $txt= "[";
    if($datGrfa){foreach ($datGrfa AS $d => $dgfa){
        $txt.="['".$dgfa['pefnom']."',".$dgfa['cn']."]";
        if($grfa!=$dgfa)$txt.=",";
    }}
    $txt .="]";
*/?>