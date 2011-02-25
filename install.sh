#!/bin/bash

echo "Checking System…"
thisDir=`pwd`

if [ "/opt/CpuMonitor" != $thisDir ] ; then
	echo "ERROR: You are not in /opt/CpuMonitor"
	exit
fi

echo "Creating tables…"
cd web
../deamon/createTable.sh
cd ../deamon
ln -s ../web/cpumonitor.db ./cpumonitor.db
cd ..

echo "Copy init.d startscript…"

cd /etc/init.d
ln -s $thisDir/deamon/cpumonitor.init ./cpumonitor
cd /etc/rc3.d
ln -s ../init.d/cpumonitor ./S50cpumonitor

echo "Startup logger…"
cd $thisDir
/etc/init.d/cpumonitor start

echo "I****************************************************************I"
echo "I You have to link the web-folder into your docroot, with ln -s! I"
echo "I                                                                I"
echo "I Go to your docroot and type:                                   I"
echo "I ln -s /opt/CpuMonitor/web ./CpuMonitor                         I"
echo "I                                                                I"
echo "I****************************************************************I"

echo "done."

