
<h3>新增校園映像圖片</h3>
<hr>
             
<form action="api/add.php?do=<?=$_GET['table'];?>" method="post" enctype="multipart/form-data">    
                                    
    <table>
        <tr>
            <td>校園映像圖片:</td>
            <td><input type="file" name="img"></td> 
            <!-- name欄位跟資料表是一致的 -->
        </tr>

    </table>
   <!-- 打法:div>input:submit + input>reset -->
    <div><input type="submit" value="新增"><input type="reset" value="重置"></div>
    
</form>