<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/2/7
 * Time: 16:28
 */

namespace SABundle\Entity;


class Mail
{
    public static function body($body){
        $html = '<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{font-family: "微软雅黑", sans-serif}
        .container{width:100%; font-family:\'Microsoft YaHei\';font-size:14px;}
        .row{margin:auto;max-width:732px;border:solid 1px #ccc;}
        a{text-decoration:none;color:#00bcd4;}
        .zh{color:#666;margin-top:5px; }
                    .en{color:#999;margin-top:5px; }
                        .p{margin-top:30px;}
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div style="padding:25px 10%;">
            <div style="text-align:right;">
                <img src="http://chain.oilsns.com/Public/img/logo_oilyp.png" style="width:110px;" />
            </div>

            <!-- 邮件内容开始  -->

            <!-- 段落开始，直接成段拷贝使用 -->
            <div class="p">
                '.$body.'
            </div>

            <!-- 链接段结束，直接成段拷贝使用 -->

            <!-- 邮件内容结束  -->


            <!-- 底部开始 -->
            <div style="margin-top:80px;border-top:solid 1px #eee;text-align:center;line-height:30px;padding-top:10px;">
                <div>
                    <a style="text-decoration:none;color:#00bcd4;" href="http://www.oilsns.com/contactus" target="_blank">联系我们</a> &nbsp;&nbsp;&nbsp; <a style="text-decoration:none;color:#00bcd4;" href="http://www.oilsns.com/contactus" target="_blank">contact</a>
                </div>
                <div style="color:#ccc;"><span style="font-family:arial;">&copy;</span> 2016 石油圈  &nbsp; 津ICP备15004515号-2</div>
            </div>
            <!-- 底部结束 -->
        </div>
    </div>
</div>
</body>
</html>';
        return $html;
    }
}