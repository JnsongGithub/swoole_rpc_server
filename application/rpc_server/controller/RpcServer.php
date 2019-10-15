<?php
namespace app\rpc_server\controller;

use app\common\BusinessException;
use app\common\Constant;
use app\common\SLog;
use think\Controller;
use think\Exception;

class RpcServer extends Controller
{
    /**
     * 查询用户信息做Im系统缓存数据
     * @access public static
     * @param mixed $params 入参
     * @return mixed
     * @throws Exception
     */
    public static function getUserInfo($params)
    {
        try{
            /*
             * 1、数据库连接查询
             * 2、数据处理返回
             * */
            SLog::info('请求数据:'.json_encode($params));

            $user_info = [
                'userId' => $params['userId'],
                'icon' => 'https://amoylove.oss-cn-beijing.aliyuncs.com/static/image/taoai/temp/timg.gif',
                'nickName' => '大海里的螃蟹',
                'role' => 1
            ];
            $return_data = Constant::getReturn(Constant::SUCCESS);
            $return_data['data'] = $user_info;
        }catch(BusinessException $e){
            $return_data = [
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
            ];
        }
        return $return_data;
    }


    /**
     * 消费结算
     * @access public static
     * @param mixed $params 入参
     * @return mixed
     * @throws Exception
     */
    public static function consumeSettle($params)
    {
        try{
            /*
             * 1、加收入
             * 2、减支出
             * */
            SLog::info('消耗礼物，送出等操作:'.json_encode($params));

            $user_info = [
                'userId' => $params['userId'],
                'icon' => 'https://amoylove.oss-cn-beijing.aliyuncs.com/static/image/taoai/temp/timg.gif',
                'role' => 1
            ];
            $return_data = Constant::getReturn(Constant::SUCCESS);
            $return_data['data'] = $user_info;
        }catch(BusinessException $e){
            $return_data = [
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
            ];
        }
        return $return_data;
    }

}
