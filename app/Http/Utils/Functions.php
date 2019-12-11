<?php
/**公共函数库
 * User: yaolh
 * Date: 2019/11/15
 */

/**
 * Excel解析，按sheet索引解析数据
 * @param $reader
 * @param $sheet
 * @return array
 */
function readExcelSheet($reader,$sheet){
    $arg=array();
    //获取excel的第几张表
    $reader = $reader->getSheet($sheet);
    //获取表中的数据
    $data = $reader->toArray();
    foreach ($data as $item){
        if($item[0]){
            $arg[]=$item;
        }
    }
    return $arg;
}

/**
 * Excel解析按sheet标题解析数据
 * @param $reader
 * @param $title
 * @return array
 */
function readExcelSheetTitle($reader,$title){
    $arg=array();
    //获取excel的第几张表
    $reader = $reader->getTitle($title);
    //获取表中的数据
    $data = $reader->toArray();
    foreach ($data as $item){
        if($item[0]){
            $arg[]=$item;
        }
    }
    return $arg;
}