# 🎉 Invoice App - Complete Development Setup

## 🚀 **Project Overview**

A modern, full-stack invoice management application with:

-   **🔧 Laravel 11** - API backend with PHP 8.4
-   **🎨 Nuxt.js 4** - Modern Vue.js frontend
-   **🐳 Docker** - Containerized development environment
-   **📊 MySQL 8.0** - Robust database
-   **⚡ Development Tools** - Automated scripts and workflows

---

## 🏗️ **Architecture**

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Nuxt.js App  │───▶│   Laravel API   │───▶│   MySQL DB      │
│   Port: 3000    │    │   Port: 8080    │    │   Port: 3306    │
│   (Frontend)    │    │   (Backend)     │    │   (Database)    │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

### **🔄 Development Modes**

#### **🚀 Recommended: Hybrid Development**

-   **Backend**: Docker containers (API + MySQL)
-   **Frontend**: Local development (`npm run dev`)
-   **Benefits**: Hot reload, fast builds, easy debugging

#### **🐳 Full Docker Development**

-   **All services**: Running in Docker containers
-   **Benefits**: Production-like environment, consistency

---

## 📂 **Project Structure**

```
invoice/
├── 🔧 Development Scripts
│   ├── dev.sh                 # Main development helper
│   ├── setup.sh              # Complete project setup
│   └── env-setup.sh          # Environment configuration
├── 🐳 Docker Configuration
│   ├── docker-compose.yml    # Full stack (production-like)
│   └── docker-compose.dev.yml # Backend only (development)
├── 🌍 Environment
│   ├── .env                  # Active configuration
│   ├── .env.example         # Template with placeholders
│   └── .gitignore           # Comprehensive ignore patterns
├── 📚 Documentation
│   ├── README.md            # Project overview
│   ├── DEVELOPMENT.md       # Development workflow
│   ├── ENV_GUIDE.md         # Environment reference
│   ├── ENV_SETUP.md         # Environment configuration
│   └── GITIGNORE.md         # Git ignore patterns
├── 🔧 api/ (Laravel)
│   ├── app/                 # Application logic
│   ├── config/              # Configuration files
│   ├── database/            # Migrations, seeders
│   ├── routes/              # API routes
│   └── .env → ../.env      # Symbolic link to root
└── 🎨 app/ (Nuxt.js)
    ├── app/                 # Vue components, pages
    ├── nuxt.config.ts       # Nuxt configuration
    ├── package.json         # Frontend dependencies
    └── .env → ../.env      # Symbolic link to root
```

---

## ⚡ **Quick Start**

### **🆕 First Time Setup**

```bash
# Clone and setup
git clone <repository>
cd invoice

# Complete automated setup
./setup.sh

# Or manual setup
./env-setup.sh              # Setup environment
./dev.sh backend            # Start backend
./dev.sh frontend           # Start frontend (new terminal)
```

### **📅 Daily Development**

```bash
# Start your development day
./dev.sh backend            # Terminal 1: API + Database
./dev.sh frontend           # Terminal 2: Frontend with HMR

# Common tasks
./dev.sh laravel migrate    # Run migrations
./dev.sh laravel tinker     # Laravel REPL
./dev.sh logs              # View logs
./dev.sh status            # Check service status

# End of day
./dev.sh stop              # Stop all services
```

---

## 🛠️ **Available Commands**

### **Development Helper (`./dev.sh`)**

| Command          | Description                      |
| ---------------- | -------------------------------- |
| `backend`        | Start API + MySQL only           |
| `frontend`       | Start Nuxt locally with HMR      |
| `full`           | Start everything in Docker       |
| `stop`           | Stop backend services            |
| `logs [service]` | Show logs (optional: api, mysql) |
| `laravel [cmd]`  | Run Laravel artisan commands     |
| `status`         | Show service status              |

### **Setup Scripts**

| Script           | Purpose                        |
| ---------------- | ------------------------------ |
| `./setup.sh`     | Complete project setup         |
| `./env-setup.sh` | Environment configuration only |

### **NPM Scripts (Root)**

| Command                | Description                    |
| ---------------------- | ------------------------------ |
| `npm run dev`          | Start backend only             |
| `npm run dev:frontend` | Start frontend only            |
| `npm run dev:full`     | Full Docker stack              |
| `npm run setup`        | Complete setup with migrations |

---

## 🌐 **Service URLs**

| Service      | URL                       | Environment       |
| ------------ | ------------------------- | ----------------- |
| **Frontend** | http://localhost:3000     | Local development |
| **API**      | http://localhost:8080     | Docker container  |
| **Database** | localhost:3306            | Docker container  |
| **API Docs** | http://localhost:8080/api | API endpoints     |

---

## 🔧 **Key Features**

### **🏗️ Environment Management**

-   ✅ **Single source of truth** - Centralized `.env` configuration
-   ✅ **Symbolic links** - Unified environment across services
-   ✅ **Template system** - `.env.example` with placeholders
-   ✅ **Auto-generation** - APP_KEY and setup automation

### **🐳 Docker Integration**

-   ✅ **Development optimized** - Backend-only compose file
-   ✅ **Production ready** - Full stack compose file
-   ✅ **Volume persistence** - Database data preservation
-   ✅ **Hot reload support** - Local frontend development

### **🔒 Security & Git**

-   ✅ **Comprehensive gitignore** - Protects secrets and artifacts
-   ✅ **No committed secrets** - Environment files ignored
-   ✅ **Template tracking** - Only `.env.example` in git
-   ✅ **Pattern documentation** - Clear ignore explanations

### **📚 Documentation**

-   ✅ **Complete guides** - Setup, development, environment
-   ✅ **Command reference** - All scripts documented
-   ✅ **Best practices** - Development workflows
-   ✅ **Troubleshooting** - Common issues and solutions

---

## 🎯 **Best Practices Implemented**

1. **🚀 Optimal Development Experience**

    - Local frontend with hot module replacement
    - Dockerized backend for consistency
    - Unified command interface

2. **🔧 Maintainable Configuration**

    - Single environment file
    - Clear variable organization
    - Automated setup processes

3. **🔒 Security First**

    - Secrets never committed
    - Comprehensive gitignore
    - Template-based configuration

4. **📖 Developer Friendly**

    - Extensive documentation
    - Helper scripts for common tasks
    - Clear project structure

5. **🌍 Environment Flexibility**
    - Easy switching between development modes
    - Production-ready Docker configuration
    - Scalable architecture

---

## 🚀 **Ready for Development!**

Your Invoice App is now fully configured with:

✅ **Complete development environment**  
✅ **Automated setup scripts**  
✅ **Comprehensive documentation**  
✅ **Security best practices**  
✅ **Flexible deployment options**

**Happy coding! 🎉**

---

_For detailed information, check the documentation files in the project root._
