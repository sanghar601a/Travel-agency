<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_departure_id')->constrained()->onDelete('cascade');
            $table->string('booking_number')->unique()->index();
            $table->integer('guest_count');
            $table->decimal('total_price', 12, 2);
            $table->decimal('commission_amount', 12, 2)->default(0);
            $table->decimal('vendor_earning', 12, 2)->default(0);
            $table->string('status')->default('pending'); // pending, confirmed, cancelled, completed
            $table->string('payment_status')->default('unpaid'); // unpaid, paid, partially_paid, refunded
            $table->text('user_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
