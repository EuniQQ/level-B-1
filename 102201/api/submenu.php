<?php  include_once "../base.php";

if(isset($_POST['id'])){
    foreach($_POST['id'] as $key=>$id){
        if(isset($_POST['del']) && in_array($id,$_post['del'])){
            $Menu->del($id);
        }else{
            $sub=$Menu->find($id);
            $sub['name']=$_POST['name']['$key'];
            $sub['href']=$_POST['href']['$key'];
            $Menu->save($sub);
        }
    }
}

to("../back.php?do=".$Menu->table);

