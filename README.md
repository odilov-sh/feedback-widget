## 🚀 Installation

You can set up the project in one of two ways:

### 🧩 Option 1: Basic Installation

### Steps

1. **Clone the repository and install dependencies**
   ```bash
   git clone https://github.com/odilov-sh/feedback-widget
   cd feedback-widget
   composer install
2. **Copy the environment file and generate the application key**
   ```bash
   cp .env.example .env
   php artisan key:generate
3. **Configure environment**
   Edit the `.env` file and set your database, mail, and other required credentials.
4. **Run migrations and seeders, then start the server**
   ```bash
   php artisan migrate --seed
   php artisan serve
5. **Open in your browser:**
   http://localhost

---

### 🐳 Option 2: Docker Installation (Laravel Sail)

### Steps

1. **Clone the repository and copy the environment file**
   ```bash
   git clone https://github.com/odilov-sh/feedback-widget
   cd feedback-widget
   cp .env.example.docker .env
2. **Build and start the containers**
   ```bash
   docker-compose build
   docker-compose up -d
3. **Enter the backend container bash and run the commands**
   ```bash
   docker exec -it feedback-widget-backend bash  
   composer install
   php artisan key:generate
   php artisan migrate --seed

4. **Open in your browser:**
   http://localhost

#$ Next Steps After Installation

After successfully setting up the project and running it locally, follow these steps to explore and test the application.

---

## **Admin Panel (for Managers)**

- **Base URL:** `/dashboard` (authentication required)
- **Login Credentials:**
    - **Email:** `manager@gmail.com`
    - **Password:** `1234568`

---

## ⚙️ API Routes

| Method | Endpoint | Description |
|:-------|:----------|:-------------|
| `POST` | `/api/tickets` | Store a new ticket |
| `GET`  | `/api/tickets/statistics` | Retrieve ticket statistics |

To explore full api documentation, visit:  
👉 **`/api-doc`**

## 💬 Feedback Widget

### **Usage Example**

Add the following iframe to your website HTML:

```html
<iframe src="http://localhost/widget" frameborder="0" width="600" height="600"></iframe>
```
### **View Example**
To view widget example, visit:  
👉 **`/view-widget`**