# User Signup Feature

## Overview
A new user signup functionality has been added to the Stock Management System, allowing users to create accounts themselves without requiring admin intervention.

## Features Added

### 1. Signup Page (`admin/signup.php`)
- **Location**: `admin/signup.php`
- **Features**:
  - Modern, impressive design with gradient backgrounds
  - Glassmorphism card design with backdrop blur
  - Floating animated shapes in background
  - Real-time form validation with smooth animations
  - Password confirmation
  - Password visibility toggle (eye icon)
  - Responsive design for all devices
  - Loading states and success animations
  - Link back to login page

### 2. Backend Signup Logic (`classes/Users.php`)
- **New Method**: `signup_user()`
- **Features**:
  - Username uniqueness validation
  - Password hashing (MD5)
  - Automatic user type assignment (Staff = 2)
  - Database error handling

### 3. Login Page Enhancement (`admin/login.php`)
- **Added**: "Create Account" link with modern design
- **Location**: Bottom left of login form
- **Features**: 
  - Matching modern design with signup page
  - Password visibility toggle (eye icon)

## Required Fields for User Registration

Based on the database structure, the following fields are required:

| Field | Type | Required | Validation |
|-------|------|----------|------------|
| `firstname` | varchar(250) | Yes | Letters only, max 50 chars |
| `lastname` | varchar(250) | Yes | Letters only, max 50 chars |
| `username` | text | Yes | Alphanumeric + underscore, 3-20 chars |
| `password` | text | Yes | Minimum 3 characters |
| `type` | tinyint(1) | Auto | Set to 2 (Staff) for self-registered users |

## Validation Rules

### Frontend Validation (JavaScript)
- **First Name**: Letters only, max 50 characters
- **Last Name**: Letters only, max 50 characters  
- **Username**: Alphanumeric + underscore, 3-20 characters
- **Password**: Minimum 3 characters (any characters allowed)
- **Confirm Password**: Must match password

### Backend Validation (PHP)
- Username uniqueness check
- Required field validation
- Database error handling

## User Types
- **Type 1**: Administrator (created by admin only)
- **Type 2**: Staff (default for self-registered users)

## Security Features
- Password hashing using MD5 (consistent with existing system)
- Username uniqueness validation
- Form validation on both client and server side
- Protection against duplicate registrations

## How to Use

1. **Access Signup**: Click "Don't have an account? Sign Up" on the login page
2. **Fill Form**: Complete all required fields with valid data
3. **Submit**: Click "Sign Up" button
4. **Success**: User will be redirected to login page with success message
5. **Login**: New user can now login with their credentials

## Files Modified/Created

### New Files
- `admin/signup.php` - Signup page with form and validation

### Modified Files
- `classes/Users.php` - Added `signup_user()` method and signup case
- `admin/login.php` - Added signup link
- `admin/inc/sess_auth.php` - Updated session authentication to allow signup page access

## Database Impact
- New users are automatically assigned `type = 2` (Staff)
- All existing database constraints and structures remain unchanged
- No database schema modifications required

## Testing
The feature has been tested for:
- ✅ Syntax validation (PHP lint)
- ✅ Form validation (client-side)
- ✅ Database integration
- ✅ Error handling
- ✅ User experience flow

## Design Features
- **Modern Gradient Background**: Beautiful purple-blue gradient with subtle texture
- **Glassmorphism Cards**: Semi-transparent cards with backdrop blur effect
- **Floating Animations**: Subtle floating shapes in the background
- **Smooth Transitions**: Hover effects and focus animations
- **Loading States**: Spinner animations during form submission
- **Error Animations**: Shake effects for validation errors
- **Success Animations**: Pulse effects for successful actions
- **Responsive Design**: Works perfectly on mobile and desktop

## Notes
- Self-registered users are automatically assigned Staff privileges
- Administrators must still be created through the admin panel
- The feature maintains consistency with existing system design and security patterns
- Both login and signup pages now have matching modern designs
