#!/bin/sh
docker exec -it wp-counter-node-1 npm run build
cd src/wp-content/plugins/
zip -vr kpm-counter.zip kpm-counter/ -x "*.DS_Store" ".gitignore" "kpm-counter/backup/*" -x "kpm-counter/js-src/*" "kpm-counter/.git/*" "*.[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9].php"
mv kpm-counter.zip ../../../kpm-counter.zip 
