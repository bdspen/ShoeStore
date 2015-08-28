
# Shoe Store

##### Allows a user to organise shoe stores and brands of shoes that they carry.
#### 2015/08/28

#### By Benjamin Spenard

## Description

This app allows a user to create a list of shoe stores and a list of brands that
the shoe store carries within each store. You can also see the stores that carry
a particular brand.

## Setup

* clone the repository onto your desktop from this link  https://github.com/bdspen/ShoeStore.git
* from the command line cd into the shoes folder on your desktop and run the
command $ composer install
* If you have MAMP or a similar setup, run your servers and go to
localhost:XXXX/phpmyadmin where XXXX is the port of your server
* import the zipped database in the shoes folder
* run your localhost server to view the site.

## Technologies Used

PHP, MYSQL, SILEX, TWIG, PHPUNIT

### Legal


Copyright (c) 2015 Ben Spenard

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

### MYSQL commands to make the database

mysql> CREATE DATABASE shoes
    -> ;
Query OK, 1 row affected (0.00 sec)

mysql> USE shoes
Database changed
mysql> CREATE TABLE stores (names VARCHAR (255));
Query OK, 0 rows affected (0.07 sec)

mysql> CREATE TABLE brands (names VARCHAR (255));
Query OK, 0 rows affected (0.08 sec)

mysql> CREATE TABLE brands_stores (brand_id INT, store_id INT);
Query OK, 0 rows affected (0.10 sec)

mysql> ALTER TABLE stores ADD id serial PRIMARY KEY;
Query OK, 0 rows affected (0.09 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> ALTER TABLE brands ADD id serial PRIMARY KEY;
Query OK, 0 rows affected (0.10 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> ALTER TABLE brands_stores ADD id serial PRIMARY KEY;
Query OK, 0 rows affected (0.08 sec)
Records: 0  Duplicates: 0  Warnings: 0
