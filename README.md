# 🌍 PAK TRAVEL - Premium Multi-Vendor Travel Marketplace

PAK TRAVEL is a high-end, world-class travel marketplace built on modern backend architecture with a focus on luxury aesthetics. This platform connects Travelers, Vendors, and Administrators in a seamless, high-performance ecosystem.

---

## 🛠 Technology Stack

-   **Framework**: Laravel 11 (PHP 8.2+)
-   **Styling**: Tailwind CSS 4 (via Vite)
-   **Interactivity**: Alpine.js
-   **Icons**: Lucide Icons
-   **Database**: MySQL with Atomic Transactions
-   **Typography**: Outfit (Google Fonts) for a premium feel

---

## 🚀 Core Features

### 1. Advanced Multi-Auth Architecture
A custom role-based authentication system supporting three distinct portals:
-   **Traveler Dashboard**: Manage personal adventures, track bookings, and view spendings.
-   **Vendor Panel**: Professional SaaS-style dashboard for travel agencies to manage inventory and revenue.
-   **Admin Enterprise Console**: Global platform control, vendor verification, and GMV tracking.

### 2. Premium Booking Engine
-   **Transaction-Safe Checkout**: Built with `DB::transaction` to ensure data integrity between bookings, payments, and inventory.
-   **Live Inventory Tracking**: Automated seat management for tour departures.
-   **Dynamic Traveler Entry**: Responsive forms that adapt to the number of guests selected.

### 3. Vendor Inventory & Package Builder
-   **Smart Package Builder**: Detailed multi-section form for creating and publishing tour packages.
-   **Revenue Analytics**: Real-time calculation of vendor earnings and active reservation counts.

### 4. Admin Verification Lifecycle
-   **Vendor Vetting**: Secure approval workflow for new agencies joining the platform.
-   **Global Platform Oversight**: Centralized view of all tours, users, and platform-wide bookings.

---

## ✨ Specializations (Unique Selling Points)

-   **Luxury UI/UX**: Extensive use of Glassmorphism, smooth micro-animations, and a refined color palette.
-   **Component-Driven Frontend**: Built using reusable Blade components for consistency and performance.
-   **Production-Ready Dashboards**: Minimalist yet data-rich layouts for professional users.
-   **Mobile-First Design**: Fully responsive across all devices (Desktop, Tablet, Mobile).

---

## 📂 Installation & Setup

1.  **Clone the repository**:
    ```bash
    git clone [repository-url]
    ```
2.  **Install PHP Dependencies**:
    ```bash
    composer install
    ```
3.  **Install JS Dependencies**:
    ```bash
    npm install
    ```
4.  **Configure Environment**:
    ```bash
    cp .env.example .env
    # Update your database credentials in .env
    ```
5.  **Database Setup & Seeding**:
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```
6.  **Run Development Servers**:
    ```bash
    php artisan serve
    npm run dev
    ```

---

## 📝 License
This project is developed for **PAK TRAVEL** and follows standard commercial licensing.
