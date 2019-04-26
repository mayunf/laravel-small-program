<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2019/4/26
 * Time: 15:08
 */

namespace Ganodermaking\Small;


class SmallService
{
    public $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 今日头条
     *
     * @return void
     */
    public function toutiao()
    {
        return new TouTiaoService($this->config);
    }
}