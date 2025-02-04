# How My Project Works

When a user visits the website, they are welcomed by a clean and simple homepage featuring a navbar with "MyWebsite" on the left and Login/Profile icons on the right. Clicking the Login icon opens a dropdown with Login and Sign Up options. The homepage contains a welcome message, a brief website description, and two buttons: "Get Started" (redirects to the Sign-Up Page) and "Login" (redirects to the Login Page). On the Sign-Up Page, users fill in their First Name, Last Name, Email, Password, Confirm Password, and Phone Number. After registration, they are directed to the Profile Photo Upload Page, where they upload their profile picture before being automatically redirected to the Login Page. The Login Page contains fields for Email and Password with a Login button. Upon successful login, users are redirected to the Profile Page, while incorrect credentials show an error message.

The Profile Page dynamically displays the user’s profile picture, name, email, and phone number with an option to update profile details. Users can click "Update Profile" to edit their information and upload a new profile picture. The Update Profile Page allows users to modify their details and save changes to the database. Additionally, a Logout button securely logs users out and redirects them to the Homepage. This structured flow ensures a smooth user experience with authentication, registration, and profile management functionalities.

## 1. Introduction
The developed website provides a secure user authentication system with registration, login, and session management. It allows users to create an account, securely log in, and manage their profiles, including updating personal information and uploading profile pictures. The website is built using PHP, MySQL, HTML, CSS, and Bootstrap for a modern and responsive user experience.

## 2. Features and Functionalities
### 2.1 User Registration System
#### Secure User Signup
Users can register by providing:
- First Name, Last Name, Email, Password, and Phone Number.
- Passwords are securely hashed using `password_hash()` before storage.
- Email Uniqueness Check prevents duplicate registrations.

#### Validation Rules:
- Password must be at least 8 characters, contain one uppercase letter, one number, and one special character.
- Proper email format validation to prevent incorrect input.
- **Error Handling:** If validation fails, errors are displayed to the user.

### 2.2 Secure User Login
#### Session-Based Authentication
- Users log in using their email and password.
- Password verification using `password_verify()`.
- Upon successful login, a session is created storing user details.
- Users are redirected to their profile page after login.

#### Login Error Handling
- Incorrect credentials result in error messages displayed to the user.
- If the email doesn’t exist, the system notifies the user.

#### Preventing Multiple Logins
- If a user is already logged in, they are redirected to their profile page, preventing unnecessary login attempts.

### 2.3 Profile Management
Users can update their personal details, including:
- First Name, Last Name, Email, Phone Number.
- Profile Picture Upload (stored in an images directory).

#### Profile picture management:
- If no profile picture is uploaded, a default image is displayed.
- Proper file handling ensures safe and secure uploads.

### 2.4 Session Management
- Implemented session-based authentication:
  - Users must be logged in to access the profile update page.
  - If a user logs out, their session is destroyed, and they are redirected to the homepage.

### 2.5 Responsive & User-Friendly Design
- Uses Bootstrap 5 for a clean and modern look.
- **Features:**
  - Navigation Bar for easy access to pages.
  - Mobile-Friendly Layout ensuring usability on all screen sizes.
  - Styled Forms for a smooth user experience.

### 2.6 Error Handling & User Feedback
#### Error Messages
- If registration fails, errors are stored in sessions and displayed when the user is redirected back.
- If login fails, users see clear error messages indicating the issue.

#### Success Messages
- After successful registration, users are redirected to login with a confirmation message.

## 3. Technologies Used
| Technology      | Purpose                                           |
|---------------|---------------------------------------------------|
| PHP           | Backend scripting for handling user authentication. |
| MySQL         | Database for securely storing user information.   |
| Bootstrap 5   | Frontend styling for a modern, responsive layout. |
| HTML & CSS    | Structuring and styling the web pages.           |
| JavaScript (Bootstrap) | Enhancing UI interactions like navbar toggling. |

## 4. Security Measures Implemented
- **Session Handling:** Ensures only authenticated users can access certain pages.
- **Password Hashing:** Uses `password_hash()` to securely store passwords.
- **SQL Injection Prevention:**
  - Uses prepared statements (`bind_param()`) to prevent attacks.
- **Email Uniqueness Check:** Ensures no duplicate email registrations.
- **Secure Redirections:** Redirects users appropriately to prevent unauthorized access.
- **Input Validation & Sanitization:**
  - Prevents SQL injection and XSS attacks by properly sanitizing inputs.

## 5. Potential Improvements
### Enhancing Security
- Implement CSRF tokens to prevent Cross-Site Request Forgery attacks.
- Introduce Two-Factor Authentication (2FA) for added security.

### Password Reset Functionality
- Add password recovery via email for users who forget their credentials.

### User Role System
- Implement roles like admin and regular users with different permissions.

### Email Verification
- Send a verification link upon registration to ensure valid email addresses.

## 6. Conclusion
The website now provides a secure and user-friendly authentication system, allowing users to register, log in, and manage their profiles efficiently. The implementation follows best practices for security, database handling, and responsive design. Future enhancements can further improve the system by adding email verification, password reset, and role-based access control.
