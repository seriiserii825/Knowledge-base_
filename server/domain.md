server {
listen 80;
server_name example.com _.example.com;
root /var/www/example.com/$subdomain;
    set $subdomain "";
    if ($host ~_ ^([a-z0-9-\.]+)\.example.com$) {
        set $subdomain $1;
    }
    if ($host ~\* ^www.example.com$) {
set $subdomain "";
}
}
