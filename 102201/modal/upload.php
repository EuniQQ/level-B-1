<?php include_once "../base.php";  //先匯入base.php來取得$DB變數  ?>

<h3>更新<?=$DB->upload;?></h3>
<hr>
                              <!-- 有上傳檔案就需要打enctype="multipart/-form-data -->
<form action="api/upload.php?do=<?=$DB->table;?>" method="post" enctype="multipart/-form-data">    
    <table>
        <tr>
            <td><?=$DB->upload;?>:</td>
            <td><input type="file" name="img"></td> 
            <!-- name欄位跟資料表是一致的 -->
        </tr>
        
    </table>
    <!-- 為了讓資料庫知道要更新的是哪一筆id -->
    <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
    <!-- 打法:div>input:submit + input>reset -->
    <div><input type="submit" value="更新"><input type="reset" value="重置"></div>
    
</form>