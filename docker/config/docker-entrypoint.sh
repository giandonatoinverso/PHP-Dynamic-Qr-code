#!/bin/bash
set -o errexit -o nounset

APP_PATH=/var/www/html

echo "##### coping config file #####"
cp $APP_PATH/install/config/database.php $APP_PATH/config/config.php

echo "##### setting database hostname #####"
sed -i "s/%HOSTNAME%/$DATABASE_HOST/" $APP_PATH/config/config.php

echo "##### setting database username #####"
sed -i "s/%USERNAME%/$DATABASE_USER/" $APP_PATH/config/config.php

echo "##### setting database password #####"
sed -i "s/%PASSWORD%/$DATABASE_PASSWORD/" $APP_PATH/config/config.php

echo "##### setting database name #####"
sed -i "s/%DATABASE%/$DATABASE_NAME/" $APP_PATH/config/config.php

echo "#### Deleting install folder #####"
rm -r $APP_PATH/install

exec apache2-foreground