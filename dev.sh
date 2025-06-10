#!/bin/bash

# Development helper script for Invoice App
# Usage: ./dev.sh [command]

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Helper functions
print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_info() {
    echo -e "${BLUE}ℹ️  $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Function to check if command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Function to start backend only (API + MySQL)
start_backend() {
    print_info "Starting backend services (API + MySQL)..."
    docker-compose -f docker-compose.dev.yml up -d
    print_success "Backend services started!"
    print_info "API available at: http://localhost:8080"
    print_info "MySQL available at: localhost:3306"
}

# Function to stop backend
stop_backend() {
    print_info "Stopping backend services..."
    docker-compose -f docker-compose.dev.yml down
    print_success "Backend services stopped!"
}

# Function to start frontend locally
start_frontend() {
    if [ ! -d "app/node_modules" ]; then
        print_info "Installing frontend dependencies..."
        cd app && npm install && cd ..
    fi
    
    print_info "Starting frontend in development mode..."
    cd app && npm run dev
}

# Function to start full stack in Docker
start_full_docker() {
    print_info "Starting full stack in Docker..."
    docker-compose up -d
    print_success "Full stack started in Docker!"
    print_info "Frontend available at: http://localhost:3000"
    print_info "API available at: http://localhost:8080"
}

# Function to show logs
show_logs() {
    if [ "$2" = "api" ]; then
        docker-compose -f docker-compose.dev.yml logs -f api
    elif [ "$2" = "mysql" ]; then
        docker-compose -f docker-compose.dev.yml logs -f mysql
    else
        docker-compose -f docker-compose.dev.yml logs -f
    fi
}

# Function to run Laravel commands
laravel_cmd() {
    if [ -z "$2" ]; then
        print_error "Please specify a Laravel command"
        print_info "Example: ./dev.sh laravel 'migrate'"
        exit 1
    fi
    
    print_info "Running Laravel command: $2"
    docker-compose -f docker-compose.dev.yml exec api php artisan $2
}

# Function to show status
show_status() {
    print_info "Current service status:"
    docker-compose -f docker-compose.dev.yml ps
}

# Function to show help
show_help() {
    echo -e "${BLUE}Invoice App Development Helper${NC}"
    echo ""
    echo "Usage: ./dev.sh [command]"
    echo ""
    echo "Commands:"
    echo "  backend           Start backend services only (API + MySQL)"
    echo "  frontend          Start frontend locally with npm run dev"
    echo "  stop              Stop backend services"
    echo "  full              Start full stack in Docker"
    echo "  logs [service]    Show logs (optional: api, mysql)"
    echo "  laravel [cmd]     Run Laravel artisan command"
    echo "  status            Show service status"
    echo "  help              Show this help message"
    echo ""
    echo "Recommended development workflow:"
    echo "  1. ./dev.sh backend    # Start API and database"
    echo "  2. ./dev.sh frontend   # Start frontend locally (in another terminal)"
    echo ""
    echo "📚 Documentation:"
    echo "  - DEVELOPMENT.md   # Development workflow"
    echo "  - ENV_GUIDE.md     # Environment configuration"
    echo "  - GITIGNORE.md     # Git ignore patterns"
    echo ""
}

# Main script logic
case "$1" in
    "backend")
        start_backend
        ;;
    "frontend")
        start_frontend
        ;;
    "stop")
        stop_backend
        ;;
    "full")
        start_full_docker
        ;;
    "logs")
        show_logs "$@"
        ;;
    "laravel")
        laravel_cmd "$@"
        ;;
    "status")
        show_status
        ;;
    "help"|"")
        show_help
        ;;
    *)
        print_error "Unknown command: $1"
        show_help
        exit 1
        ;;
esac
