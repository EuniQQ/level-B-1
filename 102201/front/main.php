<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
                	<?php include "marquee.php";?>
                    <div style="height:32px; display:block;"></div>
                    <!--正中央-->
                    
                	<div style="width:100%; padding:2px; height:290px;">
                    	<div id="mwww" loop="true" style="width:100%; height:100%;">
                        	<div style="width:99%; height:100%; position:relative;" class="cent">沒有資料</div>
                        </div>
                    </div>

					<script>
                    	var lin = new Array(); //在php直接用[]表示陣列，但在js需要先宣告
							<?php  //撈出所有要顯示的動畫圖片並放入JS陣列中
								$mvs=$Mvim->all(['sh'=>1]);
								foreach($mvs as $mv){
							?>
								lin.push('<?="img/{$mv['img']}";?>') //push()用於把裡面的值(圖檔的路徑)塞到陣列後面

							<?php		
								}
							?>

						var now=0; //控制圖片順序的值
						ww() //載入畫面時先執行一次，找到第一張0的先撥放一次
						if(lin.length>1) //若lin這個陣列有兩個以上內容
						{
							setInterval("ww()",3000); //設定每隔3000毫秒(3秒)去執行一次function ww()
							now=1;
						}
						function ww() {
							//id=mwww的選擇器，放入.html()函式的內容(一個循環來自lin[0]陣列)
							$("#mwww").html("<embed loop=true src='"+lin[now]+"' style='width:99%; height:100%;'></embed>")
							//$("#mwww").attr("src",lin[now])
							//js的特性：若遇到setInterval有時間間隔，他不會停下來等，而是繼續往後讀取，所以此時now=1
							now++;
							if(now >= lin.length) //length為陣列內容個數
							now = 0;  //特例寫法：若是true狀況下，並且只有一行，可省略大括號
						}
                    </script>

                	<div style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
                    		<span class="t botli">最新消息區
                            	<?php
									if($News->math('count','*',['sh'=>1])>5){ //計算News資料表中設定顯示的是否大於五
										echo "<a href='index.php?do=news' style='float:right'>more...<a>";
									} 
								?>
							</span>

                            <ul class="ssaa" style="list-style-type:decimal;">
							<?php
							$news=$News->all(['sh'=>1],"LIMIT 5");  //找出顯示的最新消息前五筆
								foreach($news as $n){
									echo "<li>";
									echo mb_substr($n['text'],0,20);  //因為是中文使用mb_substr()取每一筆從0開始抓20個字顯示
									echo "<div class='all' style='display:none'>{$n['text']}</div>";  //把子元素隱藏起來
									echo "</li>";  //把每一筆消息的文字放進li標籤中
								}
							?>
							</ul>

        			<div id="altt" style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
                    	<script>
						$(".ssaa li").hover( //指.ssaa下面子層所有的li
							function ()
							{
								$("#altt").html("<pre>"+$(this).children(".all").html()+"</pre>") 
								//altt用.html()裡面的內容取代
								//this是hover滑到的那一行的子層class=all的元素中的所有內容，html()中空白表示這個元素的所有內容
								$("#altt").show()
							}
						)
						$(".ssaa li").mouseout(
							function()
							{
								$("#altt").hide()
							}
						)
                        </script>
                    </div>
                    </div>