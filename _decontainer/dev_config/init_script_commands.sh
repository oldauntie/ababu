#!/bin/bash

# Display a message with emoji indicating the configuration is starting
echo "🚀 Starting configuration..."

# Change permissions of the current directory
sudo chmod a+x "$(pwd)"

# Remove the /var/www/html directory
sudo rm -rf /var/www/html

# Create a symbolic link of the current directory to /var/www/html
sudo ln -s "$(pwd)" /var/www/html

# Run composer install
composer install

echo "🌟 Current directory: $(pwd) "

# Change permissions of the install_oh_my_zsh.sh script
 sudo chmod a+x .devcontainer/dev_config/install_oh_my_zsh.sh

# Run the install_oh_my_zsh.sh script
.devcontainer/dev_config/install_oh_my_zsh.sh

# Change permissions of the directory_validator.sh script
## sudo chmod a+x .devcontainer/dev_config/directory_validator.sh

# Run the directory_validator.sh script
## .devcontainer/dev_config/directory_validator.sh

# Change permissions of the db_init_buglianopisa.sh script
## sudo chmod a+x .devcontainer/dev_config/db_init_buglianopisa.sh

# Run the db_init_buglianopisa.sh script
## .devcontainer/dev_config/db_init_buglianopisa.sh

# Change permissions of the db_init_pmremote.sh script
## sudo chmod a+x .devcontainer/dev_config/db_init_pmremote.sh

# Run the db_init_pmremote.sh script
## .devcontainer/dev_config/db_init_pmremote.sh

# Change permissions of the db_init_testfunzionamento.sh script
## sudo chmod a+x .devcontainer/dev_config/db_init_testfunzionamento.sh

# Run the db_init_testfunzionamento.sh script
## .devcontainer/dev_config/db_init_testfunzionamento.sh

# Change permissions of the service_apache_start.sh script
chmod +x .devcontainer/dev_config/service_apache_start.sh

# Run the service_apache_start.sh script
.devcontainer/dev_config/service_apache_start.sh
