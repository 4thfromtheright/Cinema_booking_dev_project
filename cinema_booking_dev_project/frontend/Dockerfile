FROM node:18

WORKDIR /app

RUN npm install -g @angular/cli

# Copy package files from frontend-app subdirectory
COPY frontend-app/package.json frontend-app/package-lock.json ./

RUN npm install

# Copy the rest of the Angular app
COPY frontend-app/ ./

EXPOSE 4200

# Set environment variable for file watching in Docker
ENV CHOKIDAR_USEPOLLING=true

# Start Angular dev server
CMD ["ng", "serve", "--host", "0.0.0.0", "--port", "4200", "--poll", "1000", "--disable-host-check"]