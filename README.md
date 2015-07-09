# 中文版说明

## 流程

[dns客户端]--->[dnsp进程]--->[httpdns]--->[dnspod-httpdns]

## 安装步骤

### 编译dnsp

如果是Ubuntu/Debain:

`apt-get install libcurl4-openssl-dev`

然后
`make`

### 把httpdns.php放入你的PHP/Webserver环境中

得到一个可用的URL，例如：http://localhost/httpdns.php


### 启动dnsp

`nohup dnsp -l 127.0.0.1 -s http://localhost/httpdns.php &`

### 如果想实现简单缓存

把gen_httpdns.sh放入crontab中执行，定时生成新的httpdns.php文件，并copy到你的webroot目录中（需要自行修改一下脚本）

`*/15 * * * * ( cd /home/httpdns ; ./gen_httpdns.sh >/dev/null )`



--------------------------------------------------------------------------------

# DNS Proxy

DNS proxy listens for incoming DNS requests on the local interface and 
resolves remote hosts using an external PHP script, through http proxy requests. 

If you can't use VPN, UDP tunnels or other methods to resolve external names 
in your LAN, DNS proxy is a good and simple solution.

## Building

For debian/ubuntu users:  
`apt-get install libcurl4-openssl-dev`

then

`make`

## Process

Put PHP script to your PHP/Webserver , and get the valid URL , such as:
http://localhost/httpdns.php

The process
[dns client] ---> [dnsproxy] ----> [httpserver] ----> [dnspod-httpdns]

## Usage 

If you have one http_proxy , just run like that:
```bash
dnsp -l 127.0.0.1 -h 127.0.0.1 -r 3128 -s http://localhost/httpdns.php
```
or
```bash
dnsp -l 127.0.0.1 -s http://localhost/httpdns.php
```

In this case, DNS proxy listens on port 53 (bind on 127.0.0.1) and sends the
requests to external script through the 10.0.0.2:8080 proxy.

**IMPORTANT:** Please, don't use the script hosted on my server, it's only for testing purpose. 
Instead host the nslookup.php script on your own server or use a free hosting services. Thanks!

```bash
 dnsp 0.5
 usage: dnsp -l [local_host] -h [proxy_host] -r [proxy_port] -s [lookup_script]

 OPTIONS:
      -v  	 Enable DEBUG mode
      -p		 Local port
      -l		 Local host
      -r		 Proxy port
      -h		 Proxy host
      -u		 Proxy username (optional)
      -k		 Proxy password (optional)
      -s		 Lookup script URL
```
## Testing

To test if DNS proxy is working correctly, first run the program as following (replace the placeholders with the correct proxy IP and port!):

```bash
dnsp -l 127.0.0.1 -h x.x.x.x -r nnnn -s http://www.andreafabrizi.it/nslookup.php
```

then, try to resolve an hostname using the **dig** command:

```bash
dig www.google.com @127.0.0.1
```

The result must be something like this:

```
; <<>> DiG 9.8.1-P1 <<>> www.google.com @127.0.0.1
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 29155
;; flags: qr aa rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 0

;; QUESTION SECTION:
;www.google.com. 		IN	A

;; ANSWER SECTION:
www.google.com.		3600	IN	A	173.194.64.106

;; Query time: 325 msec
;; SERVER: 127.0.0.1#53(127.0.0.1)
;; WHEN: Fri May 17 11:52:08 2013
;; MSG SIZE  rcvd: 48
```

## Changelog:

Version 0.5 - 20150708
* Add httpdns.php support dnspod-httpdns

Version 0.5 - May 17 2013:
* Add proxy authentication support
* port option is now optional (default is 53)
* Fixed compilation error
* Minor bug fixes

Version 0.4 - November 16 2009:
* Now using libCurl for http requests
* Implemented concurrent DNS server
* Bug fixes
* Code clean

Version 0.1 - April 09 2009:
* Initial release
