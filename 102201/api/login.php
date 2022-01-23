<?php
include_once "../base.php";

$check=$Admin->math('count','*',['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);
if($check>0){  //若大於0筆表示帳號密碼正確
        $_SESSION['login']=$_POST['acc']; //登入成功用session記錄登入者
		to("../back.php");
	}else{
		echo "<script>";  //alert是js，須加上script
		echo "alert('帳號或密碼錯誤');";  //js寫完記得加分號，否則會爆錯
        //要將網頁導回首頁，這時是js前端，不能用to('../index.php?do=login'
        //),to是在後端用法
        echo "location.href='../index.php?do=login';";
		echo "</script>";
	}

?>
