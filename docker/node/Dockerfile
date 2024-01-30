FROM node:alpine

RUN apk update && apk add bash

RUN npm install -y -g npm@latest\
    create-react-app \
    create-react-native-app\
    react-native-cli\
    @reduxjs/toolkit\ 
    react-redux\
    create-vite@latest\
    @vue/cli@next\
    @wordpress/create-block@4.25.0
RUN mkdir /app
WORKDIR /app

ARG EXPOSE_PORT ENV_EXPOSE_PORT
EXPOSE $EXPOSE_PORT

COPY scripts/start-server.sh /opt/src/scripts/start-server.sh
# Muss nix kopiert werden
# CMD /opt/src/scripts/start-server.sh
CMD ["sh", "-c", "/opt/src/scripts/start-server.sh ${ENV_EXPOSE_PORT}"]
