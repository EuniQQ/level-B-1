<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=web21";
    protected $user="root";
    protected $pw='';
    protected $table;

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
    }

    // function find
    public function find($id){
        $sql="SELECT * FROM $this->table WHERE ";

        if(is_array($id)){
            foreach($id as $key =>$value){
                $tmp[]="`key`='$value'";
            }

            $sql .=implode("AND",$tmp);
        }else{
            $sql .=" `id`='$id' ";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    }

    // function all
    public function all(...$arg){
        $sql="SELECT * FROM $this->table" ;
        
        switch(count($arg)){
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql .=" WHERE ".implode(" AND ".$arg[0])." ".$arg[1];

            break;
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " WHERE ".implode(" AND ".$arg[0]);
                }else{
                    $sql .= $arg[1];
                    
                }
            break;
        }


        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    // function math
    public function math($method,$col,...$arg){
        $sql="SELECT $method($col)FROM $this->table "; //最後要有一個空格

        switch(count($arg)){
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql .=" WHERE ".implode(" AND ".$arg[0])." ".$arg[1];

            break;
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " WHERE ".implode(" AND ".$arg[0]);
                }else{
                    $sql .= $arg[1];
                    
                }
            break;
        }




        return $this->pdo->query($sql)->fetchColumn();

    }

    // function save
    public function save($array){

        
        if(isset($array['id'])){
            //update
            foreach($array as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql="UPDATE $this->table SET ".implode(",",$tmp)."
            WHERE `ID`='{$array['id']}'";

        }else{
           //insert
$sql="INSERT INTO $this->table(`".implode("`,`",array_keys($array))."`)
                         VALUE('".implode("','",$array)."')";
        }

        return $this->pdo->exec($sql);
    }

    // function del
    public function del($id){
        $sql="DELETE * FROM $this->table WHERE ";

        if(is_array($id)){
            foreach($id as $key =>$value){
                $tmp[]="`key`='$value'";
            }

            $sql .=implode("AND",$tmp);
        }else{
            $sql .=" `id`='$id' ";
        }



        return $this->pdo->exec($sql);
    }

    // function q
    public function q($sql){

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }




}
//function to
function to($url){
    header("location:").$url;
}


$Total=new DB('total');
$Bottom=new DB('bottom');
$Tital=new DB('tital');
$Ad=new DB('ad');
$Mvim=new DB('mvim');
$Image=new DB('image');
$News=new DB('news');
$Admin=new DB('admin');
$Menu=new DB('menu');
$total=$Total->find(1);

 // 寫法二: echo $Total->find(1)['Total'];
  //寫法一:    
    // echo $total['total'];
    // print_r($Total->all());

    


   //如果SESSION不存在，資料表訪客人數+1
  if(!isset($_SESSION['TOTAL'])){
      $total=$Total->find(1);
      $total['total']++;
      $Total->save($total);
      $_SESSION['total']=$total['total'];
  }  
    
    
    
    
    123
    ?>