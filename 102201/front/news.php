
<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
    	                     <marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
        	                    </marquee>
        <div style="height:32px; display:block;"></div>
        <span class="t botli">更多最新消息顯示區</span>
        <!--正中央-->
        <ul  style="list-style-type:decimal;"> 
    		<?php
                    $all=$DB->math('count','*');
                    $div=4;
                    $pages=ceil($all/$div);
                    $now=$_GET['p']??1;
                    $start=($now-1)*$div;
        
                    $row=$DB->all("limit $start,$div");
                    
    		        $news=$News->all(['sh'=>1],);  //刪掉limit 5 讓他全部顯示
    			foreach($rows as $n){  //$news改為$rows
    				echo "<li class='sswww'>";  //加上class,為了下面 $(".sswww").hover()
    				echo mb_substr($n['text'],0,20);  //因為是中文使用mb_substr()取每一筆從0開始抓20個字顯示
    				echo "<div class='all' style='display:none'>{$n['text']}</div>";  //把子元素隱藏起來
    				echo "</li>";  //把每一筆消息的文字放進li標籤中
    			}
    		?>
    	</ul>
    <div style="text-align:center;">
        <a class="bl" style="font-size:30px;" href="?do=meg&p=0">&lt;&nbsp;</a>
        <a class="bl" style="font-size:30px;" href="?do=meg&p=0">&nbsp;&gt;</a>
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