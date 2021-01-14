#!/bin/sh 
#php -f yii migrate --interactive=0 --migrationPath=@backend/migrations
echo "Applying database migrations..."
php -f yii migrate --interactive=0 --migrationPath=@yii/rbac/migrations
find ./* -name migrations | grep -v vendor | sed s/./"php yii migrate --interactive=0 --migrationPath=@"/ | xargs -L 1 xargs -t
find ./* -name mongodb | grep -v vendor | sed s/./"php yii mongodb-migrate --interactive=0 --migrationPath=@"/ | xargs -L 1 xargs -t
echo "Database migrations complete!!!"
