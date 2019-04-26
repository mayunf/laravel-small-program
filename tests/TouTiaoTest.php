<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2019/4/26
 * Time: 14:51
 */

namespace Ganodermaking\SmallProgram\Tests;

use PHPUnit\Framework\TestCase;
use Ganodermaking\SmallProgram\TouTiao;

class TouTiaoTest extends TestCase
{
    public function testLoginCertificateVerify()
    {
        $toutiao = new TouTiao();
        $res = $toutiao->loginCertificateVerify('', '');
        $this->assertEquals(0, $res['code']);
    }
}