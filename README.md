# Bato National High School E-Document Request System

A production-ready web application built with Laravel 12 for managing document requests online, featuring OTP verification, request tracking, and an admin dashboard.

## Features

### Public Features
- **Email OTP Verification** - Secure access with one-time passwords
- **Online Document Request** - Multi-step form with digital signature
- **Request Tracking** - Real-time status updates with activity timeline
- **Email Notifications** - Automatic updates on status changes

### Admin/Registrar Features
- **Dashboard** - Overview of all requests with statistics
- **Request Management** - View, update, and process document requests
- **Bulk Actions** - Update multiple requests simultaneously
- **Audit Logging** - Automatic activity tracking
- **Status Management** - Pending, Processing, Ready, Completed

### Security Features
- **Rate-Limited OTP** - Protection against abuse
- **Session-Based Verification** - Secure request submission
- **Staff-Only Authentication** - Laravel Breeze integration
- **Automatic Audit Trails** - All changes logged

## Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: PostgreSQL (Supabase compatible)
- **Authentication**: Laravel Breeze
- **Email**: SMTP (Gmail App Password compatible)
- **Deployment**: Heroku ready

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- PostgreSQL (or SQLite for local development)

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
   DB_HOST=your-supabase-host
   DB_PORT=5432
   DB_DATABASE=your-database
   DB_USERNAME=your-username
   DB_PASSWORD=your-password
   ```

5. **Configure email** (edit `.env`)
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your-email@gmail.com
   MAIL_FROM_NAME="Bato National High School"
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
3. Verify your email with OTP
4. Fill out the request form
5. Provide digital signature
6. Submit and receive tracking ID
7. Track your request anytime using the tracking ID

### For Registrars/Admins

1. Log in at `/login`
2. View all requests in the dashboard
3. Click on any request to view details
4. Update status, add remarks, set completion dates
5. Use bulk actions to process multiple requests
6. All changes are automatically logged

## Deployment to Heroku

1. **Create Heroku app**
   ```bash
   heroku create your-app-name
   ```

2. **Add PostgreSQL addon**
   ```bash
   heroku addons:create heroku-postgresql:mini
   ```

3. **Set environment variables**
   ```bash
   heroku config:set APP_KEY=$(php artisan key:generate --show)
   heroku config:set APP_ENV=production
   heroku config:set APP_DEBUG=false
   heroku config:set MAIL_MAILER=smtp
   heroku config:set MAIL_HOST=smtp.gmail.com
   heroku config:set MAIL_PORT=587
   heroku config:set MAIL_USERNAME=your-email@gmail.com
   heroku config:set MAIL_PASSWORD=your-app-password
   ```

4. **Deploy**
   ```bash
   git push heroku main
   ```

5. **Run migrations**
   ```bash
   heroku run php artisan migrate --seed
   ```

## Database Schema

- **users** - Admin and registrar accounts
- **documents** - Available document types
- **tracks** - Academic tracks/strands
- **requests** - Document requests with tracking
- **otps** - One-time passwords for verification
- **request_logs** - Audit trail of all changes

## API Routes

### Public Routes
- `GET /` - Homepage
- `GET /otp/request` - OTP request form
- `POST /otp/send` - Send OTP
- `GET /otp/verify` - OTP verification form
- `POST /otp/verify` - Verify OTP
- `GET /request/create` - Request form (OTP protected)
- `POST /request/store` - Submit request
- `GET /tracking/form` - Tracking form (no OTP required)
- `POST /tracking/track` - Track request (requires tracking code + email)

### Admin Routes (Authentication Required)
- `GET /admin/dashboard` - Dashboard
- `GET /admin/requests/{id}` - Request detail
- `POST /admin/requests/{id}/update-status` - Update request
- `POST /admin/requests/bulk-update` - Bulk update
- `DELETE /admin/requests/{id}` - Delete request

## Key Features Explained

### OTP System
- 6-digit numeric codes
- 10-minute expiration
- One-time use
- Rate-limited (3 requests per 10 minutes)
- 5 failed verification attempts before lockout
- Required for document submission only
- **Not required for tracking** - users can track with tracking code + email

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

### Email Notifications
- OTP codes
- Request confirmation
- Status change notifications
- Professional HTML templates

## Configuration

### Rate Limiting
OTP requests are rate-limited to prevent abuse:
- 3 OTP requests per 10 minutes per email
- 5 verification attempts before lockout

### Processing Times
Default processing days by document type:
- Form 137: 5 days
- Diploma: 7 days
- Certificates: 3-4 days

Modify in `database/seeders/DocumentSeeder.php`

## Troubleshooting

### Email Not Sending
- Verify Gmail App Password is correct
- Enable "Less secure app access" (if needed)
- Check SMTP settings in `.env`

### OTP Not Working
- Clear browser cache and cookies
- Check if emails are being sent
- Verify session is working

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
