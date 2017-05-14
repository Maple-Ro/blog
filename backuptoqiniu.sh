#!/bin/bash
#author:ccbikai
#web:http://miantiao.me

## 备份配置信息 ##

# 备份名称，用于标记
BACKUP_NAME="backup"
# 备份目录，多个请空格分隔
BACKUP_SRC="/var/log/mongodb"
# Mysql主机地址
MONGODB_SERVER="127.0.0.1"
# Mysql备份数据库，多个请空格分隔
MONGODB_DBS="blog"
# 备份文件临时存放目录，一般不需要更改
BACKUP_DIR="/tmp/backuptoqiniu"
# 备份文件压缩密码
BACKUP_FILE_PASSWD="hello589321"

## 备份配置信息 End ##

## Funs ##
NOW=$(date +"%Y%m%d%H%M%S") #精确到秒，统一秒内上传的文件会被覆盖

mkdir -p $BACKUP_DIR

# 备份Mysql
echo "start dump mongodb"
	mongodump  -h $MONGODB_SERVER -d $MONGODB_DBS -o "$BACKUP_DIR/$BACKUP_NAME-$MONGODB_DBS"
echo "dump ok"

# 打包
echo "start tar"
BACKUP_FILENAME="$BACKUP_NAME-mongodb-$NOW.zip"
zip -q -r -P $BACKUP_FILE_PASSWD $BACKUP_SRC/$BACKUP_FILENAME $BACKUP_DIR/$BACKUP_NAME-$MONGODB_DBS
echo "tar ok"

# 上传
echo "start upload"
php 7niu_upload.php $BACKUP_SRC/$BACKUP_FILENAME
echo "upload ok"

# 清理备份文件
rm -rf $BACKUP_DIR
echo "backup clean done"
