<?php
/**
 *
 * @authors xieq
 * @date    2014-10-13 17:56:34
 */

class ApiHeaderPara {

    /**
     * 请求token
     * @var type
     */
    public $token;

    /**
     * 请求的方法
     * @var string
     */
    public $act;

    /**
     * 设备操作系统（device os）: ios、wp、android.
     * @var string
     */
    public $os;

    /**
     * 设备系统版本号（device version）：ios7.0、 android4.3.
     * @var string
     */
    public $dv;

    /**
     * 设备类型（device type）：iphone5S、ipad3
     * @var string
     */
    public $dt;

    /**
     * 屏幕尺度（长*宽）
     * @var string
     */
    public $ss;

    /**
     * 用户ID，登录用户传该信息，主要用于记录日志
     * @var string
     */
    public $uid;
}