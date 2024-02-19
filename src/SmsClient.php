<?php
// +----------------------------------------------------------------------
// | Ctyun Sms Service [Ctyun Sms SDK for PHP]
// +----------------------------------------------------------------------
// | 天翼云短信服务
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: axguowen <axguowen@qq.com>
// +----------------------------------------------------------------------

namespace axguowen\ctyun\services\sms;

use axguowen\ctyun\common\BaseClient;

class SmsClient extends BaseClient
{
    /**
     * 请求接口根地址
     * @var string
     */
    protected $baseUrl = 'https://sms-global.ctapi.ctyun.cn';

    /**
     * 发送短信
     * @access public
     * @param string $phoneNumber 手机号码,支持单个或多个手机号，多个手机号之间以英文逗号分隔
     * @param string $signName 短信签名名称。请在控制台的签名管理页签下签名名称一列查看。说明：必须是已添加、并通过审核的短信签名。
     * @param string $templateCode 短信模板ID。请在控制台的模板管理页签下模板Code一列查看。说明：必须是已添加、并通过审核的短信模板。
     * @param string $templateParam 短信模板变量对应的实际值，JSON字符串格式。说明：如果JSON中需要带换行符，请参照标准的JSON协议处理。
     * @param string $extendCode
     * @param string $sessionId
     * @return array
     * @link https://www.ctyun.cn/document/10020426/10021544
     */
    public function sendSms($phoneNumber, $signName, $templateCode, $templateParam, $extendCode = null, $sessionId = null)
    {
        // 请求体
        $body = [
            'action' => 'SendSms',
            'phoneNumber' => $phoneNumber,
            'signName' => $signName,
            'templateCode' => $templateCode,
            'templateParam' => $templateParam,
        ];
        // 存在上行短信扩展码
        if(!is_null($extendCode)){
            $body['extendCode'] = $extendCode;
        }
        // 存在SessionId
        if(!is_null($sessionId)){
            $body['sessionId'] = $sessionId;
        }
        // 返回请求结果
        return $this->post('/sms/api/v1', $body);
    }

    /**
     * 查询发送记录
     * @access public
     * @param array $queryParams 请求参数
     * @return array
     * @link https://www.ctyun.cn/document/10020426/10021543
     */
    public function querySendDetails(array $queryParams = [])
    {
        // 默认请求体
        $body = [
            'action' => 'QuerySendDetails',
            'currentPage' => 1,
            'pageSize' => 10,
        ];
        // 如果存在当前页
        if(isset($queryParams['currentPage'])){
            $body['currentPage'] = $queryParams['currentPage'];
        }
        // 如果存在每页最大数量
        if(isset($queryParams['pageSize'])){
            $body['pageSize'] = $queryParams['pageSize'];
        }
        // 如果存在手机号
        if(isset($queryParams['phoneNumber'])){
            $body['phoneNumber'] = $queryParams['phoneNumber'];
        }
        // 如果存在短信发送日期
        if(isset($queryParams['sendDate'])){
            $body['sendDate'] = $queryParams['sendDate'];
        }
        // 如果存在签名
        if(isset($queryParams['signName'])){
            $body['signName'] = $queryParams['signName'];
        }
        // 如果存在模板编号
        if(isset($queryParams['templateCode'])){
            $body['templateCode'] = $queryParams['templateCode'];
        }
        // 如果存在流水号
        if(isset($queryParams['requestId'])){
            $body['requestId'] = $queryParams['requestId'];
        }

        // 返回查询结果
        return $this->post('/sms/api/v1', $body);
    }
}
