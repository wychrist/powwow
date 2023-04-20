FROM node:lts


ADD setup.sh /setup.sh
RUN chmod +x /setup.sh
RUN npm instal -g @quasar/cli

CMD ["/setup.sh"]

USER node
