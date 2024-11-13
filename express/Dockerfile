FROM node:latest

EXPOSE 3000

WORKDIR /app

RUN npm install -g pnpm

COPY package.json /app
RUN pnpm install
COPY . /app

CMD ["pnpm", "run", "start"]