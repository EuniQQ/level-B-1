<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
        <p class="t cent botli"><?=$DB->title;?></p>
        <form method="post" action="api/edit.php?do=<?=$DB->table;?>">
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
            $rows=$DB->all();
            foreach($rows as $row){  //很多筆的其中一筆
        ?>

            <!-- 預設情況下，表單input的name欄位中的會被放到$_POST的KEY值去。 -->
            <!-- 若是KEY值一樣就會被蓋過。所以要完整將資料送到後台，須將所有資料放到一個陣列中 -->
            <!-- 只要一次送出多筆，name值一律加中誇括號 -->

            <tr>  
                <td >
                    <input type="text" name="text[]" value="<?=$row['text'];?>">
                </td>
                <td >
                    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked?>>
                <!-- $checked是預設一筆選取，如果兩筆都是1(顯示)會以最下面一筆為準 -->
                </td>
                <td >
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    <!-- name是陣列型態才能一次刪多筆 -->
                </td>
              
            <!-- 只要牽扯到更新，就要知道對象是誰(對應的id) -->
            <!-- 在每筆資料增加一個隱藏欄位，為了得到id -->
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