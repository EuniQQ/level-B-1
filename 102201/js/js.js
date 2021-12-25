// JavaScript Document
$(document).ready(function(e) {
    $(".mainmu").mouseover(
		function()
		{
			$(this).children(".mw").stop().show()
		}
	)
	$(".mainmu").mouseout(
		function ()
		{
			$(this).children(".mw").hide()
		}
	)
});
function lo(x)
{
	location.replace(x)
}
function op(x,y,url)
{ //selector(選擇器):#....
	$(x).fadeIn() //淡入效果
	if(y) //當if只有一行時，可以省略大括號，他會把第一行內容當作true，第二行當作faulse
	$(y).fadeIn() //y執行淡入
	if(y&&url) //else if y跟網址都存在時
	$(y).load(url) //去執行這段動作(j query語法):在y這個容器內載入url這個網址所得到的東西
}
function cl(x)
{
	$(x).fadeOut();//淡出效果
}