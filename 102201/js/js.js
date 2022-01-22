// JavaScript Document
$(document).ready(function(e) {  //當網頁瀏覽器已經下載完成，開始執行以下程式
    $(".mainmu").mouseover(
		function()
		{
			$(this).children(".mw").show()  //.stop()可刪掉
		}
	)
	$(".mainmu").mouseout(
		function ()
		{
			$(this).children(".mw").hide()
		}
	)
});
function lo(x)  //導向頁面時用到
{
	location.replace(x)
}
function op(x,y,url)   //後台的彈出視窗，新更/更新圖片時用到
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