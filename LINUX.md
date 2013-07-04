1. Ubuntu chromium install flashplugin:
http://www.mintos.org/network/linux-chromium-flash.html
http://rongjih.blog.163.com/blog/static/33574461201112672455580/

<pre>
$ sudo apt-get install flashplugin-nonfree
</pre>

2. Ubuntu config virtualhost configured virtual host
http://rmingwang.com/ubuntu-config-virtualhost-configured-virtual-host.html

3. Ubuntu install nodejs && npm

http://dev-tricks.com/tutorialhow-to-install-nodejs-on-centos-6-3/

Method 1:
<pre>
apt-get install python g++ make
mkdir ~/nodejs && cd $_
wget -N http://nodejs.org/dist/node-latest.tar.gz
tar xzvf node-latest.tar.gz && cd `ls -rd node-v*`
./configure
make install
</pre>

Method 2:
<pre>
cd /usr/local/src/
wget -N http://nodejs.org/dist/node-latest.tar.gz
tar xzvf node-latest.tar.gz
cd node-latest
</pre>

<pre>
yum install openssl-devel gcc-c++ gcc
</pre>

<pre>
make
make install
</pre>

Test:
<pre>
node -v
npm -v
</pre>

4. Ubuntu install composer globally
<pre>
$ curl -sS https://getcomposer.org/installer | php
$ mv composer.phar /usr/local/bin/composer
</pre>
