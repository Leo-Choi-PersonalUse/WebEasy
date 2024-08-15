FROM node:21.6.2
WORKDIR /app
#COPY /vueServer /app

COPY ./vueServer/package.json /app
COPY ./vueServer/package-lock.json /app

RUN apt-get update \
    && npm install \
    && npm install pm2 -g \
    && apt-get install iputils-ping -y

#CMD tail -f /dev/null
#CMD ["pm2-runtime", "start", "ecosystem.config.cjs"]
EXPOSE 3100

CMD ["sh", "-c", "npm i && pm2-runtime start ecosystem.config.cjs --env development"]

