<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2019/4/26
 * Time: 15:08
 */

namespace Ganodermaking\LaravelSmallProgram;

use Ganodermaking\LaravelSmallProgram\TouTiao\TouTiaoService;

class SmallProgramService
{
    public $config;
    public $toutiao;

    public function __construct($config = null)
    {
        $this->config = $config;
        $this->toutiao = new TouTiaoService($this->config);
    }
}