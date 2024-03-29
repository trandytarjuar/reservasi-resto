# Restaurant Reservation System

A simple web application for managing restaurant reservations.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Contributing](#contributing)
- [License](#license)

## Introduction

The Restaurant Reservation System is a web application designed to handle both walk-in and online reservations for a restaurant. It allows users to reserve tables, manage reservations, and receive reminders.

## Features

- Walk-in reservation with default 30-minute arrival time.
- Online reservation with optional reminder feature.
- Availability checking for walk-in reservations.

## Getting Started

These instructions will help you set up and run the project on your local machine.

### Prerequisites

Ensure you have the following installed:

- [PHP](https://www.php.net/) (>= 7.3)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (and npm or Yarn)

### Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/trandytarjuar/reservasi-resto.git

2. **Install PHP dependencies:**
    ```bash
   composer install
3. **Copy the .env.example file to .env:**
    ```bash
   cp .env.example .env
4. **Creating Database with the Same Name as in .env:**
    ```bash
   DB_DATABASE=reservasi
5. **Run database migrations:**
    ```bash
   php artisan migrate
6. **Start the development server:**
    ```bash
   php artisan serve





