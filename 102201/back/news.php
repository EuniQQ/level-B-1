<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
        <!-- <p class="t cent botli">網站標題管理</p> -->
        <!-- <p class="t cent botli"><?=$titleStr['title'];?></p> -->
        <p class="t cent botli"><?=$DB->title;?></p>
        <form method="post" action="../api/edit.php?do=<?=$DB->table;?>">
    <table width="100%">
    	<tbody>
        <!-- 標題列     -->
        <tr class="yel">
        	    
                <td width="80%">替代文字</td>
                <td width="10%">顯示</td>
                <td width="10%">刪除</td>
                
            </tr>


        <?php
           //老師習慣以$rows代表多筆、複數的
            $rows=$DB->all("limit $start,$div");
            foreach($rows as $row){  //很多筆的其中一筆
                $checked=($row['sh']==1)?'checked':'';
        ?>

            <!-- 預設情況下，表單input的name欄位中的會被放到$_POST的KEY值去。 -->
            <!-- 若是KEY值一樣就會被蓋過。所以要完整將資料送到後台，須將所有資料放到一個陣列中 -->
            <!-- 只要一次送出多筆，name值一律加中誇括號 -->

            <tr>  
                <td >
                    <!-- 新增的消息文字可能不只一筆，所以text要加[] -->
                    <textarea name="text[]" style="width:95%;height:60px" ><?=$row['text'];?></textarea>
                </td>
                <td >
                    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked?>>      
                </td>
                <td >
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                </td>
                     <input type="hidden" name="id[]" value="<?=$row['id'];?>">

            </tr>

        <?php  } ?>

    </tbody></table>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
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
    </tbody></table>    

        </form>
                                    </div>