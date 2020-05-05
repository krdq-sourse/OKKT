<?php
 $query = $_SERVER['QUERY_STRING'];
require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';



Router::add('post/add',['controller'=>'Posts','action'=>'add']);
Router::add('post/her',['controller'=>'Posts','action'=>'her']);
debug(Router::getRoutes());