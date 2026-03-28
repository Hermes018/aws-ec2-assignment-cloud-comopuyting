# PHP + MySQL auth demo (EC2 deploy)

## Deploy from Git on Amazon Linux / Ubuntu (EC2)

1. Install Apache, PHP, and MySQL client libraries (example `Amazon Linux 2023`):

   ```bash
   sudo dnf update -y
   sudo dnf install -y httpd php php-pdo php-mysqlnd git
   sudo systemctl enable --now httpd
   ```

2. Clone this repo into the web root (files must sit where Apache serves them):

   ```bash
   cd /var/www/html
   sudo git clone https://github.com/YOUR_USER/YOUR_REPO.git auth-system
   sudo chown -R apache:apache /var/www/html/auth-system
   ```

3. Create the database and import the schema (on RDS or local MySQL):

   ```bash
   mysql -h YOUR_RDS_HOST -u admin -p < /var/www/html/auth-system/database.sql
   ```

4. Point the app at your database — set environment variables for Apache, e.g. edit `/etc/httpd/conf.d/auth-system.conf` or your vhost:

   ```apache
   SetEnv DB_HOST "your-rds-endpoint.region.rds.amazonaws.com"
   SetEnv DB_NAME "auth_system"
   SetEnv DB_USER "admin"
   SetEnv DB_PASSWORD "your-password"
   ```

   Then `sudo systemctl reload httpd`.

5. Open in a browser: `http://YOUR_EC2_PUBLIC_IP/auth-system/landing.php`

## Local Git (first push)

If Git is not installed: [Git for Windows](https://git-scm.com/download/win).

```bash
cd auth-system
git init
git add .
git commit -m "Initial commit: PHP MySQL registration demo"
git branch -M main
git remote add origin https://github.com/YOUR_USER/YOUR_REPO.git
git push -u origin main
```

On EC2, use `git pull` inside `/var/www/html/auth-system` to update after you push.
