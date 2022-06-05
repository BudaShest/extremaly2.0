FROM node:latest
RUN mkdir -p /usr/src/app
WORKDIR /usr/src/app
#ENV PATH /app/node_modules/.bin:$PATH
COPY package*.json /usr/src/app/
RUN npm install
COPY . ./usr/src/app
CMD ["npm", "start"]