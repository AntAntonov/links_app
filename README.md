# links_app

https://d2bs0axkh0sluy.cloudfront.net/

Welcome to my LAMP application, designed to make my life and my girlfriend's communication more organized! The app was created for us, as we often share links with each other but find ourselves losing them in the endless stream of family chats and emails.

With my app, I can easily save and categorize links to various websites, making them easy to access and find whenever I need them. The app includes a user login system, ensuring that only my girlfriend and I have access to our saved links.

Application Overview

The application is a PHP web app deployed on an Amazon EC2 instance. The application is backed by a MariaDB database server.Amazon Secrets Manager is used to store and retrieve sensitive information such as database credentials.

Deployment Process

An Amazon EC2 instance is launched with the user data script to automate the setup and configuration process.
The user data script performs the following tasks:
Installs necessary packages (e.g., AWS CLI, jq, MariaDB, Apache HTTP Server, PHP, and related PHP modules).
Retrieves sensitive information (e.g., database credentials) from Amazon Secrets Manager.
Sets up Apache HTTP Server and MariaDB, starts and enables their services.
Configures the ownership and permissions for the /var/www directory.
Installs Composer, the PHP dependency management tool.
Sets up a composer.json file and installs required dependencies (e.g., AWS SDK for PHP) using Composer.
Automates the mysql_secure_installation process for the MariaDB server.
Creates the necessary database and tables.
Downloads the application files from this GitHub repository.
Sets the ownership and permissions for the application files.

After the deployment process is completed, the PHP web application is running on the Amazon EC2 instance.
Cloudfront distribution is used to protect and accelerate the traffic.

Application Files
config.php: Contains the application configuration settings, including database connection information.
index.php: Serves as the main entry point for the application.
login.php: Handles user authentication and login functionality.
main.php: Contains the main application logic.
