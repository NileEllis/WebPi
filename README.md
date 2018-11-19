# WebPi
A web interface for the raspberry pi 3

This project was made with the intention of creating a web-based interface that allows users to control basic system functions and preform maintenance tasks. The goals are acheived using Apache2, PHP7.1, SQLite3, and command line programs that are standard to Raspbian.

To begin it is important to make sure that your operating system is up to date. Start by running sudo apt-get update -y, sudo apt-get upgrade -y, sudo apt-get dist-upgrade, and then reboot for good measure.

First install apache2 with sudo apt-get apache2, install php with sudo apt-get php7.0, and sqlite with sudo apt-get install sqlite3. We will also install a SQLite3 desktop app for maintaining the database so that we don't have to go learning SQL if we don't need to (I do recommend it though, its a very useful skill if you work in that area)  with sudo apt-get install sqlitebrowser.

