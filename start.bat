@echo off
echo "采集执行中"
%~dp0\package\php72\php.exe -q %~dp0\Index.php
@pause