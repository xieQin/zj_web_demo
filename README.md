# zj_web_demo

DEMO for ZJ WEB-FRONT

1. Action 
控制器：
BaseAction 主要为Action类的基础方法，包含各种url跳转及消息提示

2. Bussiness
主要的业务代码

BBaseFacade.class.php: post调用服务器接口的底层方法
getApiHeaderPara() 用于生成请求时的参数h
getPrivatePara() 用于生成请求时的参数p
doCurlPostRequest() 为请求接口时的自定义方法，包括是否加密、请求url、超时设置、是否缓存
post() 为post请求的底层方法

ApiServiceFacade.class.php: 调用服务器接口的封装方法，用于传入服务器接口地址并对接口调用初始相关设置

DemoApiCenterFacade.class.php: 请求接口的具体业余代码，用于传入接口文档要求的参数

Entity: 此文件夹下存放相应接口的参数类

LoginService.class.php: 登录相关的业余文件
用户登录后将用户唯一标识加密后再附加随机30位字符作为特征码存放在cookie中，
用户信息则存放于memcache中，同时用户信息添加之前生成的特征码
获取已登录用户信息时比对cookie与memcache中的特征码是否一致
doLogin() 生成登录用户的特征码
saveLogin() 将用户信息存入memcache
loginOut() 登录退出操作
delLoginInfo() 清空memcache
getLoginUser() 获取已登录用户信息
checkLoginValid() 检测是否登录

3. _Conf
配置文件
app.config.php
dev.config.php
pub.config.php

4. _Factory
工厂类文件

5._Lib
外部类或库文件

6._Server

7._Tpl
Action调用的相应视图模板文件

8.public
前端静态资源：css、images、js

9.index.php
项目入口文件