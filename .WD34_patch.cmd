@echo off
@cls
if exist C:\xampp\apache\conf\httpd.conf (
	find """C:/Users/johnp/OneDrive/Desktop/Web Development Course/PHP/.WD34.conf""" C:\xampp\apache\conf\httpd.conf
	if ERRORLEVEL 1 (
		echo Patching WD34...
		echo Include "C:/Users/johnp/OneDrive/Desktop/Web Development Course/PHP/.WD34.conf" >> C:\xampp\apache\conf\httpd.conf
	) else (
		echo WD34 already patched!
	)
) else (
	echo Cannot find apache config file!
)
pause
