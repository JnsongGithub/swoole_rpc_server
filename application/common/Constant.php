<?php

namespace app\common;

class Constant
{
    const SUCCESS = 0; //成功
    const FAILED = 99; //失败

    /***************初始化错误**************/
    const USER_CACHE_FAIL = 1000;
    const LIVE_BROADCAST_FINISH = 1001;


    /***************相亲交互错误**************/
    const HANDSHAKE_SUCCESS = 2000; //握手成功
    const TYPES_OF_REJECTION = 2001; //被拒绝的请求类型
    const NECESSARY_PARAM_LOSE = 2002; //必要参数缺失
    const SUBSCRIBER_FAIL = 2003;//进入直播间失败
    const USER_INFO_LOST = 2004;//用户信息丢失




    public static $errMsg = [
        self::SUCCESS   => '成功',
        self::FAILED    => '失败',

        //初始化链接提示
        self::USER_CACHE_FAIL => '用户登录失败',
        self::LIVE_BROADCAST_FINISH => '直播已结束',

        //交互提示
        self::NECESSARY_PARAM_LOSE => '必要参数缺失',
        self::TYPES_OF_REJECTION => '被拒绝的请求类型',
        self::HANDSHAKE_SUCCESS => '握手成功',
        self::SUBSCRIBER_FAIL => '进入直播间失败',
        self::USER_INFO_LOST => '用户信息丢失',

    ];


    /**
     * get return data
     * @param $code
     * @param string $msg
     * @return array
     */
    public static function getReturn($code, $msg = '') {
        if (!$msg && isset(self::$errMsg[$code])) {
            $msg = self::$errMsg[$code];
        }

        return ['code' => $code, 'msg' => $msg];
    }


    // ------oss相关配置-------
    const ACCESS_KEY_ID = '';
    const ACCESS_KEY_SECRET = '';
    const ENDPOINT = '';
    const BUCKET = '';


    //用户ID
    const MAP_USER_PREFIX = 'map_user_'; //登录APPRedis前缀
    const MAP_USER_CACHE_TIME = 86400;//登录APP缓存时间

    //连接号
    const MAP_FD_PREFIX = 'map_fd_'; //登录APPRedis前缀
    const MAP_FD_CACHE_TIME = 86400;//登录APP缓存时间


    const BROADCAST_PREFIX = 'broadcast_'; //直播前缀
    const BROADCAST_LIST_KEY = 'room_orderly_key_'; //直播间有序集合列表Key
    const BROADCAST_LIST_TIMER = 1200; //直播间有序列表有效时长

    const APPLY_ANCHOR_LIST_KEY = 'apply_anchor_'; //申请上麦前缀

    const USER_BROADCAST_PREFIX = 'user_broadcast_'; //用户对应直播间红娘的前缀Key


    //直播间默认警示语
    const ROOM_DEFULT_CONTENT = '平台公示:我们提倡积极阳光交友,严谨涉黄、涉恐、涉政、低俗、辱骂等行为。发现违规行为将被封禁。保护网络绿色环境,从你我做起!';





    /*
     * RPC客户端配置项
     * */
    const RPC_CLIENT_USER = 'dating';
    const RPC_CLIENT_PASS = 'dating@123';
    const RPC_SERVER_HOST = '0.0.0.0';
    const RPC_SERVER_PORT = '16666';
    const RPC_NAMESPACE = '';  //RPC服务端设置空即可






}
