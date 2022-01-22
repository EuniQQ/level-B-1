<?php  include_once "../base.php";

/**
 * 判斷$_POST中沒有id這個項目，有的話表示有資料要編輯，
 * 沒有的話表示資料表中還沒有資料。
 */

if(isset($_POST['id'])){
    //因為次選單可能有多筆資料，所以使用回圈來一筆一筆處理
    foreach($_POST['id'] as $key=>$id){

        //首先判斷$_POST中沒有del這個項目，有的話表示有資料要刪除
        //接著判斷目前迴圈輪到的id有沒有在$_POST['del']中
        //有的話表示目這一筆id的次選單是需要刪除的
        if(isset($_POST['del']) && in_array($id,$_post['del'])){

            
            $Menu->del($id);
        }else{
            //需要編輯的資料先把資料撈出來
            $sub=$Menu->find($id);
            //依序更新name及href資料;
            $sub['name']=$_POST['name']['$key'];
            $sub['href']=$_POST['href']['$key'];
            //存回資料表
            $Menu->save($sub);
        }
    }
}

//判斷$_POST中是否有name2這個項目，有的話表示有資料要新增
if(isset($_POST['name2'])){
    //新增的資料可能多筆，因此使用迴圈來一筆一筆處理
    foreach($_POST['name2'] as $key=>$name){
        //判斷name的內容是否為空值，如果是空值則不新增
        if($name!=''){

            
            
                        //將name和對應的href2欄位內容寫入資料表
            $Menu->save(['name'=>$name,
                         'href'=>$_POST['href2'][$key],
                         'sh'=>1,       //預設sh欄位都是1，
                         'parent'=>$_GET['main']]);      
                         //主選單parent欄位為表單傳送過來的$_GET['main']
        }
    }
}

//導回後台的選單管理頁面
to("../back.php?do=".$Menu->table);

