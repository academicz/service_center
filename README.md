# service_center
#### Multi branch service center management system(academic project) in laravel 

### Users
1. Admin
2. Branch
3. User

### Workflow 
#### Admin
Admin dashboard available at /e2care

1. Admin can add shop types
2. Can verify and approve,reject and suspend shop registrations
3. Can see service overview of shops
#### Shop
Shop dashboard available at /shop

1. Shop can see service requests
2. Take decided actions on the request such as
    1. Acept/reject request
    2. Povide pickup details (if accepted)
    3. Mark pickup
    4. Update work status
    5. Generate bill
    6. Povide return details
3. View customer details and service history
4. Add stock items
5. View all bills and payment status
6. View service reports
#### User
1. User can register
2. Can request for service from a selected shop for by giving product information
3. Can track progress of service request
4. Can make online payment
5. Can view service history
### Installation
1. Install project dependencies using 

    `composer install`

2. Rename .env.example to .env and update enviornment variables.
3. Migrate database

    `php artisan migrate`
  
4. Seed initial data

    `php artisan db:seed
    
5. Run dev server
    
    `php artisan serve`
    
  
