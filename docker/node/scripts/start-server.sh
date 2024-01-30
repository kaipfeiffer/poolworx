#!/bin/sh
if [ -f ./package.json ]
then
  echo $1
  npm run dev -- --host --port $1
else
    npm create vite@latest . -- --template vue && npm install && npm run dev -- --host
fi