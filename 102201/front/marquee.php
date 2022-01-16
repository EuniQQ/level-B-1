<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
    <?php
		$ads=$Ad->all(['sh'=>1]);
		// 所有的動態文字廣告($ads)就是從$Ad資料表中找出所有sh設為1的資料
		foreach($ads as $ad){
			echo $ad['text'];
			echo "&nbsp;";  //增加空白或斜線，好使各斷跑馬燈內容不會連在一起
		}
	?>
</marquee>