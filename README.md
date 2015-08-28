mysql> CREATE DATABASE shoes
    -> ;
Query OK, 1 row affected (0.00 sec)

mysql> USE shoes
Database changed
mysql> CREATE TABLE stores (name VARCHAR (255));
Query OK, 0 rows affected (0.07 sec)

mysql> CREATE TABLE brands (name VARCHAR (255));
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