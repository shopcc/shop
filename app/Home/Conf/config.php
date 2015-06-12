<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_THEME'    => 'default',//默认主题名称
	'DEFAULT_LANG'     => 'zh_cn',//默认语言
    'TMPL_FILE_DEPR'        =>  '/', //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符
    //日志设置
    'LOG_RECORD'       => true,
    'LOG_TYPE'         => 'File',
    'LOG_LEVEL'        => 'ERR',
    'LOG_EXCEPTION_RECORD' => false,
    //价格设置
    'PRICE_FORMAT'    => 5,
    'CURRENCY_FORMAT' => '￥%s元',
    'GOODSATTR_STYLE' => 1,
    //URL设置
    'URL_CASE_INSENSTIVE'  => true,//默认false表示URL区分大小写 true 则表示不区分大小写
    'URL_MODEL'            => '2',
    'URL_PATHINFO_DEPR'    => '-',// PATHINFO模式下，各参数之间的分割符
    //模板引擎设置
    'TMPL_ACTION_ERROR'     => 'Public/dispatch_jump', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   => 'Public/dispatch_jump', // 默认成功跳转对应的模板文件
    //开启路由
    'URL_ROUTER_ON'   => true, 
    'URL_ROUTE_RULES'=>array(
        'category/cid/:id' => 'category/:1',
        'news/:id' => array('Home/Goods/detail'), //资讯详情
        )
);