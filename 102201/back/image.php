<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
        <!-- <p class="t cent botli">網站標題管理</p> -->
        <p class="t cent botli"><?=$DB->title;?></p>
        <!-- 表單送出的action為同一個edit.php，為了區別是那個功能送出的資料， -->
        <!-- 所以我們加上了資料表名讓api可以識別 -->
    <form method="post" action="api/edit.php?do=<?=$DB->table;?>">
        <table width="100%">
  
        <!-- 標題列     -->
        <tr class="yel">
        	    <td width="70%"><?=$DB->header?></td>
                <td width="10%">顯示</td>
                <td width="10%">刪除</td>
                <td></td>
            </tr>


        <?php
           
            $rows=$DB->all();
            foreach($rows as $row){  
                $checked=($row['sh']==1)?'checked':'';
        ?>

            

            <tr>
        	    <td >
                    <img src="./img/<?=$row['img'];?>" style="width:100px;height:68px">
                </td>
                
                <td>
                    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked;?>>
               
                </td>
                <td >
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
  
                </td>
                <td>

            <input type="hidden" name="id[]" value="<?=$row['id'];?>">
            <!-- 更新動畫按鈕 -->
            <input type="button"
            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/upload.php?do=<?=$DB->table;?>&id=<?=$row['id'];?>&#39;)" 
            value="更新圖片">
           
             </td>
         </tr>
    
         <?php  } ?>
    
        </table>

        <table style="margin-top:40px; width:70%;">
            <tr>
                <!-- 新增動畫按鈕 -->
                <td width="200px"><input type="button"                   
                onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/<?=$DB->table;?>.php?table=<?=$DB->table;?>&#39;)"
                value="<?=$DB->button?>">  
                                                                         <!-- 因為都是table名稱-->
                </td>
                  <td class="cent">
                      <input type="submit" value="修改確定">
                      <input type="reset" value="重置"></td>
                <!-- 彈出視窗modal(完整op function寫在js.js)  -->
                <!-- 在bake.php可找到，預設為display-none，所以看不到 -->
            </tr>
        </table>    

    </form>
</div>