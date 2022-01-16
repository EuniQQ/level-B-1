<!-- href連結要改。title屬性是滑鼠放在圖片上一秒後會出現的文字，所以將下面圖片訊息貼到title中,並將img(圖片名稱)改為text(替代文字) -->
<a title="<?=$Title->find(['sh'=>1])['text'];?>" href="index.php">
            <div class="ti" style="background:url(&#39;img/<?=$Title->find(['sh'=>1])['img'];?>&#39;); background-size:cover;"></div>
                                                   <!-- 更改圖片路徑，並撈出title資料表中，顯示(sh)為1的圖片,
                                                        並顯示['img']欄位的內容(圖片名) -->
            <!--標題-->
        </a>