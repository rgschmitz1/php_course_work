# ALTER TABLE = Modify existing table
  # example alter
  ALTER TABLE <table_name> ADD <column_name> <column_type>
  ALTER TABLE email_list ADD id INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id)
# NOT NULL = tells MySQL that the value cannot be empty
# AUTO_INCREMENT = automatically adds one (1) to the last column value
# PRIMARY KEY = Tells MySQL that each value is unique
