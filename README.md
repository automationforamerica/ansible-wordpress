# Automation for America Wordpress Deployment

## Description

An opinionated Wordpress stack, featuring:

- Master-slave replication from one private administrative system to the servers handling real requests.
- Deployment of Wordpress from a tarball on S3

## Requirements

- Ansible 1.9.1
- ansible-role-mysql
- ansible-role-nginx
- php-fpm

## Required Variables

- `reverse_proxy_port`: The port on which `nginx` should listen. Varnish will proxy requests through to this port.
- `wp_deployment_bucket`: The S3 bucket which hosts the deployment tarball
- `wp_deployment_file_key`: The key for the S3 object in `wp_deployment_bucket` to deploy. You probably want to call this `latest.tar.gz` or something similar.
- `wp_deployment_directory_root`: Root directory to deploy into. For example, to deploy Wordpress files into `/var/www/wordpress/current/`, this should be `/var/www/wordpress`
- `wp_deployment_current_directory`: In the aforementioned example, this should be `/current`.
- `replication_username`: Username to use for replication between hosts.

### Wordpress Security

- `auth_key`
- `secure_auth_key`
- `logged_in_key`
- `nonce_key`
- `auth_salt`
- `secure_auth_salt`
- `logged_in_salt`
- `nonce_salt`

### VPC
- `internal_network_cidr`: The CIDR denoting your internal network (those that can access `/wp-admin`)
- `internal_dns_hostname_prefix`: Optional -- represents the DNS prefix (e.g. `www-` for machines in the form `www-001`)

### Database
- `wp_db_host`: TODO
- `wp_db_name`: Name of the database to provision
- `wp_db_user`: Username to provision
- `wp_db_password`: Password for the provisioned username

### Wordpress Configuration
- `wp_pre_config_filename`: File to be included at the beginning of `wp-config.php`. Defaults to `False`.
- `wp_post_config_filename`: File to be included at the end of `wp-config.php`, right before requiring `wp-settings.php`. Defaults to `False`.

## Required per-host variables

- `replicator`: Whether the current machine is a Wordpress admin instance.

## Getting Started

Spin up instances in EC2. The admin replicator should have a tag of Role=WordpressAdmin, and other machines should be tagged with Role=Wordpress. All machines must be named.
