#########################################################################
# File Name: gen_httpdns.sh
# Author: raindylong
# mail: longweijin@gmail.com
# Created Time: Wed 08 Jul 2015 01:56:31 PM CST
#########################################################################
#!/bin/bash

domain_tmpdir="/tmp/domain"

cat dns_header.php > dns_tmp.php

if [ ! -d ${domain_tmpdir} ] ; then
	mkdir -p ${domain_tmpdir}
	chmod -fR 777 ${domain_tmpdir} ## 让php能写入此目录
	touch ${domain_tmpdir}/domain.txt
fi

ls -ltr /tmp/domain/* | awk '{print $NF}' > /tmp/domain_dnsproxy.txt
WCC=`wc -l /tmp/domain_dnsproxy.txt | awk '{print $1}'`

if [ ${WCC} -ge 4000 ] ; then
	head -1000 /tmp/domain_dnsproxy.txt | xargs rm 

fi

cat /etc/hosts ${domain_tmpdir}/*.txt | grep -v "^#" | awk '{ print $1" "$2}' | sort | uniq | \
	 awk '{ if(NF=2){ print "\""$2".\"=>\""$1"\"," } }' | sed "s/\.\././g" >> dns_tmp.php

cat dns_footer.php >> dns_tmp.php

cp -rf dns_tmp.php httpdns.php
