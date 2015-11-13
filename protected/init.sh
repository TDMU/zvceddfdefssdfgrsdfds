# Setup directory permissions
chmod 777 ./assets
chmod 777 ./protected/runtime
chmod 777 ./protected/runtime/cache
chmod 777 ./images/uploads
chmod 755 ./protected/yiic

# Create local config file if not exits
test -f ./protected/config/main-local.php || cp ./protected/config/main-local.example.php ./protected/config/main-local.php

touch ./protected/config/params.inc
chmod 777 ./protected/config/params.inc
touch ./protected/data/menu.txt
chmod 777 ./protected/data/menu.txt