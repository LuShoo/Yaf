<?php

/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2016/5/18
 * Time: 13:48
 */
class BreadCrumbService
{
    /**
     * 面包屑
     */
    public function getBreadCrumb()
    {
        $path = $_SERVER['REQUEST_URI'];
        $urlArr = explode('/', $path);
        $model = $urlArr['1'];
        $modelName = TZ_Loader::model('BreadCrumb', 'Admin')->select(array('action:eq' => $model), '*', 'ROW')['name'];
        $action = $urlArr['2'];
        $effect_path = '/' . $model . '/' . $action;
        $menuName = TZ_Loader::model('BreadCrumb', 'Admin')->select(array('action:like' => $effect_path), '*', 'ROW')['name'];
        echo '<h3 class="page-title"></h3>
                <ul class="breadcrumb" style="float: left;">
                <li style="margin-bottom: 0px;">
                    <a href="/admin/home/index.html"><i class="icon-home"></i></a><span class="divider">&nbsp;</span></li >';

        echo "<li style = 'margin-bottom: 0px;'>
                <a href='#'>$modelName</a >
                <span class='divider' >&nbsp;</span ></li >";

        echo "<li style = 'margin-bottom: 0px;' ><a href=$path> $menuName</a ><span
                    class='divider-last' >&nbsp;</span ></li></ul >";

    }
}