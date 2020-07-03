<?php
/*
 * @Author: Yunli
 * @Date: 2020-07-02 15:27:38
 * @LastEditors: Yunli
 * @LastEditTime: 2020-07-02 15:32:42
 * @Description:
 */
/**

 * 一维数据数组生成数据树
 * @param array $list 数据列表
 * @param string $id 父ID Key
 * @param string $pid ID Key
 * @param string $son 定义子数据Key
 * @return Collection
 */
function arr2tree($list, $id = 'id', $pid = 'pid', $son = 'children')
{
    list($tree, $map) = [[], []];
    foreach ($list as $item) {
        $map[$item[$id]] = $item;
    }

    foreach ($list as $item) {
        if (isset($item[$pid]) && isset($map[$item[$pid]])) {
            $map[$item[$pid]][$son][] = &$map[$item[$id]];
        } else {
            $tree[] = &$map[$item[$id]];
        }
    }
    unset($map);
    return $tree;
}

/**
 * 一维数据数组生成数据树
 * @param array $list 数据列表
 * @param string $id ID Key
 * @param string $pid 父ID Key
 * @param string $path
 * @param string $ppath
 * @return array
 */
function arr2table(array $list, $id = 'id', $pid = 'pid', $path = 'path', $ppath = '')
{
    $tree = [];
    foreach (arr2tree($list, $id, $pid) as $attr) {
        $attr[$path] = "{$ppath}-{$attr[$id]}";
        $attr['sub'] = isset($attr['sub']) ? $attr['sub'] : [];
        $attr['spt'] = substr_count($ppath, '-');
        $attr['spl'] = str_repeat("　├　", $attr['spt']);
        $sub = $attr['sub'];
        unset($attr['sub']);
        $tree[] = $attr;
        if (!empty($sub)) {
            $tree = array_merge($tree, arr2table($sub, $id, $pid, $path, $attr[$path]));
        }
    }
    return $tree;
}
