<h3>新增動態文字廣告</h3>
<hr>
                              <!-- 本頁不需上傳但可留著無妨 -->
<form action="api/add.php?do=<?=$_GET['table'];?>" method="post" enctype="multipart/-form-data">    
    <table>
        
        <tr>
            <td>動態文字廣告</td>
            <td><input type="text" name="text"></td>
        </tr>
    </table>
   <!-- 打法:div>input:submit + input>reset -->
    <div><input type="submit" value="新增"><input type="reset" value="重置"></div>
    
</form>
