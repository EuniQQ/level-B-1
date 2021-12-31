<h3>新增最新消息資料</h3>
<hr>
                           
<form action="api/add.php?do=<?=$_GET['table'];?>" method="post" enctype="multipart/-form-data">    
    <table>
        
        <tr>
            <td>最新消息資料</td>
            <td>
                <!-- textarea的特性：若程式碼換行，顯示結果就會有一個空白 -->
                <textarea name="text" style="width:95%;height:60px;"></textarea>
            </td>
        </tr>
    </table>
     <div><input type="submit" value="新增"><input type="reset" value="重置"></div>
    
</form>
