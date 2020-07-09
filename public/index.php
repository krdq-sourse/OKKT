<?php
use vendor\core\Router;
 error_reporting(-1);

 $query = rtrim( $_SERVER['QUERY_STRING'],'/');
 define('WWW',__DIR__);
 define('CORE',dirname( __DIR__).'/vendor/core');
 define('ROOT',dirname( __DIR__));
 define('APP',dirname( __DIR__).'/app');
//require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

spl_autoload_register(function ($class){
    $file = ROOT . '/'.str_replace('\\','/',$class).'.php';
    //$file = APP."/controllers/$class.php";
    //debug($class);
    if(is_file($file))
    {
        require_once $file;
    }
});


//Router::add('post/add',['controller'=>'Posts','action'=>'add']);
//Router::add('post/her',['controller'=>'Posts','action'=>'her']);
//debug(Router::getRoutes());
Router::add('^pages/?(?P<action>[a-z-]+)?$',['controller'=>'posts','action'=>'index']);
Router::add('^$',['controller'=>'Main','action'=>'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
//debug(Router::getRoutes());
//if(Router::matchRoute($query)){
//    debug(Router::getRoute());
//}else{
//    echo "ебать ты... ой тоетсь ошибка 404, страница не найдена))";
//}
Router::dispatch($query);
