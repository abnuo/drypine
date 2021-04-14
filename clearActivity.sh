#!/bin/bash
source /Users/queddd/Sites/.bash_profile
/usr/local/bin/mysql --user=root --password=$SQL_PASSWORD --database=activity --execute="DELETE FROM activity;"
