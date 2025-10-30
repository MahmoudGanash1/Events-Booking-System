# Events Booking System

Developed by Eng.Mahmoud Ganash

Events Booking System built with Laravel, featuring secure user authentication with OTP verification, event categories, and booking management. Users can browse events, reserve seats, and track bookings, while admins can manage all events, categories, and user reservations through a clean RESTful API.

---

## 🚀 Features

### 👤 User Features
- Register and log in securely (password or OTP).  
- Browse events by category (Music, Tech, Sports, etc.).  
- View detailed event information (date, location, capacity, description).  
- Book one or multiple seats for an event.  
- View, edit, or cancel bookings.  
- Access booking history.

### 🧑‍💼 Admin Features
- Create, update, delete events.  
- Manage event categories.  
- View and manage all user bookings.  
- Monitor event capacity.

---

## 🧱 System Components

| Module | Description |
|---------|-------------|
| **User** | Represents a registered user who can book events. |
| **Event** | Contains details of each event. |
| **Category** | Groups events by type. |
| **Booking** | Represents user reservations. |

---

## 🔗 Relationships

- **Category → Event:** One-to-Many  
- **Event → Booking:** One-to-Many  
- **User → Booking:** One-to-Many  
- **User ↔ Event:** Many-to-Many (via bookings)

---

## ⚙️ Tech Stack

- Backend: Laravel  
- Database: MySQL  
- Authentication: Laravel Sanctum / Passport + OTP  
- API Format: RESTful JSON  
- Environment: PHP 8+, Composer

---

## 🛣️ API Endpoints

### **Authentication & OTP**
| Endpoint | Method | Request | Response | Description |
|----------|--------|---------|---------|-------------|
| `/api/register` | POST | `{ name, email, password, password_confirmation }` | `{ token, user }` | Register a new user |
| `/api/login` | POST | `{ email, password }` | `{ token, user }` | Login with email/password |
| `/api/logout` | POST | Header: `Authorization: Bearer {token}` | `{ message }` | Logout user |
| `/api/otp/send` | POST | `{ phone }` | `{ message, otp_id }` | Send OTP to user for verification/login |
| `/api/otp/verify` | POST | `{ otp_id, code }` | `{ token, user }` | Verify OTP and login/register user |

---

### **Categories**
| Endpoint | Method | Request | Response | Description |
|----------|--------|---------|---------|-------------|
| `/api/categories` | GET | - | `[ {id, name, description} ]` | List all categories |
| `/api/categories/{id}` | GET | - | `{id, name, description}` | Get category details |
| `/api/categories` | POST | `{ name, description }` | `{id, name, description}` | Create a new category (Admin) |
| `/api/categories/{id}` | PUT | `{ name, description }` | `{id, name, description}` | Update category (Admin) |
| `/api/categories/{id}` | DELETE | - | `{ message }` | Delete category (Admin) |
| `/api/categories/{id}/events` | GET | - | `[ {id, title, date, location, capacity, description} ]` | List events by category |

---

### **Events**
| Endpoint | Method | Request | Response | Description |
|----------|--------|---------|---------|-------------|
| `/api/events` | GET | - | `[ {id, title, date, location, capacity, description, category_id} ]` | List all events |
| `/api/events/{id}` | GET | - | `{id, title, date, location, capacity, description, category_id}` | Get event details |
| `/api/events` | POST | `{ title, description, date, location, capacity, category_id }` | `{id, title, ...}` | Create event (Admin) |
| `/api/events/{id}` | PUT | `{ title, description, date, location, capacity, category_id }` | `{id, title, ...}` | Update event (Admin) |
| `/api/events/{id}` | DELETE | - | `{ message }` | Delete event (Admin) |

---

### **Bookings**
| Endpoint | Method | Request | Response | Description |
|----------|--------|---------|---------|-------------|
| `/api/bookings` | POST | `{ event_id, seats }` | `{id, user_id, event_id, seats, created_at}` | Create a booking |
| `/api/my-bookings` | GET | Header: `Authorization: Bearer {token}` | `[ {id, event_id, seats, status, event: {...}} ]` | List user bookings |
| `/api/bookings/{id}` | GET | Header: `Authorization: Bearer {token}` | `{id, user_id, event_id, seats, status, event: {...}}` | Get booking details |
| `/api/bookings/{id}` | DELETE | Header: `Authorization: Bearer {token}` | `{ message }` | Cancel booking |

---

## 🧩 Future Enhancements

- Email notifications for booking confirmation  
- Payment integration (Stripe/PayPal)  
- Event reminders and QR-based check-in  
- Frontend dashboard with Vue.js or React  

---

## 📸 Example User Flow

1. User registers or logs in (password or OTP).  
2. Browses events by category.  
3. Selects an event and books seats.  
4. Views booking details in “My Bookings”.  
5. Admin monitors bookings and event capacity.



---

## 👤 Author

**Mahmoud Ganash** – Developer / Project Owner  
GitHub: [github.com/yourusername](https://github.com/MahmoudGanash1)  
Email: Mahmoud2491@hotmail.com
