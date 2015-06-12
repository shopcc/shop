<?php
return array(
	//'配置项'=>'配置值'
    //语言检查
    'LANG_SWITCH_ON' => true,//开启语言包
    'LANG_AUTO_DETECT'=> true,//开启自动侦测语言，开启多语言功能后有效
    'LANG_LIST' => 'zh-cn',//
    'VAR_LANGUAGE' => '1',
    //URL模式
    'URL_CASE_INSENSTIVE'  => true,//默认false表示URL区分大小写 true 则表示不区分大小写
    'URL_MODEL'            => '2',
    //0(普通模式) 1(PATHINFO模式) 2(REWRITE模式) 3(兼容模式)
    'URL_PATHINFO_DEPR'    => '/',// PATHINFO模式下，各参数之间的分割符
    'URL_HTML_SUFFIX'      => 'html',

    //默认设置
    'MODULE_ALLOW_LIST'    => array('Home','Admin'),
    'DEFAULT_CHARSET'      => 'utf-8',
    'DEFAULT_TIMEZONE'     => 'PRC',
    'DEFAULT_AJAX_RETURN'  => 'JSON',
    'DEFAULT_FILTER'       => 'htmlspecialchars',
    'SHOW_PAGE_TRACE'      => true,

    //SESSION设置
    'SESSION_AUTO_START'   => true,
    'SESSION_OPTIONS'       =>  array('name'=>'session_id','expire'=>3600), // session 配置数组 支持type name id path expire domain 等参数
    
    //COOKIE设置
    'COOKIE_EXPIRE'         =>  1800,    // Cookie有效期
    'COOKIE_PREFIX'         =>  'goods_',      // Cookie前缀 避免冲突
    //模板设置
    'TMPL_ENGINE_TYPE'     => 'Think',
    'TMPL_TEMPLATE_SUFFIX' => '.html',
    'TMPL_L_DELIM'         => '{',
    'TMPL_R_DELIM'         => '}',

    //数据库连接
    'DB_TYPE'              => 'mysql',
    'DB_HOST'              => 'localhost',
    'DB_NAME'              => 'shopcc',
    'DB_USER'              => 'root',
    'DB_PWD'               => 'root',
    'DB_PORT'              => '3306',
    'DB_PREFIX'            => 'cz_',
    'DB_CHARSET'           => 'utf-8',


);