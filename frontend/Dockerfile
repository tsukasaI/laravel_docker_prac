FROM node

ENV TZ Asia/Tokyo

WORKDIR /app

COPY package.json yarn.lock ./

RUN yarn install

CMD ["yarn", "dev"]
