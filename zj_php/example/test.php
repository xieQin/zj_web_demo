<?php

//?t=testModel
require_once '../zj_php.php';

setC("APP_PATH", dirname(__FILE__));
add_app_config(getC("APP_PATH") . "/App1/Conf/App1_Conf.php");

if (function_exists($q_t)) {
    eval("$q_t ();");
} else {
    my_log("{$q_t} 测试现不存在！ ");
}

/*
 * ========= 测试项目 ==========
 */



function testDesCsh() {
    $deskey = "AAacM12+";
    $des = DES::share("wp");
    $str = $des->encode("掌上贵金属sfsdaf", $deskey);
    my_log($str);
    $dstr = $des->decode($str, $deskey);
    my_log($dstr);
}

function testGuid() {
    echo create_guid();
}

function testDesParam() {
    $deskey = "AAacM12+";
    $des = DES::share("android");
    $desp = $des->encode('a=11&b=22&c=33', $deskey);
    my_log($desp);
    $param = PDU($desp, "android", "$deskey");
    my_log($param);
}

function testPage() {
    global $q_page;
    $add_item = array("a" => 1, "b" => 2);
    echo list_page($q_page, 33444, 10, array(), $add_item, "#abc");
}

function testArr() {
//    $arr1 = array("1" => "111", "2" => "222");
//    $arr2 = array("3" => "222", "4" => "333");
//    $arr = $arr1 + $arr2;
//    my_log($arr);

    $arr3 = array("aaaaa", "b" => "nullsss", "ccc", array("1", "2"));
    //$arr3 = "123";
    my_log($arr3);
    $str3 = array_to_string($arr3);
    my_log($str3);

    my_log(string_to_array($str3));
    my_log("======");
    my_log(explode("|", null));
}

function testKV() {
    $kv = MyKV::getKV();
    my_log($kv);
    $v = $kv->set("abc", array("11", "22"));
    my_log($v);
    $v = $kv->get("abc");
    my_log($v);
    $v = $kv->delete("abc");
    my_log($v);

//    for($n = 0; $n < 200; $n++)
//    {
//        $kv->set("key_$n", $n);
//    }

    my_log($kv->getAll());
}

function testQueue() {
    for ($n = 0; $n < 10; $n++) {
        $q = MyTaskQueue::getQueue("task_name");
        $arr = array("http://112.124.26.68/zsgjs2/trunk/Admin/A/Test/pxltest", "http://www.facebook.com");
        $q->addTask($arr);
        $q->push();
    }
}

function testDes() {

    $des = DES("android");
    $ec = $des->encode("abc中国", "12345678");
    my_log($ec);

    my_log($des->decode($ec, "12345678"));
}

function testEmail() {

    $smtpemailto = "38852198@qq.com"; //发送给谁
    $mailsubject = "Test Subject"; //邮件主题
    $mailbody = "<h1>This is a test mail</h1>"; //邮件内容
    $mailtype = "HTML"; //邮件格式（HTML/TXT）,TXT为文本邮件

    $smtp = new MailHandler(true); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
    echo $smtp->sendmail($smtpemailto, $mailsubject, $mailbody, $mailtype);
}

function testCURL() {
    $content = CURLHandler::share()->query("http://www.zsgjs.com");
    my_log($content);
}

function testSMS() {
    my_log(SMSHandler::share()->send("13816907782", "掌金测试"));
}

function testModel() {
    $time = time();
    $m = M("t_zj_userexpense");
    //$m->debugSql = true;
    $data = array("notes" => "Josy测试");
    $id = $m->add($data);
    $obj = $m->where("id=$id")->select();
    my_log($obj);


//    $m = new M("t_test1");
//    $arr = $m->where("1=1")->select();
//    my_log($arr);
//
//    $m = M("t_test1");   
//    $arr = $m->where(" idss=? or idss=? ", array(2,3))->order(" idss desc ")->limit(" 1,1 ")->select(" idss,uname ");
//    my_log($arr);
//    
//    $m = M("t_test1");  
//    $arr = $m->where("1=1")->find();
//    my_log($arr);
//    
//    $m = M('t_test1');
//    $data = array('uname' => "uuuuuuuuuuu");
//    $get = $m->where("idss=2")->update($data);
//    my_log($get);
//    
//    $m = M('t_test1');
//    $get = $m->where("idss=2")->delete();
//    my_log($get);  
}

function testDB() {
    $db = D();

//    //--
//    $sql1 = "SELECT * FROM t_test2 where id = ? or id = ? ";
//    my_log($db->query($sql1, array("1", "3")));
//    //--
//    $sql2 = "SELECT * FROM t_test2 ";
//    my_log($db->query($sql2));
//    //--
//    $time = time();
//    $sql3 = " INSERT INTO t_test1 (`uname`,`uaddress`) VALUES('$time', '$time') ";
//    my_log($db->query($sql3));
//    //--
//    $sql4 = " delete from t_test1 where idss = ? ";
//    my_log($db->query($sql4, array(1)));
//    //--
//    $sql5 = "SELECT * FROM t_test2 ";
//    my_log($db->query_array($sql5));
    //--
    $sql6 = "SELECT * FROM t_test2 ";
    my_log($db->query_one($sql6));


//    $test = $db->query_one($sql6);
//    $test["id"];
//    $test["name"];
//    
//    $sql7 = "select * from t_test2 where id = 10000";
//    my_log($db->query_int($sql7));
}

function testMemcache() {
    $arr1 = array("arr111");
    $mem = MC();
    $mem->set("k1", $arr1);
    my_log($mem->get("k1"));

    $arr2 = array("arr222");
    $mem->set("k1", $arr2);
    my_log($mem->get("k1"));

    $mem->delete("k1");
    my_log($mem->get("k1"));

    $mem->set2("k2", "2222");
    my_log($mem->get("k2"));
    $mem->delete("k2");

    my_log("========");
    my_log($mem->getAll());
}

function testMyMd5() {
    $md5 = mymd5("impxl");
    my_log($md5);
    my_log(mymd5($md5, "DE"));
}

function testIP() {
    echo ipfrom("116.231.200.75");
}

function testQuery() {
    //?aa=123
    global $q_aa;
    my_log($_REQUEST);
    my_log($q_aa);
}

function test1() {
    $arr1 = array("11", "22");
    $arr2 = $arr1;
    $arr1[0] = "11_aa";
    my_log($arr2); //输出： Array ( [0] => 11 [1] => 22 ) 

    tmp_test1($arr2);
    my_log($arr2); //输出： Array ( [0] => abccccc [1] => 22 ) 

    $arr3 = &$arr2;
    $arr2[0] = "11_aacccc";
    my_log($arr3); //输出：Array ( [0] => 11_aacccc [1] => 22 ) 
}

function test2() {
    my_log(isset($ssssssssssss["ssss"]) ? "1" : "0");
}

/////////////
function tmp_test1(&$obj) {
    $obj[0] = "abccccc";
}

function tmp_test2() {
    my_log("===");
    file_get_contents("http://112.124.26.68/zsgjs2/trunk/Admin/A/Test/pxltest");
}

?>
