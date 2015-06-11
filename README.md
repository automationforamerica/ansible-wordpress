# Automation for America Wordpress Deployment

## Description

An opinionated Wordpress stack, featuring:

- Master-slave replication from one private administrative system to the servers handling real requests.
- Deployment of Wordpress from a tarball on S3

## Requirements

- Ansible 1.9.1
- boto
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
- `wp_vpc_id`: The VPC ID to launch instances, etc. in
- `wp_network_subnets`: An array of subnet IDs in the VPC that the ELB will be assigned to.
- `wp_network_subnet_group`: Subnet group that RDS instances will be assigned to.
- `internal_dns_hostname_prefix`: Optional -- represents the DNS prefix (e.g. `www-` for machines in the form `www-001`)

### Load Balancer
- `wp_lb_name`: The name of the Internet-facing load balancer
- `wp_lb_connection_draining_timeout`: Connection draining timeout

### Database
- `wp_rds_instance_name`: Name of the RDS instance
- `wp_rds_database_engine`: The engine powering the RDS instance. This should almost certainly be `MySQL`
- `wp_db_size_in_gb`: Size of the database to be provisioned in GB.
- `wp_rds_instance_type`: Instance type to run the RDS server on. Probably something like `m3.medium`.
- `wp_db_name`: Name of the database to provision
- `wp_db_user`: Username to provision
- `wp_db_password`: Password for the provisioned username
- `wp_db_multi_zone`: `Yes` for a multi-AZ deployment. `No` otherwise.
- `wp_db_backup_retention`: Number of days to retain automatic backups
- `wp_db_publicaly_accessible`: `Yes` to make the database publically addressable on the Internet, `No` otherwise.
- `wp_db_automatically_upgrade`: `Yes` to allow minor version upgrades on the RDS instance at any point, `No` otherwise.

### Route 53
- `fqdn_zone`: Hosted zone to register the ELB under.
- `fqdn`: `fqdn_zone`, but with a leading `.`.
- `wp_dns`: Subdomain of the FQDN to point to the ELB.

### Wordpress Configuration
- `wp_pre_config_filename`: File to be included at the beginning of `wp-config.php`. Defaults to `False`.
- `wp_post_config_filename`: File to be included at the end of `wp-config.php`, right before requiring `wp-settings.php`. Defaults to `False`.

## Required per-host variables

- `replicator`: Whether the current machine is a Wordpress admin instance.

## Getting Started

Spin up instances in EC2. The admin replicator should have a tag of Role=WordpressAdmin, and other machines should be tagged with Role=Wordpress. All machines must be named.
