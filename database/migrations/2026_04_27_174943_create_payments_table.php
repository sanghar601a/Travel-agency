    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('booking_id')->constrained()->onDelete('cascade');
                $table->string('transaction_id')->unique()->index();
                $table->string('gateway')->default('stripe'); // stripe, easypaisa, bank_transfer
                $table->decimal('amount', 12, 2);
                $table->string('currency')->default('USD');
                $table->json('payload')->nullable(); // Store raw response from gateway
                $table->string('status')->default('pending'); // pending, completed, failed, refunded
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('payments');
        }
    };
