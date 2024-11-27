### 1\. **Install MariaDB**

Use `pacman` to install MariaDB:
`sudo pacman -S mariadb`

---

### 2\. **Initialize the Database**

After installation, you must initialize the database directory:
`sudo mariadb-install-db --user=mysql --basedir=/usr --datadir=/var/lib/mysql`

---

### 3\. **Start and Enable the Service**

Start the MariaDB service and enable it to run at boot:
`sudo systemctl start mariadb && sudo systemctl enable mariadb`
Verify that the service is running:
`sudo systemctl status mariadb`

---

### 4\. **Secure the Installation**

Run the `mysql_secure_installation` script to set a root password and remove insecure defaults:
`sudo mysql_secure_installation`
You'll be prompted to:

- Set the root password.
- Remove anonymous users.
- Disallow remote root login.
- Remove the test database.
- Reload privilege tables.

---

### 5\. **Test the Installation**

Log in to the MariaDB server to ensure it works:
`mariadb -u root -p`
If successful, you'll see the MariaDB prompt:
plaintext
`MariaDB [(none)]>`
