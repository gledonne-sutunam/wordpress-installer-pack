#!/bin/bash

# show help
function display_help() {
    echo "1. Load a XML config file (ssh credentials, mysql credentials, URLs search and replace)
             if we have not config file, we will create it.
             - Database name: (E.g. estimermonauto.dev.sutunam.local)
             - Database user: (E.g. root)
             - Database password: (Ex: root)

          2. Import a dump of the database from remote
          3. Replace all URLs in the database (URL search => URL replace)
             -  Enter local domain: (E.g. estimermonauto.dev.sutunam.local)
          4. Import media (images)"
}

# Get informations from config file
function get_param() {
    key=$1
    file=$2

    cat $file | grep $key | grep -oP ", '\K[^']*"
}

function create_config_file() {

    rsync -v $ssh:public_html/wp-config.php ./
    read -p "Enter local database name: " local_db_name
    read -p "Enter local database user: " local_db_user
    read -s -p "Enter local database password: " local_db_password
    echo

    sed -i "/DB_NAME/s/'[^']*'/'$local_db_name'/2" wp-config.php
    sed -i "/DB_USER/s/'[^']*'/'$local_db_user'/2" wp-config.php
    sed -i "/DB_PASSWORD/s/'[^']*'/'$local_db_password'/2" wp-config.php
    read -p "Is it a multisite ? (Y/n)" is_multisite
}

function is_multisite() {
    is_multisite=$( cat wp-config.php | grep MULTISITE | cut -d ',' -f 2 | sed 's/[^[:alnum:]\t]//g')

    if [ "true" == is_multisite ]
    then
        return 1
    else
        return 0
    fi
}

function base_domain() {

    base_domain_file=.sutunam/base_domain

    if [ ! -f $base_domain_file ]; then
        read -p "Enter base_domain: " base_domain
        echo $base_domain > $base_domain_file
    fi

    cat $base_domain_file
}

while [ "$1" != "" ]; do
    case $1 in
	--ssh )
	    shift
	    ssh=$1
	    ;;
	--ssh-database )
	    shift
	    ssh_database=$1
	    ;;
	--ssh-database-user )
	    shift
	    ssh_database_user=$1
	    ;;
	--help )
	    display_help
	    exit 0
	    ;;
    esac
    shift
done

# If no config file
# create it
# ask user information and put it in the file (sed)
# endif

if [ ! -r wp-config.php ]
then
    create_config_file
fi

db_name=$(get_param DB_NAME wp-config.php)
db_user=$(get_param DB_USER wp-config.php)
db_password=$(get_param DB_PASSWORD wp-config.php)

# create database if not exist in local
mysql -u$db_user -p$db_password -e "CREATE DATABASE IF NOT EXISTS \`$db_name\`;"

# import BD and  replace domain
base_domain=$(base_domain)

ssh $ssh mysqldump $ssh_database | mysql -u$db_user -p$db_password  $db_name
php .sutunam/replace.php $base_domain

echo "Done"
if [ $(is_multisite) ]
then
    echo -e "Don't forget to replace values in \e[33mwp_site\e[0m and \e[33mwp_blogs\e[0m tables"
fi
