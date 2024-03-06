FROM node:21.6.2
WORKDIR /app
COPY /vueServer /app
RUN npm install \
    && npm install pm2 -g 

#CMD tail -f /dev/null
#CMD ["pm2-runtime", "start", "ecosystem.config.cjs"]
EXPOSE 3100
CMD ["pm2-runtime", "start", "ecosystem.config.cjs", "--env", "development"]

