<?php
include_once "../base.php";

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);

    //先取出該筆資料
    $data=$DB->find($_POST['id']);

    //更新img欄位的內容
    $data['img']=$_FILES['img']['name'];

    //資料寫入資料表
    $DB->save($data);
}

to("../back.php?do=".$DB->table);

?>