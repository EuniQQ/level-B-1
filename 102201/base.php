<?php
date_default_timezone_set("Asia/Taipei");
session_start();

//宣告DB
class DB{  
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=web21";
    protected $user="root";
    protected $pw='';
    protected $table;
    protected $pdo;

    public function __construct($table){
        $this->table=$table;   //意思是這個DB(table)就等於傳進來的table
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
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
        $sql="SELECT * FROM $this ->table "; //先不加WHERE因做分頁時可能有沒有條件的情況


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
        //del和find很像ㄉ歐式針對單一筆資料，所以直接複製來貼上
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