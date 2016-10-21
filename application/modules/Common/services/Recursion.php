<?php

class RecursionService{

    //父级找子级
    public function getChild($arrCat, $parent_id = 0, $levels = 0)
    {
        static  $arrTree = array();
        if( empty($arrCat)) return FALSE;
        $levels++;
        foreach($arrCat as $key => $value)
        {
            if($value['parent_id' ] == $parent_id)
            {
                $value[ 'levels'] = $levels;
                $arrTree[] = $value;
                unset($arrCat[$key]);
                //$this->getChild($arrCat, $value[ 'id'], $levels);
            }
        }

        return $arrTree;
    }

    //递归
    public function _formatData($list, $pid = 0)
    {
        $child = array();
        foreach ($list as $val){
            if($val['parent_id'] == $pid){
                $child[] = $val;
            }
        }
        foreach($child as $key=>$v){
            $child[$key]['child'] = $this->_formatData($list, $v['id']);
        }
        return $child;
    }
    //递归2
    public function _formatData2($list, $pid = 0, $level=0)
    {
        static $temArr= [];
        foreach($list as $key=>$val){
            if($val['parent_id'] == $pid){
                $val['level'] = $level;
                $temArr[] = $val;
                $this->_formatData2($list, $val['id'], $level+1);
            }
        }
        return $temArr;
    }
}
?>