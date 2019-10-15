<?php

define('DEBUG', 'on');
define('WEBPATH', realpath(__DIR__ . '/../'));

define('EXTEND_PATH', __DIR__ . '/extend/');

// 加载基础文件
require_once __DIR__ . '/extend/libs/lib_config.php';
use Swoole\Protocol\RPCServer;
use app\common\Constant;


//引入TP自带加载基础文件
//$resu = require_once __DIR__ . '/public/index.php';
//$resu = require_once __DIR__ . '/thinkphp/base.php';


//设置PID文件的存储路径
Swoole\Network\Server::setPidFile('/productlog/rpc_server.pid');

/**
 * 显示Usage界面
 * php app_server.php start|stop|reload
 */
Swoole\Network\Server::start(function ()
{
    $AppSvr = new RPCServer;
    $AppSvr->setLogger(new \Swoole\Log\EchoLog(true)); //Logger

    /**
     * 注册一个自定义的命名空间到SOA服务器
     * 默认使用 apps/classes
     */
    $AppSvr->addNameSpace('app', __DIR__ . Constant::RPC_NAMESPACE);

    /**
     * IP白名单设置
     */
//    $AppSvr->addAllowIP('127.0.0.1');
//    $AppSvr->addAllowIP('127.0.0.2');

    /**
     * 设置用户名密码
     */
    $AppSvr->addAllowUser(Constant::RPC_CLIENT_USER, Constant::RPC_CLIENT_PASS);

//    Swoole\Error::$echo_html = false;
    $server = Swoole\Network\Server::autoCreate(Constant::RPC_SERVER_HOST, Constant::RPC_SERVER_PORT); //开启的端口号
    $server->setProtocol($AppSvr);
//    $server->daemonize(); //作为守护进程
    $server->run(
        array(
            //TODO： 实际使用中必须调大进程数
            'worker_num' => 16, //CUP核数1~4倍
            'max_request' => 5000,
            'dispatch_mode' => 2,
            'open_length_check' => true, //包长检测特性
            'package_max_length' => $AppSvr->packet_maxlen, //最大数据包尺寸
            'package_length_type' => 'N', //长度值的类型
            'package_body_offset' => \Swoole\Protocol\RPCServer::HEADER_SIZE,
            'package_length_offset' => 0,
            'buffer_output_size' => 32 * 1024 *1024, //必须为数字(发送输出缓存区内存尺寸)
        )
    );
});

