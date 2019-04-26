<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2019/4/26
 * Time: 12:39
 */

namespace Ganodermaking\LaravelSmallProgram\TouTiao;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

class TouTiaoService
{
    const LOGIN_CERTIFICATE_VERIFY_URL = '/api/apps/jscode2session';
    const ACCESS_TOKEN_URL = '/api/apps/token';
    const CONTENT_SECURITY_URL = '/api/v2/tags/text/antidirt';
    const IMAGE_SECURITY_URL = '/api/v2/tags/image/';

    public function __construct($config)
    {
        $this->url = $config['toutiao']['url'];
        $this->appid = $config['toutiao']['appid'];
        $this->secret = $config['toutiao']['secret'];
    }

    /**
     * 登录凭证校验
     * https://developer.toutiao.com/docs/open/jscode2session.html
     * @param string $code login接口返回的登录凭证
     * @param string $anonymousCode login接口返回的匿名登录凭证
     * @return array
     */
    public function loginCertificateVerify($code, $anonymousCode)
    {
        $query = [
            'appid' => $this->appid,
            'secret' => $this->secret,
            'code' => $code,
            'anonymous_code' => $anonymousCode,
        ];
        $client = new Client();
        $res = null;
        try {
            $res = $client->request('GET', $this->url . self::LOGIN_CERTIFICATE_VERIFY_URL, [
                'query' => $query
            ]);
            $data = json_decode($res, true);

            if (isset($data['code'])) {
                return [
                    'code' => 0,
                    'msg' => '成功',
                    'data' => $data
                ];
            }
            if (isset($res['error'])) {
                return [
                    'code' => $data['error'],
                    'msg' => $data['message'],
                    'data' => []
                ];
            }
        } catch (GuzzleException $exception) {
            return [
                'code' => -1,
                'msg' => '请求失败',
            ];
        }
    }

    /**
     * 获取 access_token
     * https://developer.toutiao.com/docs/open/accessToken.html
     * @return array
     */
    public function getAccessToken()
    {
        $query = [
            'appid' => $this->appid,
            'secret' => $this->secret,
            'grant_type' => 'client_credential',
        ];
        $client = new Client();
        $res = null;
        try {
            $res = $client->request('GET', $this->url . self::LOGIN_CERTIFICATE_VERIFY_URL, [
                'query' => $query
            ]);
            $data = json_decode($res, true);

            return [
                'code' => 0,
                'msg' => '成功',
                'data' => $data
            ];
        } catch (GuzzleException $exception) {
            $data = json_decode($res, true);
            return [
                'code' => -1,
                'msg' => '请求失败',
                'data' => $data
            ];
        }
    }

    /**
     * 内容安全检测
     * https://developer.toutiao.com/docs/open/textCheck.html
     * @param string $accessToken 小程序 access_token
     * @param string $content 要检测的文本
     * @return array
     */
    public function contentSecurity($accessToken, $content)
    {
        $headers = ['X-Token' => $accessToken];
        $body = [
            'tasks' => [
                ['content' => $content]
            ]
        ];
        $res = new Request('HEAD', $this->url . self::IMAGE_SECURITY_URL, $headers, json_encode($body));
        $data = json_decode($res, true);

        if (isset($data['log_id'])) {
            return [
                'code' => 0,
                'msg' => '成功',
                'data' => $data
            ];
        } else {
            return [
                'code' => $data['code'],
                'msg' => $data['message'],
                'data' => []
            ];
        }
    }

    /**
     * 图片检测
     * https://developer.toutiao.com/docs/open/imageCheck.html
     * @param string $accessToken 小程序 access_token
     * @param array $targets 图片检测服务类型，目前支持 porn、politics、ad、disgusting 四种
     * @param string $image 检测的图片链接
     * @return array
     */
    public function imageSecurity($accessToken, $targets, $image)
    {
        $headers = ['X-Token' => $accessToken];
        $body = [
            'targets' => $targets,
            'tasks' => [
                ['image' => $image]
            ]
        ];
        $res = new Request('HEAD', $this->url . self::CONTENT_SECURITY_URL, $headers, json_encode($body));
        $data = json_decode($res, true);

        if (isset($data['log_id'])) {
            return [
                'code' => 0,
                'msg' => '成功',
                'data' => $data
            ];
        } else {
            return [
                'code' => $data['code'],
                'msg' => $data['message'],
                'data' => []
            ];
        }
    }
}