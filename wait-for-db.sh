cat > wait-for-db.sh << 'EOF'
#!/bin/bash
echo "Waiting for MySQL to be ready..."
until php -r "
\$host = getenv('DB_HOST');
\$port = getenv('DB_PORT');
\$db   = getenv('DB_DATABASE');
\$user = getenv('DB_USERNAME');
\$pass = getenv('DB_PASSWORD');
try {
    \$pdo = new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass);
    echo 'MySQL is up!\n';
    exit(0);
} catch (Exception \$e) {
    exit(1);
}
" 2>/dev/null; do
  echo "MySQL not ready... retrying in 3 seconds"
  sleep 3
done
EOF