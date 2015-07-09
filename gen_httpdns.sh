#########################################################################
# File Name: getlocal.sh
# Author: ma6174
# mail: ma6174@163.com
# Created Time: Wed 08 Jul 2015 01:56:31 PM CST
#########################################################################
#!/bin/bash

domain_tmpdir="/tmp/domain"

cat dns_header.php > dns_tmp.php

if [ ! -d ${domain_tmpdir} ] ; then
	mkdir -p ${domain_tmpdir}
	chmod -fR 777 ${domain_tmpdir}
	touch ${domain_tmp}/domain.txt
fi

cat /etc/hosts ${domain_tmpdir}/*.txt | awk '{ print $1" "$2}' | sort | uniq | \
	 awk '{ if(NF=2){ print "\""$2".\"=>\""$1"\"," } }' | sed "s/\.\././g" >> dns_tmp.php

cat dns_footer.php >> dns_tmp.php

cp -rf dns_tmp.php httpdns.php
