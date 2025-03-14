# AWS LAMP Stack Deployment Documentation

## Infrastructure Overview

This documentation outlines the LAMP stack application deployment completed using the AWS Management Console. The deployment follows AWS Well-Architected Framework principles with emphasis on scalability and availability.

## Architecture Diagram

[MAGE](./images/architecture.jpeg)

## 1. Network Configuration Details

I've configured a multi-tier network architecture to provide security and isolation:

- **VPC:** Created with CIDR block 10.0.0.0/16
- **Subnets:** Deployed across 3 Availability Zones:
  - Public subnets (10.0.1.0/24, 10.0.2.0/24, 10.0.3.0/24) for load balancers
  - Private app subnets (10.0.11.0/24, 10.0.12.0/24, 10.0.13.0/24) for web servers
  - Private data subnets (10.0.21.0/24, 10.0.22.0/24, 10.0.23.0/24) for databases
- **Route Tables:**
  - Public route tables with Internet Gateway access
  - Private route tables with NAT Gateway for outbound traffic
- **Internet Gateway:** For public internet access
- **NAT Gateways:** Deployed in each public subnet for private subnet outbound connectivity

## 2. Security Configuration

I've implemented defense-in-depth security measures:

- **Security Groups:**
  - ALB Security Group: Allows HTTP/HTTPS from internet
  - Web Server Security Group: Accepts traffic only from ALB
  - Database Security Group: Accepts MySQL traffic only from web servers
- **Network ACLs:** Configured with allow/deny rules for additional network security
- **IAM Roles:** EC2 instances use IAM roles with minimal permissions needed
- **Encryption:** Data encrypted at rest and in transit

## 3. Application Infrastructure

### Load Balancing

- Application Load Balancer in public subnets
- Health checks configured to monitor `/health.php` with 30-second intervals
- Sticky sessions disabled to ensure proper load distribution
- HTTPS listener with ACM-issued certificate

### Compute Layer

- Auto Scaling Group with:
  - Minimum: 2 instances
  - Desired: 4 instances
  - Maximum: 10 instances
- Scaling policies:
  - Scale out when CPU > 70% for 5 minutes
  - Scale in when CPU < 30% for 10 minutes
- EC2 instances:
  - t3.medium instances for cost-effective performance
  - Latest Amazon Linux 2 AMI
  - Spread across multiple AZs for high availability

### Database Layer

- Amazon RDS for MySQL:
  - Multi-AZ deployment for high availability
  - db.t3.large instance class
  - General Purpose SSD storage with 100GB initial allocation
  - Automated backups with 7-day retention period
  - Read replicas can be added as application scaling demands

## 4. LAMP Stack Installation

### Web Server Configuration

The following installations are performed on each EC2 instance via user data script:

```bash
#!/bin/bash
# Update system packages
yum update -y

# Install Apache web server
yum install -y httpd
systemctl start httpd
systemctl enable httpd

# Install PHP and required extensions
amazon-linux-extras enable php7.4
yum clean metadata
yum install -y php php-mysqlnd php-fpm php-json php-gd

# Install CloudWatch agent
yum install -y amazon-cloudwatch-agent
systemctl start amazon-cloudwatch-agent
systemctl enable amazon-cloudwatch-agent

# Download application code
aws s3 cp s3://lamp-application-source/app/ /var/www/html/ --recursive

# Set proper permissions
chown -R apache:apache /var/www/html/
```

## 6. Monitoring and Logging

I've set up comprehensive monitoring:

- **CloudWatch Dashboards:** Custom dashboard showing key metrics
- **CloudWatch Alarms:**
  - High CPU Utilization (>80% for 5 minutes)
  - Low free memory (<10% for 5 minutes)
  - HTTP 5xx errors (>1% of requests)
  - Database connections (>80% of maximum)
- **CloudWatch Logs:**
  - Apache access and error logs
  - MySQL slow query logs
  - Application error logs
- **Health Checks:** Custom `/health.php` endpoint for deeper application monitoring

## 7. Backup and Recovery Plan

- **Database Backups:**
  - Automated RDS snapshots daily
  - Transaction logs for point-in-time recovery
  - Manual snapshots before major changes
- **Application Backups:**
  - S3 versioning enabled on code bucket
  - Weekly AMI creation of properly configured instances

## 8. Scaling Strategy

The infrastructure can scale in several ways:

- **Horizontal Scaling:** Auto Scaling Group adds/removes EC2 instances based on load
- **Vertical Scaling:** Instance types can be upgraded for more CPU/memory
- **Database Scaling:**
  - Read replicas for read-heavy workloads
  - Vertical scaling by changing instance class
  - Aurora serverless as a future option for variable workloads

## 9. Well-Architected Framework Compliance

The deployment adheres to AWS Well-Architected Framework:

- **Operational Excellence:** Automation, monitoring, and documentation
- **Security:** Defense in depth with least privilege access
- **Reliability:** Multi-AZ deployment with automatic recovery
- **Performance Efficiency:** Right-sized resources with ability to scale
- **Cost Optimization:** Auto Scaling to match capacity with demand

## 10. Next Steps and Recommendations

- Implement AWS WAF for additional security
- Configure Route 53 for DNS management and failover
- Set up CloudFront for content delivery and caching
- Implement CI/CD pipeline with CodePipeline for automated deployments
- Review security posture regularly with AWS Trusted Advisor
