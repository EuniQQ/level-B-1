<?php 

include_once "../base.php";

//如果tmp_name(圖片暫存路徑)不是空白(表示上傳成功)
if(!empty($_FILES['img']['tmp_name'])){ 
    //將圖片移到img資料夾並加上檔名
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    //因為之後做save時是用陣列，先設一個變數，資料表的名稱就是欄位名稱
    //$data變數有img，圖片檔名就是上傳的圖片檔名
    $data['img']=$_FILES['img']['name'];
}else{
    //排除admin和menu這兩張沒有img欄位的資料表
    if($DB->table!='admin' && $DB->table!='menu'){
    //沒有檔案上傳時img欄位寫入空值
        $data['img']='';
    }
}

//Title資料表中text的欄位內容
// $data['text']=$_POST['text'];
// $data['sh']=0; 
// $Title->save($data); 將以上的資料存進Title資料表


//針對欄位不同的資料表名稱各別處理
switch($DB->table){
    case "title":
        $data['text']=$_POST['text'];  
        $data['sh']=0;
        break;
        
    case "admin":
        $data['acc']=$_POST['acc'];
        $data['pw']=$_POST['pw'];
        break;
        
    case "menu":
        $data['name']=$_POST['name'];
        $data['href']=$_POST['href'];
        $data['sh']=1;
        $data['parent']=0;
        // 因為modal裡是新增主選單(parent=0)
        break;
            
        default: //欄位格式相同的資料表統一在default區段處理
        $data['text']=$_POST['text']??'';
        //並不是每個modal裡都有文字欄位的需求，所以加入判斷$_POST['text']這個變數是否存在，
        //有就使用，不存在就空著
        $data['sh']=1;
        break;       
}

//因為有帶do的值過來，所以$DB這個變數一定存在($DB是bake.php的大變數)
$DB->save($data);
to("../back.php?do=".$DB->table)


// dd($_POST);
// dd($_FILES);

?>