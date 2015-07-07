<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>demo js pay</title>
</head>
<body>
<button id="test">test</button>
<!--1.添加控制台获得的script标签-->
<script id='spay-script' type='text/javascript' src='https://jspay.beecloud.cn/1/pay/jsbutton/returnscripts?appId=c5d1cba1-5e3f-4ba0-941d-9b0a371fe719'></script>
<?php
$appId = "c5d1cba1-5e3f-4ba0-941d-9b0a371fe719";
$appSecret = "39a7a518-9ac8-4a9e-87bc-7885f33cf18c";
$data = array(
    "title" => "test",
    "amount" => "1",
    "out_trade_no" => "test0001", //支付订单的id，需要唯一
    "trace_id" => "testcustomer"
);
//2.计算sign只需要appId， title， amount ，out_trade_no 和appSecret
$sign = md5($appId.$data['title'].$data['amount'].$data['out_trade_no'].$appSecret);
$data["sign"] = $sign;

$data["optional"] = json_decode(json_encode(array("hello" => "1")));
?>
<script>
    document.getElementById("test").onclick = function() {
        /**
         * 3. 调用BC.click 接口传递参数
         */
        BC.click({
            "title": "test",
            "amount": "1",
            "out_trade_no": "test0001",
            "trace_id" : "testcustomer",
            "sign" : "<?php echo $sign;?>",
            /**
             * optional 为自定义参数对象，目前只支持基本类型的key ＝》 value, 不支持嵌套对象；
             * 回调时如果有optional则会传递给webhook地址，webhook的使用请查阅文档
             */
            "optional": {"test": "willreturn"}
        });
    };
</script>
</body>
</html>