#!/bin/bash

# Quick setup script for new developers
echo "🚀 Setting up Invoice App development environment..."

# Check if Docker is running
if ! docker info &> /dev/null; then
    echo "❌ Docker is not running. Please start Docker Desktop and try again."
    exit 1
fi

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js and try again."
    exit 1
fi

echo "✅ Prerequisites check passed"

# Install frontend dependencies if needed
if [ ! -d "app/node_modules" ]; then
    echo "📦 Installing frontend dependencies..."
    cd app && npm install && cd ..
fi

# Setup environment if .env doesn't exist
if [ ! -f ".env" ]; then
    echo "🔧 Setting up environment configuration..."
    ./env-setup.sh
else
    echo "✅ Environment file already exists"
    # Start backend services
    echo "🐳 Starting backend services..."
    ./dev.sh backend
fi

# Wait for services to be ready
echo "⏳ Waiting for services to be ready..."
sleep 10

# Run initial migrations
echo "🗄️ Setting up database..."
./dev.sh laravel migrate:fresh --seed

echo ""
echo "🎉 Setup complete!"
echo ""
echo "📋 Next steps:"
echo "1. Start frontend: ./dev.sh frontend (in another terminal)"
echo "2. Visit: http://localhost:3000 (frontend) & http://localhost:8080 (API)"
echo ""
echo "💡 Tips:"
echo "- Use './dev.sh help' to see all available commands"
echo "- Check DEVELOPMENT.md for detailed documentation"
echo "- Use './dev.sh stop' to stop backend services"
echo ""
