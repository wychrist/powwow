FROM ubuntu:latest

ARG GROUPID
ARG USERID
ARG GROUP_NAME
ARG USER_NAME

USER root

RUN groupadd -g ${GROUPID} ${GROUP_NAME} && \
    useradd -u ${USERID} -g ${GROUPID} -m ${USER_NAME}

RUN apt-get update &&  apt-get -y install vim redis-tools
RUN apt-get -y install mysql-client mongo-tools

WORKDIR /projects

USER ${USERID}
