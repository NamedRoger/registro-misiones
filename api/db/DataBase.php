<?php 


class DataBase extends \PDO
{
    private $host       = "naucara.com";
    private $dbName     = "naucara_common_prd";
    private $user       = "naucara_common_prd_adm";
    private $password   = "FlV4wRVjbwpv";

    public function __construct ()
    {
        $host = $this->host;
        $dbName = $this->dbName;
        try{
            parent::__construct("mysql:host=$this->host;dbname=$dbName;charset=utf8",$this->user,$this->password);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
