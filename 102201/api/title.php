<?php 

include "../base.php";

//如果tmp_name(圖片暫存路徑)不是空白(表示上傳成功)
if(!empty($_FILES['img']['tmp_name'])){ 
    //將圖片移到img資料夾並加上檔名
    move_uploaded_file($_FILES['tmp_name'],"../img/".$_FILES['img']['name']);
    //因為之後做save時是用陣列，先設一個變數，資料表的名稱就是欄位名稱
    //$data變數有img，圖片檔名就是上傳的圖片檔名
    $data['img']=$_FILES['img']['name'];
}

//Title資料表中text的欄位內容
$data['text']=$_POST['text'];
$data['sh']=0; 
$Title->save($data); //將以上的資料存進Title資料表
//to("../back.php?do=".$Title->table)


// dd($_POST);
// dd($_FILES);

?>