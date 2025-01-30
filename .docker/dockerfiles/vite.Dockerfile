FROM node:18.13.0-alpine
RUN chmod  -R 777 node_modules
CMD ["npm", "run", "dev"]
