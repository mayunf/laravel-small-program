<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2019/4/26
 * Time: 14:51
 */

namespace Ganodermaking\Small\Tests;

use Ganodermaking\Small\TouTiao\TouTiaoService;
use PHPUnit\Framework\TestCase;

class TouTiaoTest extends TestCase
{
    public function testLoginCertificateVerify()
    {
        $touTiaoService = new TouTiaoService();
        $res = $touTiaoService->loginCertificateVerify('', '');
        $this->assertEquals(0, $res['code']);
    }
}