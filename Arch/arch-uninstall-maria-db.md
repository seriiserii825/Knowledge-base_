### 1\. **Stop MariaDB Service**

Ensure MariaDB is not running before removing it:
`sudo systemctl stop mariadb && sudo systemctl disable mariadb`

---

### 2\. **Uninstall MariaDB and Dependencies**

Remove MariaDB and any unused dependencies:
`sudo pacman -Rns mariadb`
The `-Rns` flags ensure that MariaDB, its dependencies, and configuration files are removed.

---

### 3\. **Delete Data and Configuration Files**

Manually delete the remaining MariaDB directories (data, logs, etc.):

- **Data Directory**:
  `sudo rm -rf /var/lib/mysql`
- **Configuration Files**:
  `sudo rm -rf /etc/mysql /etc/my.cnf /etc/my.cnf.d`
- **Socket and Runtime Files**:
  `sudo rm -rf /run/mysqld`
- **Logs (if applicable)**:
  `sudo rm -rf /var/log/mysql`

---

### 4\. **Clean Package Cache (Optional)**

To remove cached installation files:
`sudo pacman -Sc`
Or, if you want to remove **all** cached packages:
`sudo pacman -Scc`

---

### 5\. **Verify Removal**

Check if any MariaDB-related files or processes remain:
`sudo find / -name "*mariadb*" -o -name "*mysql*" sudo ps aux | grep -i mysql`
