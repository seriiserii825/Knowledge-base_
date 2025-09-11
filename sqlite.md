# sqlite

```sqlite
Command	Description
.help	Show all available dot commands
.databases	List attached databases
.tables	List all tables in the current database
.schema	Show the CREATE statements for tables
.schema table_name	Show schema for a specific table
.mode column	Display query results in aligned columns
.mode list	Display results in `
.headers on	Turn on column headers
.headers off	Turn off column headers
.exit or .quit	Exit the SQLite shell
.dump	Dump the entire database as SQL statements
.dump table_name	Dump only one table
.read file.sql	Execute SQL from a file
.output file.txt	Redirect query output to a file
.show
```

commands

```

sqlite> .mode column
sqlite> .headers on
sqlite> SELECT * FROM users;
id   name    email
--   ----    -----------
1    Alice   alice@mail.com
2    Bob     bob@mail.com

sqlite> .exit
```

delete

```sqlite
sqlite> DELETE FROM users WHERE id = 2;
sqlite> SELECT * FROM users;
```
