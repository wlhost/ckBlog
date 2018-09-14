<?php

class IchenkunFun
{

    /*********** 无限级分类工具开始 *************/
    /**
     * 组合成一维数组
     * @param $cate
     * @param string $html
     * @param int $pid
     * @param int $level
     * @return array
     */
    static public function unlimitedForLevel($cate, $html = '--', $pid = 0, $level = 0)
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level++;
                $v['html'] = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, self::unlimitedForLevel($cate, $html, $v['id'], $level + 1));
            }
        }
        return $arr;
    }

    /**
     * 组合成多维数组
     * @param $cate
     * @param string $name
     * @param int $pid
     * @return array
     */
    static public function unlimitedForLayer($cate, $name = 'child', $pid = 0)
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $v[$name] = self::unlimitedForLayer($cate, $name, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * 返回所有父集数组
     * @param $cate
     * @param $id
     * @return array
     */
    static public function getParents($cate, $id)
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['id'] == $id) {
                $arr[] = $v;
                $arr = array_merge(self::getParents($cate, $v['pid']), $arr);
            }
        }
        return $arr;
    }

    /**
     * 返回所有子集id数组
     * @param $cate
     * @param $pid
     * @return array
     */
    static public function getChildsId($cate, $pid)
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $arr[] = $v['id'];
                $arr = array_merge($arr, self::getChildsId($cate, $v['id']));
            }
        }
        return $arr;
    }

    /**
     * 传递一个父集分类ID返回所有子级分类数组
     * @param $cate
     * @param $pid
     * @return array
     */
    static public function getChildsByPId($cate, $pid)
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $arr[] = $v;
                $arr = array_merge($arr, self::getChildsByPId($cate, $v['id']));
            }
        }
        return $arr;
    }
    /*********** 无限级分类工具开始 *************/


    /***************网站记录工具开始 *******************/
    /**
     * 获取浏览器信息
     * @return array
     */
    public static function getBrowser()
    {
        $browser = array('name' => 'unknown', 'version' => 'unknown');

        if (empty($_SERVER['HTTP_USER_AGENT'])) return $browser;

        $agent = $_SERVER["HTTP_USER_AGENT"];

        /* Chrome should checked before safari.*/
        if (strpos($agent, 'Firefox') !== false) $browser['name'] = "firefox";
        if (strpos($agent, 'Opera') !== false) $browser['name'] = 'opera';
        if (strpos($agent, 'Safari') !== false) $browser['name'] = 'safari';
        if (strpos($agent, 'Chrome') !== false) $browser['name'] = "chrome";

        /* Check the name of browser */
        if (strpos($agent, 'MSIE') !== false || strpos($agent, 'rv:11.0')) $browser['name'] = 'ie';
        if (strpos($agent, 'Edge') !== false) $browser['name'] = 'edge';

        /* Check the version of browser */
        if (preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs)) $browser['version'] = $regs[1];
        if (preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs)) $browser['version'] = $regs[1];
        if (preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs)) $browser['version'] = $regs[1];
        if (preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs)) $browser['version'] = $regs[1];

        if ((strpos($agent, 'Chrome') == false) && preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs)) $browser['version'] = $regs[1];
        if (preg_match('/rv:(\d+)\..*/i', $agent, $regs)) $browser['version'] = $regs[1];
        if (preg_match('/Edge\/(\d+)\..*/i', $agent, $regs)) $browser['version'] = $regs[1];

        return $browser;
    }

    /**
     * 获取操作系统信息
     * @return mixed|string
     */
    public static function getOS()
    {
        if (empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $osList = array();
        $osList['/windows nt 10/i'] = 'Windows 10';
        $osList['/windows nt 6.3/i'] = 'Windows 8.1';
        $osList['/windows nt 6.2/i'] = 'Windows 8';
        $osList['/windows nt 6.1/i'] = 'Windows 7';
        $osList['/windows nt 6.0/i'] = 'Windows Vista';
        $osList['/windows nt 5.2/i'] = 'Windows Server 2003/XP x64';
        $osList['/windows nt 5.1/i'] = 'Windows XP';
        $osList['/windows xp/i'] = 'Windows XP';
        $osList['/windows nt 5.0/i'] = 'Windows 2000';
        $osList['/windows me/i'] = 'Windows ME';
        $osList['/win98/i'] = 'Windows 98';
        $osList['/win95/i'] = 'Windows 95';
        $osList['/win16/i'] = 'Windows 3.11';
        $osList['/macintosh|mac os x/i'] = 'Mac OS X';
        $osList['/mac_powerpc/i'] = 'Mac OS 9';
        $osList['/linux/i'] = 'Linux';
        $osList['/ubuntu/i'] = 'Ubuntu';
        $osList['/iphone/i'] = 'iPhone';
        $osList['/ipod/i'] = 'iPod';
        $osList['/ipad/i'] = 'iPad';
        $osList['/android/i'] = 'Android';
        $osList['/blackberry/i'] = 'BlackBerry';
        $osList['/webos/i'] = 'Mobile';

        foreach ($osList as $regex => $value) {
            if (preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) return $value;
        }

        return 'unknown';
    }

    /**
     * 获取ip
     * @return string
     */
    public static function getRemoteIp()
    {
        $ip = '';
        if(!empty($_SERVER["REMOTE_ADDR"]))          $ip = $_SERVER["REMOTE_ADDR"];
        if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        if(!empty($_SERVER['HTTP_CLIENT_IP']))       $ip = $_SERVER['HTTP_CLIENT_IP'];

        return $ip;
    }
    /***************网站记录工具结束 *******************/

}