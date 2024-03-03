FROM php:8.3.3

# Set the working directory
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install PHP extensions
RUN apt-get update 
# Make port 80 available to the world outside this container

EXPOSE 8000

CMD tail -f /dev/null

