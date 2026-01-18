JWT Authentication in Laravel

This project implements a custom JWT-based authentication flow in Laravel, focused on clarity, control, and API-oriented design.

Overview

The application provides:

- An endpoint to issue JWT tokens
- A custom middleware to validate tokens on protected routes
- Stateless authentication suitable for REST APIs

JWTs are generated and validated using the HS256 algorithm, with expiration handling and proper error responses.

Implementation details

- Tokens are created manually using a controller
- Token validation is handled by a dedicated middleware
- The middleware checks:
   - Authorization header presence and format
   - Token signature validity
   - Token expiration
- Configuration is centralized via "config/jwt.php"
- No session or cookie dependency (fully stateless)

Use cases

This approach is appropriate for:

- API backends
- SPAs and mobile applications
- Services that require explicit control over authentication logic
- Systems where understanding and auditing the auth flow is important

Design goals

- Keep authentication logic explicit and readable
- Avoid unnecessary abstractions
- Follow Laravel’s request lifecycle and middleware pattern
- Make the system easy to extend with user validation, roles, or permissions

This project reflects a practical understanding of how JWT authentication is implemented and integrated into Laravel, rather than relying on prebuilt authentication scaffolding.
