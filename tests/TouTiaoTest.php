<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2019/4/26
 * Time: 14:51
 */

namespace Ganodermaking\LaravelSmallProgram\Tests;

use Ganodermaking\LaravelSmallProgram\TouTiao\TouTiaoService;
use PHPUnit\Framework\TestCase;

class TouTiaoTest extends TestCase
{
    public function testLoginCertificateVerify()
    {
        $touTiaoService = new TouTiaoService($config = array());
        $res = $touTiaoService->loginCertificateVerify('', '');
        $this->assertEquals(0, $res['code']);
    }
}