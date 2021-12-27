<?php
date_default_timezone_set("Asia/Taipei");
session_start();

//宣告DB
class DB{  
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=web21";
    protected $user="root";
    protected $pw='';
    protected $pdo;
    public $table;
    public $title;
    public $button;
    public $header; //黃色nev的左邊標題列文字
    public $append; //黃色nev的右邊一欄
    

    public function __construct($table){
        $this->table=$table;   //意思是這個DB(table)就等於傳進來的table
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
        $this->setStr($table);  //在建構資料表時，去執行這個類別裡面setStr()這個function，並把$table帶入
         }
//接著進入下面switch case設成對應的文字
    private function setStr($table){
        switch($table){
            case "title";
            $this->title="網站標題管理";
            $this->button="新增網站標題";
            $this->header="網站標題";
            break;
            case "ad";
            $this->title="動態文字廣告管理";
            $this->button="新增動態文字廣告";
            $this->header="動態文字廣告";
            break;
            case "mvim";
            $this->title="動畫圖片管理";
            $this->button="新增動畫圖片";
            $this->header="動畫圖片";
            break;
            case "image";
            $this->title="校園映像資料管理";
            $this->button="新增校園映像圖片";
            $this->header="校園映像資料圖片";
            break;
            case "total";
            $this->title="進站總人數管理";
            $this->button="";
            $this->header="進站總人數";
            break;
            case "bottom";
            $this->title="頁尾版權資料管理";
            $this->button="";
            $this->header="頁尾版權資料";
            break;
            case "admin";
            $this->title="管理者帳號管理";
            $this->button="新增管理者帳號";
            $this->header="帳號";
            $this->append="密碼"; 
            break;
            case "menu";
            $this->title="選單管理";
            $this->button="新增主選單";
            $this->header="主選單名稱";
            $this->append="選單連結網址";
            break;
                    }
    }

    // function find
    public function find($id){
        $sql="SELECT * FROM $this->table WHERE ";
          //如果$id是陣列表示是條件，如果不是陣列表示是值
        if(is_array($id)){
            foreach($id as $key => $value){ 
                $tmp[]="`$key`='$value'";  //建立暫時的陣列，透過foreach將每一筆以`$key`='$value'方式放入
            }

            $sql .= implode(" AND ",$tmp);  //AND前後記得加空格，用AND將陣列裡每一筆資料串起來
        }else{
            $sql .= " `id`='$id' "; //意思SELECT * FROM $this->table WHERE 加上 `id`='$id'
        }
         // function q ---- 萬用查詢，直接把整段sql放進去讓它查詢，查詢後取一筆就好  
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    // function all --- 可能有很多參數(不定參數)
    public function all(...$arg){
        $sql="SELECT * FROM $this->table "; //先不加WHERE因做分頁時可能有沒有條件的情況


        switch(count($arg)){
            case 2: //兩個參數的狀況
                foreach($arg[0] as $key => $value){
                    $tmp[]=" `key`='value'";
                }

                $sql .=" WHERE ".implode("AND".$arg[0])." ".$arg[1];

                break;

            case 1:  //一個參數的狀況
                if (is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .=" WHERE ".implode(" AND ".$arg[0]);
                }else{
                    $sql .=$arg[1];

                }
                break;
        }                              //取多筆
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // function math ---- 用以計算的(甚麼方式，計算甚麼欄位，條件EX男女、年紀...)
    public function math($method,$col,...$arg){
        $sql="SELECT $method($col) FROM $this->table ";

        switch(count($arg)){
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql .=" WHERE ".implode("AND".$arg[0])." ".$arg[1];

                break;
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key =>$value){
                        $tmp[]="`key`='$value'";
                    }
                    $sql .="WHERE".implode("AND".$arg[0]);
                }else{
                    $sql .=$arg[1];
                }  
                break;  
        }
                                       //math只針對一個欄位計算，所以直接取欄位
                                       //僅針對一個欄位並僅會回傳一個資料的情況
        return $this->pdo->query($sql)->fetchColumn();
    }

    // function save ---- 用於新增和更新用途，判斷方法是這個陣列array有沒有id這個欄位
    public function save($array){
        if(isset($array['id'])){
            //update
            foreach($array as $key =>$value){
                $tmp[]="`$key`='$value'";
            }

            $sql="UPDATE $this->table
                         SET ".implode(",",$tmp)."
                         WHERE `id`='{$array['id']}'";

        }else{
        //insert
            $sql="INSERT INTO $this->table (`".implode("`,`",array_keys($array))."`)
                                     VALUES('".implode("','",$array)."')";
        }
                          //不需要回傳資料，只要告訴我執行新增/更新是否有成功
        return $this->pdo->exec($sql);
}                         //用於執行外部程序並返回輸出的最後一行。如果沒有命令正確運行，它也會返回NULL。

    //function del
    public function del($id){  //$array改成$id
        //del和find很像，都是針對單一筆資料，所以直接複製來貼上
       $sql="DELETE FROM $this->table WHERE ";   //find改DELETE
    
       if (is_array($id)){
           foreach($id as $key => $value){
               $tmp[]="`$key`='$value'";
           }
    
           $sql .=implode("AND",$tmp);
       }else{
           $sql .= "`id`='$id'";
       }
                          //同save，只需知道是否執行成功
       return $this->pdo->exec($sql);
    }

                   //跟all一樣
    public function q($sql){
       //return這個物件的pdo去查詢
       return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
}   


    function dd($array){
        echo "<pre>";
       print_r($array);
        echo "</pre>";
    }
    
    //function to 要寫在DB外面
    function to ($url){
        header("location:".$url);
    }
    

    $Total=new DB('total');  //用大寫表示後面常用到的變數，代表是資料表
    $Bottom=new DB('bottom');
    $Title=new DB('title');
    $Ad=new DB('ad');
    $Mvim=new DB('mvim');
    $Image=new DB('image');
    $News=new DB('news');
    $Adimin=new DB('adimin');
    $Menu=new DB('menu');


    //$tt=(isset($_GET['do']))?$_GET['do']:''; (另一種寫法)
     //$tt=isset($_GET['do'])??''; (另一種寫法)
    $tt=$_GET['do']??''; //先設一個變數，若有do這個參數就使用do，若沒有就空白

    switch($tt){
        case "title":
            $DB=$Title;
        break;
        case "ad":
            $DB=$Ad;
        break;
        case "mvim":
            $DB=$Mvim;
        break;
        case "image":
            $DB=$Image;          
        break;
        case "total":
            $DB=$Total;
        break;
        case "bottom":
            $DB=$Bottom;
        break;
        case "news":
            $DB=$News;
        break;
        case "admin":
            $DB=$Admin;
        break;
        case "menu":
            $DB=$Menu;
        break;

    }
    //試試能不能將資料表撈出來:
    //寫法二: echo $Total->find(1)['Total'];  
    //寫法一:    
    // echo $total['total'];
    // print_r($Total->all());


    //如果SESSION不存在，資料表訪客人數+1
    if(!isset($_SESSION['total'])){  //沒session時，只要換分頁只要讀到base都會訪客+1
        $total=$Total->find(1); //把total欄位的數字抓出來+1再存回去
        $total['total']++;
        $Total->save($total);
        $_SESSION['total']=$total['total']; //再建一個session紀錄最新的total值
    }






?>