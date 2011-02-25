#!/bin/bash

sqlite3 cpumonitor.db "SELECT * FROM cpuload WHERE stamp > date('now', '-7 days')"


