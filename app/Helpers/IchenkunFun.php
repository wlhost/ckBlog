<?php

class IchenkunFun {

    /*********** 无限级分类工具开始 *************/
    /**
     * 组合成一维数组
     * @param $cate
     * @param string $html
     * @param int $pid
     * @param int $level
     * @return array
     */
    static public function unlimitedForLevel($cate, $html='--', $pid=0, $level=0){
        $arr=array();
        foreach($cate as $v){
            if($v['pid']==$pid){
                $v['level']=$level++;
                $v['html']=str_repeat($html,$level);
                $arr[]=$v;
                $arr=array_merge($arr,self::unlimitedForLevel($cate, $html, $v['id'], $level+1));
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
    static public function unlimitedForLayer($cate,$name='child',$pid=0){
        $arr=array();
        foreach($cate as $v){
            if($v['pid']==$pid){
                $v[$name]=self::unlimitedForLayer($cate,$name,$v['id']);
                $arr[]=$v;
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
    static public function getParents($cate,$id){
        $arr=array();
        foreach($cate as $v){
            if($v['id']==$id){
                $arr[]=$v;
                $arr=array_merge(self::getParents($cate,$v['pid']),$arr);
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
    static public function getChildsId($cate, $pid){
        $arr=array();
        foreach ($cate as $v){
            if($v['pid']==$pid){
                $arr[]=$v['id'];
                $arr=array_merge($arr,self::getChildsId($cate,$v['id']));
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
    static public function getChildsByPId($cate, $pid){
        $arr=array();
        foreach ($cate as $v){
            if($v['pid']==$pid){
                $arr[]=$v;
                $arr=array_merge($arr,self::getChildsByPId($cate,$v['id']));
            }
        }
        return $arr;
    }
    /*********** 无限级分类工具开始 *************/




}