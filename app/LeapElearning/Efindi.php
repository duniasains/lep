<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Efindi
 *
 * @author User
 */
class Efindi extends WebService{
    public $access_nilaiku = "murid";
    public function nilaiku(){
        //header('Content-type: application/pdf');
        //die();
        //$json = array("nama"=>"efindi","id"=>10);
        
        //echo json_encode($json);
        //echo "nilai";
        //exit();
        
        //echo "<xml><pohon><daun>nilai</daun></pohon></xml>";
        
        ?>
<b onclick='$("#editnilaiku").load("<?=_SPPATH;?>Efindi/edit_nilaiku");'>edit nilai</b>    
<br>
<b onclick='$.get("<?=_SPPATH;?>Efindi/edit_nilaiku",
            function(abuii){
                var obj = jQuery.parseJSON( abuii );
                $( "#editnilaiku" ).html( obj.form );
                $( "#abuikeren" ).html( obj.murid.nama_depan );
                 $( "#namadepan" ).html( obj.murid.nama_depan );
                  $( "#namabelakang" ).html( obj.murid.alamat );
                   $( "#foto" ).html( obj.murid.foto );
                  
            });'>get edit nilai</b>   <br>
<b onclick='$.post("<?=_SPPATH;?>Efindi/edit_nilaiku");'>post edit nilai</b> 
<div id="editnilaiku">
    
</div>       
<div id='abuikeren' style="position: absolute; right: 0; width: 100px; height: 100px; top:0; background-color: red;">
    
</div>

<span id='namadepan'></span>
<span id='namabelakang'></span>
<span id='foto'></span>
        <?
    }
    public function edit_nilaiku(){
        
       $murid = new Murid();
       $murid->getByID(700);
       
       
        
      $form = '
<form>
    <input type="text" placeholder="nilai">
</form>    ';
      
      $name = "Efindi";
      $id = 10;
      
      $jsonArray = array("form"=>$form,"name"=>$name,"id"=>$id,"murid"=>$murid);
      echo json_encode($jsonArray);
            
        
    }
}
