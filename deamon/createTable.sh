#!/bin/bash

sqlite3 cpumonitor.db "CREATE TABLE cpuload (cpu INT, value INT, stamp TIMESTAMP ); CREATE INDEX idx_workload_cpu_time ON cpuload (cpu, stamp);"


#
