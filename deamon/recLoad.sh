#!/bin/bash

processors=`mpstat 0 1 | awk '{if($1 != "CPU") print "INSERT INTO cpuload (cpu, value, stamp) VALUES (" $1 ", " int(($16 -100)*-1) ",datetime());";}' | wc -l`

for (( ;; )) do
	mpstat 10 2 | awk '{if($1 != "CPU") print "INSERT INTO cpuload (cpu, value, stamp) VALUES (" $1 ", " int(($16 -100)*-1) ",datetime());";}' | tail -`echo $processors` | sqlite3 "cpumonitor.db"

done

