<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
        <p class="t cent botli"><?=$DB->title;?></p>
        <form method="post" action="api/edit.php?do=<?=$DB->table;?>">
    <table width="100%">
    	<tbody>
        <!-- 標題列     -->
        <tr class="yel">
        	    
                <td width="30%"><?=$DB->header;?></td> 
                <td width="30%"><?=$DB->append;?></td>  
                <td width="10%">次選單數</td>
                <td width="10%">顯示</td>
                <td width="10%">刪除</td>
                <td width="10%"></td>
            </tr>


        <?php
           //以$rows代表多筆、複數的
            $rows=$DB->all(['parent'=>0]);
            foreach($rows as $row){  //很多筆的其中一筆
                $checked=($row['sh']==1)?'checked':'';
        ?>
            <tr> 
                <!-- 標題列內容  -->
                <!-- 主選單名稱 -->
                <td >
                    <input type="text" name="name[]" value="<?=$row['name'];?>">
                </td>

                <!-- 選單連結網址 -->
                <td >
                    <input type="text" name="href[]" value="<?=$row['href'];?>">
                </td>

                <!-- 次選單名稱 -->
                <td>
                    <?=$DB->math('count','*',['parent'=>$row['id']]);?>
                </td>

                <!-- 顯示 -->
                <td >
                    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked;?>>
                </td>

                <td >
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                </td>
              
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                <td>
                <!-- 從back/image.php複製以下button來改 -->
                <input type="button"
                onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/submenu.php?id=<?=$row['id'];?>&#39;)" 
                value="編輯次選單">   
                </td>
         
            </tr>

        <?php  } ?>

    </tbody></table>
           <table style="margin-top:40px; width:70%;">
     <tbody>
         <tr>
      <td width="200px"><input type="button"                                                  
          onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/<?=$DB->table;?>.php?table=<?=$DB->table;?>&#39;)" 
          value="<?=$DB->button;?>">
        </td>
          <td class="cent">
              <input type="submit" value="修改確定">
              <input type="reset" value="重置"></td>
        <!-- 彈出視窗modal(完整op function寫在js.js)  -->
        <!-- 在bake.php可找到，預設為display-none，所以看不到 -->
        </tr>
    </tbody>
</table>    
</form>
</div>