<?php include_once"../base.php";
//寫法一:
// $views=$_POST['total'];
// $total=$Total->find(1);
// $total['total']=$views;

//寫法二:
$Total->save(['id'=>1,'total'=>$_POST['total']]); 

to("../back.php?do=total");


?>