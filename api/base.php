<?php
session_start();
date_default_timezone_set("Asia/Taipei");

$Total = new DB('total');
$User = new DB('user');
$Po = new DB('po');
$News = new DB('news');
$Know = new DB('know');
$Que = new DB('que');
$Log = new DB('log');

class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db10";
    protected $table;
    protected $pdo;
    public $type = [
        1 => '健康新知',
        2 => '菸害防治',
        3 => '癌症防治',
        4 => '慢性病防治'
    ];

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    protected function arrayToSqlArray($array)
    {
        foreach ($array as $key => $value) {
            $arr[] = "`$key`='$value'";
        }
        return $arr;
    }

    public function all(...$args)
    {
        $sql = " SELECT * FROM `$this->table` ";
        if (isset($args[0]) && is_array($args[0])) {
            $sql .= " WHERE " . join(" && ", $this->arrayToSqlArray($args[0]));
        } elseif (isset($args[0])) {
            $sql .= $args[0];
        }

        if (isset($args[1]) && is_array($args[1])) {
            $sql .= join(" && ", $this->arrayToSqlArray($args[1]));
        } elseif (isset($args[1])) {
            $sql .=  $args[1];
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($args)
    {
        $sql = " SELECT * FROM `$this->table` WHERE ";
        if (is_array($args)) {
            $sql .= join(" && ", $this->arrayToSqlArray($args));
        } else {
            $sql .= "`id`= " . $args;
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function del($args)
    {
        $sql = " DELETE FROM `$this->table` WHERE ";
        if (is_array($args)) {
            $sql .= join(" && ", $this->arrayToSqlArray($args));
        } else {
            $sql .= "`id`=" . $args;
        }

        return $this->pdo->exec($sql);
    }

    public function save($save)
    {
        // prr($save);
        if (isset($save['id'])) {
            $id = $save['id'];
            unset($save['id']);
            $sql = "UPDATE `$this->table` SET " . join(",", $this->arrayToSqlArray($save)) . " WHERE `id`=$id";
        } else {
            $keys = [];
            $value = [];
            foreach ($save as $key => $value) {
                $keys[] = "`$key`";
                $values[] = "'$value'";
            }
            // prr($keys);
            $sql = "INSERT INTO `$this->table`(" . join(",", $keys) . ") VALUES (" . join(",", $values) . ")";
        }
        echo $sql;
        return $this->pdo->exec($sql);
    }

    // Math
    public function count($args)
    {
        return $this->visualBasic('count', '*', $args);
    }

    public function max($field, $args)
    {
        return $this->visualBasic('max', $field, $args);
    }

    public function min($field, $args)
    {
        return $this->visualBasic('min', $field, $args);
    }

    public function sum($field, $args)
    {
        return $this->visualBasic('sum', $field, $args);
    }

    public function avg($field, $args)
    {
        return $this->visualBasic('avg', $field, $args);
    }

    protected function visualBasic($math, $field, $args)
    {
        if ($math == 'count') {
            if (is_array($args)) {
                $sql = " SELECT count(*) FROM `$this->table` WHERE " . join(" && ", $this->arrayToSqlArray($args));
            } else {
                $sql = " SELECT count(*) FROM `$this->table` WHERE " . $args;
            }
        } else {
            if (is_array($args)) {
                $sql = " SELECT $math(`$field`) FROM `$this->table` WHERE " . join(" && ", $this->arrayToSqlArray($args));
            } else {
                $sql = " SELECT $math(`$field`) FROM `$this->table` WHERE " . $args;
            }
        }
        return $this->pdo->query($sql)->fetchColumn();
    }
}

function prr($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function q($sql)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=db10";
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function to($url)
{
    header("location:" . $url);
}


if (!isset($_SESSION['total'])) {
    // 如果沒有total表示沒有紀錄，新訪客
    $today = $Total->find(['date' => date("Y-m-d")]);
    // prr($today);
    if (empty($today)) {
        // 沒有今天的資料，表示為本日第一個訪客
        $today = ['date' => date("Y-m-d"), 'total' => 1];
    } else {
        // 有今天的資料，增加本日瀏覽人數
        $today['total']++;
    }
    $Total->save($today);
    $_SESSION['total'] = 1;
}
