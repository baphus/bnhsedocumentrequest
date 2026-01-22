
# Bato National High School E-Document Request System

A production-ready web application built with Laravel 12 for managing document requests online, featuring request tracking and an admin dashboard. Now deployed on Render with Neon as the database. Email notifications are no longer used.


## Features

### Public Features
- **Online Document Request** - Multi-step form with digital signature
- **Request Tracking** - Real-time status updates with activity timeline

### Admin/Registrar Features
- **Dashboard** - Overview of all requests with statistics
- **Request Management** - View, update, and process document requests
- **Bulk Actions** - Update multiple requests simultaneously
- **Audit Logging** - Automatic activity tracking
- **Status Management** - Pending, Processing, Ready, Completed

### Security Features
- **Staff-Only Authentication** - Laravel Breeze integration
- **Automatic Audit Trails** - All changes logged


## Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: PostgreSQL (Neon)
- **Authentication**: Laravel Breeze
- **Deployment**: Render

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- PostgreSQL (Neon recommended, or SQLite for local development)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd bnhs-edocumentrequest
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```


4. **Configure database** (edit `.env`)
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=your-neon-host
   DB_PORT=5432
   DB_DATABASE=your-database
   DB_USERNAME=your-username
   DB_PASSWORD=your-password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start development server**
   ```bash
   php artisan serve
   ```

   Visit: http://localhost:8000

## Default Credentials

After seeding, you can log in with:

**Admin Account:**
- Email: `admin@bnhs.edu.ph`
- Password: `password`

**Registrar Account:**
- Email: `registrar@bnhs.edu.ph`
- Password: `password`

⚠️ **Change these passwords immediately in production!**

## Available Documents

The system comes pre-seeded with:
- Form 137 (SF10)
- Diploma
- Certificate of Enrollment
- Good Moral Certificate
- Certificate of Grades
- Transcript of Records

## Available Tracks/Strands

- STEM - Science, Technology, Engineering and Mathematics
- HUMSS - Humanities and Social Sciences
- GAS - General Academic Strand
- ABM - Accountancy, Business and Management
- TVL-ICT - Technical-Vocational-Livelihood (ICT)
- TVL-HE - Technical-Vocational-Livelihood (Home Economics)

## Usage

### For Students/Alumni

1. Visit the homepage
2. Click "Request a Document"
3. Fill out the request form
4. Provide digital signature
5. Submit and **take a screenshot of your tracking ID**
6. Track your request anytime using the tracking ID

### For Registrars/Admins

1. Log in at `/login`
2. View all requests in the dashboard
3. Click on any request to view details
4. Update status, add remarks, set completion dates
5. Use bulk actions to process multiple requests
6. All changes are automatically logged


## Deployment to Render

1. **Create a Render account and new Web Service**
   - Connect your GitHub repository to Render.
   - Set the build and start commands:
     - Build Command: `composer install && npm install && npm run build && php artisan migrate --seed --force`
     - Start Command: `php artisan serve --host 0.0.0.0 --port 10000`

2. **Set environment variables**
   - Add your `.env` variables in the Render dashboard, including your Neon database credentials.

3. **Deploy**
   - Render will automatically build and deploy your app on every push to your main branch.

## Database Schema

- **users** - Admin and registrar accounts
- **documents** - Available document types
- **tracks** - Academic tracks/strands
- **requests** - Document requests with tracking
- **request_logs** - Audit trail of all changes

## API Routes

### Public Routes
- `GET /` - Homepage
- `GET /request/create` - Request form
- `POST /request/store` - Submit request
- `GET /tracking/form` - Tracking form
- `POST /tracking/track` - Track request (requires tracking code)

### Admin Routes (Authentication Required)
- `GET /admin/dashboard` - Dashboard
- `GET /admin/requests/{id}` - Request detail
- `POST /admin/requests/{id}/update-status` - Update request
- `POST /admin/requests/bulk-update` - Bulk update
- `DELETE /admin/requests/{id}` - Delete request

## Key Features Explained

### Tracking ID Format
- Format: `DOC-XXXXXX`
- 6 alphanumeric characters
- Unique across all requests
- Auto-generated on submission

### Digital Signature
- Canvas-based signature capture
- Stored as Base64 in database
- No filesystem dependencies (Heroku compatible)

### Automatic Audit Logging
- Tracks all status changes
- Records admin remarks updates
- Logs processor assignments
- Timestamps all actions
- Links actions to users


## Configuration

### Processing Times
Default processing days by document type:
- Form 137: 5 days
- Diploma: 7 days
- Certificates: 3-4 days

Modify in `database/seeders/DocumentSeeder.php`

## Troubleshooting

### Database Errors
- Run `php artisan migrate:fresh --seed`
- Check database credentials in `.env`
- Ensure PostgreSQL is running

## Security Notes

- Never commit `.env` file
- Change default passwords immediately
- Use strong passwords in production
- Enable HTTPS in production
- Regularly backup database
- Monitor audit logs

## Contributing

This is a school project. For modifications:
1. Test thoroughly before deploying
2. Update migrations if changing schema
3. Keep seeders up to date
4. Document any new features

## License

This project is developed for Bato National High School.

## Support

For issues or questions, contact the school IT administrator.

---

**Developed for Bato National High School**
*E-Document Request System v1.0*
