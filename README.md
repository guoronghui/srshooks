# srs_callback
SRS 推流 鉴权 加密

部署PHP文件，并修改SRS配置文件，启用推流鉴权


    http_hooks {
        enabled         on;
        on_publish      http://172.17.0.1/hooks.php;  #宿主机验证地址
    }
    
推流地址 rtmp://xxx.xx/live/xx?key=ca0526ea42d31cee

其中key 可在PHP文件中修改。
