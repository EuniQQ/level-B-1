<?php
include_once "base.php";
?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>卓越科技大學校園資訊系統</title>
    <link href="./css/css.css" rel="stylesheet" type="text/css">
    <script src="./js/jquery-1.9.1.min.js"></script>
    <script src="./js/js.js"></script>
</head>

<body>
    <div id="cover" style="display:none; ">
        <div id="coverr">
            <a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;"
                onclick="cl(&#39;#cover&#39;)">X</a>
            <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
        </div>
    </div>
    <div id="main">
    <?php include "front/header.php";?>
        <div id="ms">
            <div id="lf" style="float:left;">
                <div id="menuput" class="dbor">
                    <!--主選單放此-->
                    <span class="t botli">主選單區</span>
                    <?php
                    $mains=$Menu->all(['parent'=>0,'sh'=>1]);
                    foreach($mains as $main){
                        echo "<div class='mainmu'>";  //Menu的name欄位就是選單名稱
                        echo "<a href='{$main['href']}'>";
                        echo $main['name'];
                        echo "</a>";

                        if($Menu->math('count','*',['parent'=>$main['id']])>0){  //表示是子選單
                            $subs=$Menu->all(['parent'=>$main['id']]);
                            echo "<div class='mw'>";
                            foreach ($subs as $sub) {
                                echo "<div class='mainmu2'>";  //Menu的name欄位就是選單名稱
                                echo "<a href='{$sub['href']}'>{$sub['name']}</a>";
                                echo "</div>";
                            }
                        echo "</div>";
                     }
                     echo "</div>";
                }
                    ?>

                </div>
                <div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
                    <span class="t">進站總人數 :<?=$Total->find(1)['total'];?></span>
                    <!-- 去Total資料表，找出id為1的資料，把total欄位的內容顯示出來 -->

                    <!-- <?php
                        $mains=$Menu->all(['parent'=>0,'sh'=>1]);
                        foreach($mains as $main){
                            echo "<a href=''>";
                            echo $main['name'];
                            echo "</a>";
                        }
                    ?> -->
                </div>
            </div>
            <?php
				
				$do=isset($_GET["do"])?$_GET["do"]:'main';
				$file="./front/".$do.".php";
				if(file_exists($file)){
					include $file;
				}else{
				// 寫法一: echo "檔案不存在";
				// 寫法二:檔案不存在就include main.php:
                include "./front/main.php"; 
				}	
				?>
            
            <div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
                <!--右邊-->
                <?php
                if(isset($_SESSION['login'])){
                ?> 
                <button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px;height:50px;"
                        onclick="lo(&#39;back.php&#39;)">返回管理</button>

                <?php
                  }else{
                ?>

                <button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;"
                        onclick="lo(&#39;?do=login&#39;)">管理登入</button>
                
                <?php
                }
                ?>
                            
                <div style="width:89%; height:480px;" class="dbor">
                    <span class="t botli">校園映象區</span>
                        <div class="t" onclick="pp(1)"><img src="icon/up.jpg"></div>
                        <?php
                            $imgs=$Image->all(['sh'=>1]); //找出$Image資料表中顯示的照片
                            foreach($imgs as $key => $img){ //用key=>value方式顯示陣列內容
                        ?>
                        <div class="im cent" id="ssaa<?=$key;?>"> 
                        <!-- 加上class=im,為了配合下面$(".im").hide() ; class=cent為了置中-->
                            <img src="img/<?=$img['img'];?>" style="width:150px;height:103px;border:3px solid orange;margin:5px">
                            <!-- 加上id=ssaa並加上key值(為了配合下面$("#ssaa" + t).show()-->
                        </div>
                        <?php
                            }
                        ?>
                        <div class="t" onclick="pp(2)"><img src="icon/dn.jpg"></div>
                    <script>
                    var nowpage = 0,
                        num = <?=$Image->math("count","*",['sh'=>1]);?>; //num指的是要顯示的圖片張數

                    function pp(x) {
                        var s, t;
                        if (x == 1 && nowpage - 1 >= 0) {  // x代表負責控制上下頁的箭頭 
                            nowpage--; //表示往上
                        }
                        if (x == 2 && (nowpage + 3) < num ) {
                            nowpage++; //表示往下
                        }
                        $(".im").hide()
                        for (s = 0; s <= 2; s++) {
                            t = s * 1 + nowpage * 1;
                            $("#ssaa" + t).show()
                        }
                    }
                    pp(1)  //瀏覽器載入時先進行一次pp(1)
                    </script>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div
            style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
            <span class="t" style="line-height:123px;"><?=$Bottom->find(1)['bottom'];?></span>
        </div>
    </div>

</body>

</html>