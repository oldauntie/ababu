#!/bin/bash

echo "🚀 The service apache2 is starting..."

while true; do
    service apache2 start
    sleep 1

    # Check if Apache has started correctly
    if service apache2 status | grep -q "running"; then
        echo "😄 Apache started successfully!"
        break
    else
        echo "⚠️ Apache failed to start. Retrying..."
    fi
done

echo "🌐 Now you can access the plservices1 application by typing in the browser: localhost:8080/index1.php"
echo "🗄️  Now you can access the Adminer database manager by typing in the browser: localhost:8081"
