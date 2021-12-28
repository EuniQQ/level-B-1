<h3>更新標題區圖片</h3>
<hr>
                              <!-- 有上傳檔案就需要打enctype="multipart/-form-data -->
<form action="api/upload_title.php" method="post" enctype="multipart/-form-data">    
    <table>
        <tr>
            <td>標題區圖片:</td>
            <td><input type="file" name="img"></td> 
            <!-- name欄位跟資料表是一致的 -->
        </tr>
        
    </table>
   <!-- 打法:div>input:submit + input>reset -->
    <div><input type="submit" value="更新"><input type="reset" value="重置"></div>
    
</form>