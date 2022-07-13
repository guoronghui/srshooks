# srs_callback
SRS 推流 鉴权 加密

1、部署PHP文件，将hooks.php上传到服务器，并可通过http://xxx.xx/hooks.php访问
   当密码不匹配时，PHP返回1，当密码验证成功后返回0。
2、修改SRS配置文件，在srs.conf中加入以下代码，启用推流鉴权


    http_hooks {
        enabled         on;
        on_publish      http://172.17.0.1/hooks.php;  #主机验证地址
    }
    
推流地址的形式：rtmp://xxx.xx/live/xx?key=ca0526ea42d31cee

其中key以及密码都可在PHP文件中修改。
