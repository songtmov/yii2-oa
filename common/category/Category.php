<?php

namespace common\category;

use Yii;
/**
 * 数据处理类
 */
class Category
{
    /**
     *
     * [findson 查找指定栏目的子栏目]
     * @param  [type]  $cate [操作的数组]
     * @param  integer $id   [传递过来的值子栏目名称]
     * @return [type]        [description]
     */
    static public function findson($cate,$id=0){
        $arr = array();
        foreach ($cate as $v) {
            if($v['parent_id'] == $id){
                $arr[] = $v;
            }
        }
        return $arr;

    }
    /**
     *
     * [unlimitedForLevel 根据传过来的id组合一维数组]
     * @param  [type]  $cate  [操作的数组]
     * @param  string  $html  [为非顶级类别添加一些空格或符号]
     * @param  integer $pid   [传递过来的值子栏目名称]
     * @param  integer $level [级别]
     * @return [type]         [description]
     */
    static public function unlimitedForLevel($cate,$html='',$pid=0,$level=0)
    {
        $arr = [];
        foreach ($cate as $v) {
            if($v['parent_id'] == $pid){
                $v['level'] = $level + 1;
                $v['html'] = str_repeat($html,$level);
                $arr[] = $v;
                $arr = array_merge($arr,self::unlimitedForLevel($cate,$html,$v['id'],$level+1));
            }
        }
        return $arr;
    }
    public static function getTree($data,$pid = 0,$level=1){
        $tree = [];
        foreach($data as $v){
            if($v['parent_id'] == $pid){

                $v['entry_name'] = '|'.str_repeat('_____',$level).$v['entry_name'];

                $tree[] = $v;

                $tree = array_merge($tree,self::getTree($data,$v['id'],$level+1));
            }
        }
        return $tree;

    }
    public static function getClassify($data,$pid = 0,$level=1){
        $tree = [];
        foreach($data as $v){
            if($v['parent_id'] == $pid){

                $v['name'] = '|'.str_repeat('_____',$level).$v['name'];

                $tree[] = $v;

                $tree = array_merge($tree,self::getClassify($data,$v['id'],$level+1));
            }
        }
        return $tree;

    }

    /**
     *
     * [unlimitedForLayer 根据传过来的id组合多维数组]
     * @param  [type]  $cate [操作的数组]
     * @param  string  $name [子栏目名称]
     * @param  integer $pid  [传递过来的值子栏目名称]
     * @return [type]        [description]
     */
    static public function unlimitedForLayer($cate,$name='son',$pid=0){
        $arr = [];
        foreach ($cate as $v) {
            if($v['parent_id'] == $pid){
                $v[$name] = self::unlimitedForLayer($cate,$name,$v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * [getParents 传递一个子分类ID返回所有父级分类]
     * @param  [type] $cate [操作的数组]
     * @param  [type] $id   [传递过来的值子栏目名称]
     * @return [type]       [description]
     */
    static public function getParents($cate, $id){
        $arr = array();
        foreach ($cate as $v) {
            if($v['id'] == $id){
                $arr[] = $v;
                $arr = array_merge(self::getParents($cate,$v['parent_id']),$arr);
            }
        }
        return $arr;
    }

    /**
     * [getChildsId 传递一个父级分类的id返回所有子分类ID]
     * @param  [type] $cate [操作的数组]
     * @param  [type] $pid  [传递过来的值子栏目名称]
     * @return [type]       [description]
     */
    static public function getChildsId($cate,$pid){
        $arr = array();
        foreach ($cate as $v) {
            if($v['pid'] == $pid){
                $arr[] = $v['id'];
                $arr = array_merge($arr,self::getChildsId($cate,$v['id']));
            }
        }
        return $arr;
    }
    /**
     * [getChilds 传递一个父级分类的id返回所有子分类]
     * @param  [type] $cate [操作的数组]
     * @param  [type] $pid  [传递过来的值子栏目名称]
     * @return [type]       [description]
     */
    static public function getChilds($cate,$pid){
        $arr = array();
        foreach ($cate as $v) {
            if($v['pid'] == $pid){
                $arr[] = $v;
                $arr = array_merge($arr,self::getChilds($cate,$v['id']));
            }
        }
        return $arr;
    }
}

?>