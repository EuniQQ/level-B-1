<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
        <!-- <p class="t cent botli">網站標題管理</p> -->
        <p class="t cent botli"><?=$DB->title;?></p>
        <!-- 表單送出的action為同一個edit.php，為了區別是那個功能送出的資料， -->
        <!-- 所以我們加上了資料表名讓api可以識別 -->
    <form method="post" action="api/edit.php?do=<?=$DB->table;?>">
        <table width="100%">
  
        <!-- 標題列     -->
        <tr class="yel">
        	    <td width="45%"><?=$DB->header?></td>
                <td width="23%">替代文字</td>
                <td width="7%">顯示</td>
                <td width="7%">刪除</td>
                <td></td>
            </tr>


        <?php
           //以$rows代表多筆、複數的，$row代表很多筆的其中一筆
            $rows=$DB->all();
            //使用迴圈把每筆資料都列出來
            foreach($rows as $row){  
                
                //檢查資料中的sh欄位是否為1，是的話把checked字串存到變數$checked中,
                //否的話則是把空值存到變數$checked中
                $checked=($row['sh']==1)?'checked':'';
        ?>

            <!-- 預設情況下，表單input的name欄位中的會被放到$_POST的KEY值去。 -->
            <!-- 若是KEY值一樣就會被蓋過。所以要完整將資料送到後台，須將所有資料放到一個陣列中 -->
            <!-- 只要一次送出多筆，name值一律加中誇括號 -->

            <tr>
        	    <td width="45%">
                    <img src="./img/<?=$row['img'];?>" style="width:300px;height:30px">
                </td>
                <td width="23%">
                     <!-- name是陣列型態才能一次傳送多筆資料 -->
                    <input type="text" name="text[]" value="<?=$row['text'];?>">
                </td>
                <td width="7%">
                <!-- 在input的屬性中加上在迴圈一開始時設定的\$checked，如果sh值為1，
            則會在標籤中顯示checked，radio會呈現選中的狀態，如果sh值為0，
            則會在標籤中顯示空值，radio會呈現未選中的狀態 -->
                    <input type="radio" name="sh" value="<?=$row['id'];?>" <?=$checked;?>>
                <!-- $checked是預設一筆選取，如果兩筆都是1(顯示)會以最下面一筆為準 -->
                </td>
                <td width="7%">
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    <!-- 在value中填入id值，會以陣列的方式把被勾選要刪除的資料id傳送出去 -->
                </td>
                <td>
            <!-- 只要牽扯到更新，就要知道對象是誰(對應的id) -->
            <!-- 在每筆資料增加一個隱藏欄位，為了得到id -->
            <!-- 才能知道每一個文字欄位各是那個id的資料 -->
            <input type="hidden" name="id[]" value="<?=$row['id'];?>">
            <input type="button"

            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/upload.php?do=<?=$DB->table;?>&id=<?=$row['id'];?>&#39;)" 
            value="更新圖片">
            <!-- 本題組中有三個功能會使用到彈出視窗來更新圖片，我們統一檔名的規則為 -->
            <!-- uploade.php?do=[table]&id=[id] -->
            <!-- 因此可以把資料表名代換進去-->
            
             </td>
         </tr>
    
         <?php  } ?>
    
        </table>

        <table style="margin-top:40px; width:70%;">
            <tr>
                <td width="200px"><input type="button"                                                  
                onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/<?=$DB->table;?>.php?table=<?=$DB->table;?>&#39;)"
                value="<?=$DB->button?>">  
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