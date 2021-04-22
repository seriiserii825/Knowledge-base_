#docerfile alpine http-server
FROM alpine

RUN apk add npm && npm i -g http-server

VOLUME /home/server

WORKDIR /home/server

COPY ./ /home/server

EXPOSE 8080

CMD http-server

#buld and run docker
docker build -t serii366/npm:v1 .
docker run -it --name node-dru -p 3000:8080 serii366/npm:v1 


