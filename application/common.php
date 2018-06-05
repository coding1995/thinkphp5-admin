<?php
use think\Db;
//公共函数
/**
 * [pswCrypt description]密码加密
 * @param  [type] $psw [description]
 * @return [type]      [description]
 */
function pswCrypt($psw){
    $psw = md5($psw);
    $salt = substr($psw,0,4);
    $psw = crypt($psw,$salt);
    return $psw;
}


/**
 * [getActionUrl description]获取当前url
 * @return [type] [description]
 */
function getActionUrl(){
    $module = request()->module();
    $controller = request()->controller();
    $action = request()->action();
    return strtolower($module.'/'.$controller.'/'.$action);

}


/**
 * 数组层级缩进转换
 * @param array $array
 * @param int   $pid
 * @param int   $level
 * @return array
 */
function tree($array, $pid = 0, $level = 1) {
    static $list = [];
    foreach ($array as $v) {
        if ($v['parent_id'] == $pid) {
            $v['level'] = $level;
            $list[]     = $v;
            $this->tree($array, $v['id'], $level + 1);
        }
    }
    return $list;
}

/**
 * 构建层级（树状）数组
 * @param array  $array 要进行处理的一维数组，经过该函数处理后，该数组自动转为树状数组
 * @param string $pid 父级ID的字段名
 * @param string $child_key_name 子元素键名
 * @return array|bool
 */
function array2tree(&$array, $pid = 'pid', $child_key_name = 'children') {
    $counter = $this->array_children_count($array, $pid);
    if ($counter[0] == 0){
        return false;
    }
    $tree = [];
    while (isset($counter[0]) && $counter[0] > 0) {
        $temp = array_shift($array);
        if (isset($counter[$temp['id']]) && $counter[$temp['id']] > 0) {
            array_push($array, $temp);
        } else {
            if ($temp[$pid] == 0) {
                $tree[] = $temp;
            } else {
                $array = $this->array_child_append($array, $temp[$pid], $temp, $child_key_name);
            }
        }
        $counter = $this->array_children_count($array, $pid);
    }

    return $tree;
}

/**
 * 子元素计数器
 * @param $array
 * @param $pid
 * @return array
 */
function array_children_count($array, $pid) {
    $counter = [];
    foreach ($array as $item) {
        $count = isset($counter[$item[$pid]]) ? $counter[$item[$pid]] : 0;
        $count++;
        $counter[$item[$pid]] = $count;
    }

    return $counter;
}

/**
 * 把元素插入到对应的父元素$child_key_name字段
 * @param        $parent
 * @param        $pid
 * @param        $child
 * @param string $child_key_name 子元素键名
 * @return mixed
 */
function array_child_append($parent, $pid, $child, $child_key_name) {
    foreach ($parent as &$item) {
        if ($item['id'] == $pid) {
            if (!isset($item[$child_key_name]))
                $item[$child_key_name] = [];
            $item[$child_key_name][] = $child;
        }
    }

    return $parent;
}


/**
 * [log description]打印日志
 * @param  [type] $name  [description]
 * @param  [type] $value [description]
 * @param  [type] $file  [description]
 * @param  [type] $line  [description]
 * @return [type]        [description]
 */
function logs($name, $value, $file = __FILE__, $line = __LINE__) {
    $value = date('Y-m-d H:i:s') . " " . $value;
    return app_log(date('Ymd') . $name, $value, "", $line);
}

/**
 * [app_log description]日志
 * @param  [type] $name  [description]
 * @param  [type] $value [description]
 * @param  [type] $file  [description]
 * @param  [type] $line  [description]
 * @return [type]        [description]
 */
function app_log($name,$value,$file=__FILE__,$line=__LINE__){
    $value="<?exit;?".">$file\t$line\t".$value."\n";
    if (!is_dir(ROOT_PATH.'cache')){//当路径不穿在  
        mkdir(ROOT_PATH.'cache', 0777); 
        chmod(ROOT_PATH.'cache', 0777);
    }
    file_put_contents(ROOT_PATH.'cache/log.'.$name.'.php',$value,FILE_APPEND);
}


