# links_app

https://d2bs0axkh0sluy.cloudfront.net/

Welcome to my LAMP application, designed to make my life and my girlfriend's communication more organized! The app was created for us, as we often share links with each other but find ourselves losing them in the endless stream of family chats and emails. Also showing the weather in Bielefeld.

## Application Overview

The application is a PHP web app deployed on an Amazon EC2 instance, running the latest Amazon Linux 2023 version. The app includes a user login system, ensuring that only my girlfriend and I have access to our saved links. It is backed by a MariaDB database server, and Amazon Secrets Manager is used to store and retrieve sensitive information such as database credentials and the weather API key.

To ensure optimal performance and security, the app is deployed using a range of AWS services, including:

- Amazon EC2: To launch and manage the web server instance.
- MariaDB: As the database management system.
- Amazon Secrets Manager: To securely store and retrieve sensitive information.
- AWS Backup: To create and manage backups of the EC2 instance.
- CloudFront: To protect and accelerate traffic to the app.
- CloudWatch: To monitor the instance and automatically reboot it when necessary.

## Deployment Process

The app is deployed using an Amazon EC2 instance with a user data script to automate the setup and configuration process. The user data script performs the following tasks:

- Installs necessary packages (AWS CLI, jq, MariaDB, Apache HTTP Server, PHP, and related PHP modules).
- Retrieves sensitive information (database credentials) from Amazon Secrets Manager.
- Sets up Apache HTTP Server and MariaDB, starts and enables their services.
- Configures the ownership and permissions for the /var/www directory.
- Installs Composer, the PHP dependency management tool.
- Sets up a composer.json file and installs required dependencies (AWS SDK for PHP) using Composer.
- Automates the mysql_secure_installation process for the MariaDB server.
- Creates the necessary database and tables.
- Downloads the application files from this GitHub repository.
- Sets the ownership and permissions for the application files.

## Application Files

- user_data_EC2: the script used for launching the instance.
- config.php: Contains the application configuration settings, including database connection information.
- index.php: Serves as the main entry point for the application.
- login.php: Handles user authentication and login functionality.
- main.php: Contains the main application logic.

![sdd drawio](https://user-images.githubusercontent.com/116178693/233837887-534445be-ca51-46e5-9438-b74e86c16686.png)

## Access

The application can be accessed at [https://d2bs0axkh0sluy.cloudfront.net/](https://d2bs0axkh0sluy.cloudfront.net/). Thank you for checking out my app!

to do list:
- remove the db from the script and wget from S3
- rework the user input with prepared statements
- WAF
- DB backup

