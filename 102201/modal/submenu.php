<?php include_once "../base.php";?>

<h3>編輯次選單</h3>
<hr>
<!--直接在action中加入主選單的id傳遞給api-->
<form action="api/submenu.php?main=<?=$_GET['id'];?>" method="post" enctype="multipart/form-data">
    <!--為了方便jQuery的操作，先在table中建立一個id-->
    <table id="sub">
        <tr>
            <td>次選單名稱</td>
            <td>次選單連結網址</td>
            <td>刪除</td>
        </tr>

    <?php
        $subs=$Menu->all(['parent'=>$_GET['id']]);
        foreach($subs as $sub){
    ?>

        <tr>
            <td><input type="text" name="name[]" value="<?=$sub['name'];?>"></td>
            <td><input type="text" name="href[]" value="<?=$sub['href'];?>"></td>
            <td><input type="checkbox" name="del[]" value="<?=$sub['id'];?>"></td>
            <input type="hidden" name="id[]" value="<?=$sub['id'];?>">
        </tr>
    <?php
    }
    ?>
    </table>

    <div>
        <input type="submit" value="修改確定">
        <input type="reset" value="重置">
        <input type="button" value="更多次選單" onclick="more()">
    </div>
</form>

<script>
    // 加入 onclick 事件呼叫 more() 程式來動態產生輸入欄位
    function more(){

    //建立一個新增次選單的表單欄位字串，
    //要注意的是欄位名稱不一樣，方便在api中做識別
        let row=`<tr>
                <td><input type="text" name="name2[]" ></td>
                <td><input type="text" name="href2[]" ></td>
                <td></td>
            </tr>`

         //使用jquery的append()方法把表單字串插入表格的後面
        $("#sub").append(row);
    }
</script>