#!/bin/sh
php bin/console fos:user:create admin
php bin/console fos:user:promote admin ROLE_ADMIN