# recs

Recommender Systems 2018 - Course Recommender

Running the program with XAMPP Apache:
1. Download and install XAMPP (https://www.apachefriends.org/index.html)
2. When installed, open XAMPP Control Panel, and start Apache Server and MySQL
3. Open Shell, and type "mysql -u root -p", then just press enter for password. Create database test with sql-command "CREATE DATABASE test". Go to database with command "use test".
4. Create database tables to your local database using create-querys from createtables.sql. You can do it manually by copy-pasteing.
5. In Control Panel, set max_execution_time in file php.ini from default 30 to 300. This is done by choosing Config-button from the same row where is the text Apache, and choosing the file php.ini
6. Open the browser and type localhost:[The gate, that Apache server shows in Control Panel]
