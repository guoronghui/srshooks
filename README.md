[SRS](https://github.com/ossrs/srs)是一个简单高效的实时视频服务器，支持RTMP/WebRTC/HLS/HTTP-FLV/SRT/GB28181。
利用SRS自带的HTTP回调 [HTTPCallback](https://github.com/ossrs/srs/wiki/v4_CN_HTTPCallback)，可以实现推流鉴权，当客户端推流到SRS时，回调指定的http地址，这样可以实现验证功能。

1、部署PHP文件，将hooks.php上传到服务器，并可通过http://xxx.xx/hooks.php
访问当密码不匹配时，PHP返回1，当密码验证成功后返回0。
   
2、修改SRS配置文件，在srs.conf中加入以下代码，启用推流鉴权


    http_hooks {
        enabled         on;
        on_publish      http://172.17.0.1/hooks.php;  #主机验证地址
    }
    
推流地址的形式：rtmp://xxx.xx/live/xx?key=ca0526ea42d31cee


其中key以及密码都可在PHP文件中修改。

代码在srs:laster srs:4 版本中测试通过。
