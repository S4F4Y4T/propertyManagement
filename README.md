# Property Management - Setup

## Prerequisites
- Docker & Docker Compose installed

## Quick Setup

```bash
    git clone https://github.com/S4F4Y4T/propertyManagement.git
    cd propertyManagement
    cp .env.example .env
    docker compose build && docker compose up -d
    docker compose exec -it backend bash
    composer install
    php artisan migrate --seed
```

Set mail config from mail trap

## API Testing
Import the Postman collection and set environment variable

# Functional Requirements

## Admin

* Authentication
* Dashboard
* Manage House Owners
* Manage Tenants

## Owner (House Owner)

* Authentication
* Dashboard
* View tenants
* Manage Flats
* Manage Bill Categories
* Manage Bills

---

# API Collections

## Admin APIs

### Auth

* `POST /api/v1/admin/login`
* `POST /api/v1/admin/logout`
* `GET /api/v1/admin/profile`

### Dashboard

* `GET /api/v1/admin/dashboard`

### House Owner Management

* `POST /api/v1/admin/house-owners` (create)
* `GET /api/v1/admin/house-owners` (list)
* `PUT /api/v1/admin/house-owners/{id}` (update)
* `DELETE /api/v1/admin/house-owners/{id}` (delete)

### Tenant Management

* `POST /api/v1/admin/tenants`
* `GET /api/v1/admin/tenants`
* `PUT /api/v1/admin/tenants/{id}`
* `POST /api/v1/admin/tenants/{id}/assign` (assign tenant to building/flat)

---

## House Owner APIs

### Auth

* `POST /api/v1/owner/login`
* `POST /api/v1/owner/logout`
* `GET /api/v1/owner/profile`

### Dashboard

* `GET /api/v1/owner/dashboard`

### Flat Management

* `POST /api/v1/owner/flats`
* `GET /api/v1/owner/flats`
* `PUT /api/v1/owner/flats/{id}`
* `DELETE /api/v1/owner/flats/{id}`

### Bill Category Management

* `POST /api/v1/owner/bill-categories`
* `GET /api/v1/owner/bill-categories`
* `PUT /api/v1/owner/bill-categories/{id}`
* `DELETE /api/v1/owner/bill-categories/{id}`

### Bill Management

* `POST /api/v1/owner/flats/{flat}/bills`
* `GET /api/v1/owner/bills`
* `Patch /api/v1/owner/bills/{id}/pay`
* `DELETE /api/v1/owner/bills/{id}`

---

?sort=-id&filter[name]=someone&includes=flat,bills

- This is the query parameter format to sort, filter and load relational data into api, the allowed options are on app/Filters dir

# Constraints

* When **bill is created** → send notification to:

  * Tenant (new bill available)

* When **bill is paid** → send notification to:

  * Tenant (confirmation of payment)

---

# Project Steps & Time Estimates

1.  Laravel Project Setup with authentication and structure, Error Handling, Email Configure, Dockerize – 120m
2.  Model Creation & Relations Definition, Migration – 40m
3.  Create Routes & Postman Collections – 40m
4.  Make Resources & Response Format, Middleware, Authorization – 40m
5.  Controllers & Business Logic, Validation Rules, Filter, Sort, Eager Loading Structure – 210m
6.  Finishing, Testing, Debugging – 60m
9.  Documentation, Deployment & Git – 90m
10. Debuggin + Buffer Time = 120m

Estimated Time = 12 hours 0 minutes

7.  Frontend Setup & Page Design – 180m
8.  API Integration – 60m

Backend:-
**Work Log:** Oct 3 – 1:30 AM - 4:30 AM - setup(error, response, structure), model, auth(postman)
**Work Log:** Oct 3 – 09:10 AM - 12:30 AM - migration resource response, postman, route, controller setup
**Work Log:** Oct 3 – 01:30 PM - 3:30 PM - filter, sort, eager load structure, validation rules, controller and service, manual testing, documentation
**Work Log:** Oct 4 – 12:00 PM - 05:00 PM -controller, service, filter, validation for sass rules, manual testing, debugging
**Work Log:** Oct 4 – 07:15 PM - 11:00 PM - documentation, git, docker, deploy, mail, observer, debugging

Frontend:-
**Work Log:** Oct 5 – 02:30 AM - 03:40 AM - setup, auth
**Work Log:** Oct 5 – 10:00 PM - 11:10 PM - house owner crud
**Work Log:** Oct 6 – 06:10 AM - 09:30 PM - tenant crud, admin dashboard
**Work Log:** Oct 6 – 01:40 PM - 02:00 PM - owner dashboard, tenant update issue fix
**Work Log:** Oct 7 – 01:30 AM - 2:30 AM - flat, update structure
**Work Log:** Oct 7 – 06:50 AM - 8:00 AM - Bill category, tenant list for owner, validation error handling
**Work Log:** Oct 8 – 07:16 AM -  AM - Bill, pay, git, deployment

**Total logged time = 16h 5m**

Design Decisions:
 - Used JWT for Authentication bcz its stateless
 - Using Service Pattern only for complex logics and for clean code bcz any other pattern like repository would be overkill here
 - Used Filter pattern to separate logic for sorting, eager loading, filtering so controller can be clean
 - Used global scope with traits to manage saas data isolation
 - Used observer for mail sending
 - Used middleware for authorization
 - Separated admin and owners by user type column in db to manage authentication easily based on the project size
 - Dockerized for easy setup and deployment
 
 - Using My Previous project's frontend structure which i built from scratch bcz of time complexity
 - I know ai is completely prohibited but still had to use ai to reformat the documentation and for some debugging because the deadline was very tight


