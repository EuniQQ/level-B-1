
<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
    	                     <marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
        	                    </marquee>
        <div style="height:32px; display:block;"></div>
        <span class="t botli">更多最新消息顯示區</span>
        <!--正中央-->
            <?php
                $all=$DB->math('count','*');
                $div=5;  //每頁五筆最新消息
                $pages=ceil($all/$div);
                $now=$_GET['p']??1;
                $start=($now-1)*$div;
            ?>

            <ol  style="list-style-type:decimal;" start="<?=($now-1)*$div+1;?>"> 
                <!-- start=控制隨著分頁更改編碼 $now=目前頁碼，$div=每頁筆數-->

            <?php
                    $rows=$DB->all("limit $start,$div"); 
        			foreach($rows as $n){  //$news改為$rows
    				echo "<li class='sswww'>";  //加上class,為了下面 $(".sswww").hover()
    				echo mb_substr($n['text'],0,20);  //因為是中文使用mb_substr()取每一筆從0開始抓20個字顯示
    				echo "<div class='all' style='display:none'>{$n['text']}</div>";  //把子元素隱藏起來
    				echo "</li>";  //把每一筆消息的文字放進li標籤中
    			}
    		?>
    	</ol>

        <style>
            .more-news a{
                text-decoration:none;
            }

            .more-news a:hover{
                text-decoration:underline;
            }
        </style>

    <div class="more-news" style="text-align:center;"> 
        <?php
            if(($now-1)>0){
                $p=$now-1;
                echo "<a href='?do={$DB->table}&p=$p'> &lt; </a>";   
            }else{
                echo "<a href='?do={$DB->table}&p=$now'> &lt; </a>";   //寫法一：仍有符號但留在當前頁(p1)
                //echo "<a> &lt; </a>";   寫法二：拿掉連結，僅符合題意 //不能寫href="#"，會連到首頁 
            }

            for($i=1;$i<=$pages;$i++){
            if($i==$now){
                $fontsize="24px";
            }else{
                $fontsize="16px";
            }
             echo "<a href='?do={$DB->table}&p=$i' 
                 style='font-size:$fontsize'> $i </a>";
            }
            if(($now+1)<=$pages){
                $p=$now+1;
                echo "<a href='?do={$DB->table}&p=$p'> &gt; </a>"; 
            }else{
                echo "<a href='?do={$DB->table}&p=$now'> &gt; </a>"; 
            }
        ?>
    </div>    
    </div>
</div>

<!-- 以下整段從back.php剪下貼過來 -->
        <div id="alt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  
        background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; 
        border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
            <script>
            $(".sswww").hover(
                function() {
                    $("#alt").html("<pre>" + $(this).children(".all").html() + "</pre>").css({ //this是指滑鼠移過的那則新聞
                                   //加上pre標籤，為使內容斷行
                        "top": $(this).offset().top - 50
                    })
                    $("#alt").show()
                }
            )
            $(".sswww").mouseout(
                function() {
                    $("#alt").hide()
                }
            )
            </script>