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

## Credentials

URL:- http://142.171.47.138:6001

Admin:
  admin@example.com
  password

Owner:
  rizwan@gmail.com
  password

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

## Project Steps & Time Estimates

### Backend
| Task | Estimated Time |
|------|----------------|
| Setup, authentication, error handling, Docker | 2h |
| Models & migrations | 40m |
| Routes & Postman collections | 40m |
| Resources, middleware, authorization | 40m |
| Controllers, validation, filter/sort/eager loading | 3.5h |
| Finishing, testing | 1h |
| Documentation, deployment, Git | 1.5h |
| Debugging & buffer | 2h |

**Total Estimated:** 12h  
**Logged Time:** 16h 5m

### Frontend
| Task | Estimated Time |
|------|----------------|
| Setup & page design | 4h |
| API integration | 1h |
| Buffer | 2h |

**Total Estimated:** 7h  
**Logged Time:** 8h 34m

---

## Work Logs

### Backend
- **Oct 3** – 1:30 AM - 4:30 AM: Setup, models, auth, Postman  
- **Oct 3** – 9:10 AM - 12:30 PM: Migration, resource response, routes, controllers  
- **Oct 3** – 1:30 PM - 3:30 PM: Filter, sort, eager loading, validation, services  
- **Oct 4** – 12:00 PM - 5:00 PM: Controller, services, validation, testing, debugging  
- **Oct 4** – 7:15 PM - 10:00 PM: Documentation, git, Docker, deploy, mail, observer, debugging  

### Frontend
- **Oct 5** – 2:30 AM - 3:40 AM: Setup, auth  
- **Oct 5** – 10:00 PM - 11:10 PM: House owner CRUD  
- **Oct 6** – 6:10 AM - 8:30 AM: Tenant CRUD, admin dashboard  
- **Oct 6** – 1:40 PM - 2:00 PM: Owner dashboard, tenant update fix  
- **Oct 7** – 1:30 AM - 2:30 AM: Flats update  
- **Oct 7** – 6:50 AM - 8:00 AM: Bill category, tenant list, validation error handling  
- **Oct 8** – 7:16 AM - 8:40 AM: Bill, pay, git  
- **Oct 8** – 9:00 AM - 10:00 AM: Deployment, documentation, hotfix, full flow test


Design Decisions:
 - Used JWT for Authentication bcz its stateless
 - Using Service Pattern only for complex logics and for clean code bcz any other pattern like repository would be overkill here
 - Used Filter pattern to separate logic for sorting, eager loading, filtering so controller can be clean
 - Used global scope with traits to manage saas data isolation
 - Dockerized for easy setup and deployment
 
 - Using My Previous project's frontend structure which i built from scratch bcz of time complexity
 - I know ai is completely prohibited but still had to use ai to reformat the documentation and for few debugging


