# Use the official Moodle PHP Apache image
FROM moodlehq/moodle-php-apache:7.4@sha256:cb3c985b37ba1b7c3769ae22382ca1beb63c25630f49764e7ea6d4c1849aec7f

# Install required packages
RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Copy Moodle source files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html
    
# Expose the default port
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
